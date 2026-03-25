<?php

namespace App\Http\Controllers;

use App\Models\HighlightNote;
use App\Services\TaskAutoCompletionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function exportPdf(Request $request)
    {
        $notes = HighlightNote::with('book')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        $pages = [];
        $currentPage = [];
        $maxLinesPerPage = 42;

        $pushLine = function (string $line, string $style = 'body') use (&$currentPage, &$pages, $maxLinesPerPage) {
            if (count($currentPage) >= $maxLinesPerPage) {
                $pages[] = $currentPage;
                $currentPage = [];
            }
            $currentPage[] = [
                'text' => $line,
                'style' => $style,
            ];
        };

        $pushDivider = function () use ($pushLine) {
            $pushLine('', 'divider');
        };

        $pushWrapped = function (string $text, string $style = 'body', int $width = 78) use ($pushLine) {
            $wrapped = wordwrap($text, $width, "\n", true);
            foreach (explode("\n", $wrapped) as $line) {
                $pushLine($line, $style);
            }
        };

        $pushLine('Biblo - My Notes Export', 'title');
        $pushLine('Generated: ' . now()->format('Y-m-d H:i:s'), 'meta');
        $pushLine('Total Notes: ' . $notes->count(), 'meta');
        $pushDivider();

        foreach ($notes as $index => $note) {
            if ($index > 0) {
                $pushDivider();
            }

            $pushLine('Note #' . ($index + 1), 'section');
            $pushWrapped('Book: ' . ($note->book->title ?? 'Unknown Book'), 'label');
            $pushWrapped('Author: ' . ($note->book->author ?? 'Unknown Author'), 'label');
            $pushWrapped('Date: ' . $note->created_at->format('Y-m-d H:i'), 'label');
            $pushLine('Highlight', 'subsection');
            $pushWrapped('"' . trim((string) $note->highlighted_text) . '"', 'highlight');

            if (!empty(trim((string) $note->note_content))) {
                $pushLine('Personal Reflection', 'subsection');
                $pushWrapped(trim((string) $note->note_content), 'note');
            } else {
                $pushLine('Personal Reflection', 'subsection');
                $pushWrapped('-', 'muted');
            }

            $pushLine('', 'spacer');
        }

        if (!empty($currentPage)) {
            $pages[] = $currentPage;
        }

        if (empty($pages)) {
            $pages = [[
                ['text' => 'Biblo - My Notes Export', 'style' => 'title'],
                ['text' => 'No notes available.', 'style' => 'muted'],
            ]];
        }

        $pdf = $this->buildSimplePdf($pages);
        $filename = 'mynotes-' . now()->format('Ymd-His') . '.pdf';

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }

    private function buildSimplePdf(array $pages): string
    {
        $objects = [];
        $pageObjectIds = [];
        $contentObjectIds = [];
        $logoImageObject = $this->buildLogoImageObject();

        $nextId = 3;
        foreach ($pages as $pageLines) {
            $pageObjectIds[] = $nextId++;
            $contentObjectIds[] = $nextId++;
        }

        $fontObjectId = $nextId++;
        $logoObjectId = null;
        if ($logoImageObject !== null) {
            $logoObjectId = $nextId++;
        }

        $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";

        $kids = array_map(fn ($id) => $id . ' 0 R', $pageObjectIds);
        $objects[2] = "<< /Type /Pages /Kids [" . implode(' ', $kids) . "] /Count " . count($pageObjectIds) . " >>";

        foreach ($pages as $i => $pageLines) {
            $pageId = $pageObjectIds[$i];
            $contentId = $contentObjectIds[$i];
            $xObjectPart = $logoObjectId !== null ? " /XObject << /ImBiblo {$logoObjectId} 0 R >>" : '';

            $objects[$pageId] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 {$fontObjectId} 0 R >>{$xObjectPart} >> /Contents {$contentId} 0 R >>";

            $streamLines = [];
            $streamLines[] = 'q';
            $streamLines[] = '0.949 0.937 0.918 rg';
            $streamLines[] = '0 0 595 842 re f';
            $streamLines[] = 'Q';
            $streamLines[] = 'q';
            $streamLines[] = '0.624 0.686 0.604 rg';
            $streamLines[] = '0 778 595 64 re f';
            $streamLines[] = 'Q';

            if ($logoObjectId !== null) {
                $streamLines[] = 'q';
                $streamLines[] = '34 0 0 34 42 792 cm';
                $streamLines[] = '/ImBiblo Do';
                $streamLines[] = 'Q';
            }

            $y = 805;

            foreach ($pageLines as $line) {
                $style = $line['style'] ?? 'body';
                $text = $line['text'] ?? '';

                if ($style === 'divider') {
                    $streamLines[] = 'q';
                    $streamLines[] = '0.690 0.616 0.522 RG';
                    $streamLines[] = '1 w';
                    $streamLines[] = '42 ' . $y . ' m';
                    $streamLines[] = '553 ' . $y . ' l S';
                    $streamLines[] = 'Q';
                    $y -= 18;
                    continue;
                }

                $spec = $this->pdfStyleSpec($style);
                $safeLine = $this->escapePdfText($text);
                $x = $spec['x'];
                $size = $spec['size'];
                $lineHeight = $spec['lineHeight'];
                $color = $spec['color'];

                $streamLines[] = 'BT';
                $streamLines[] = sprintf('%.3F %.3F %.3F rg', $color[0], $color[1], $color[2]);
                $streamLines[] = '/F1 ' . $size . ' Tf';
                $streamLines[] = '1 0 0 1 ' . $x . ' ' . $y . ' Tm';
                $streamLines[] = '(' . $safeLine . ') Tj';
                $streamLines[] = 'ET';

                $y -= $lineHeight;
            }

            $stream = implode("\n", $streamLines);
            $objects[$contentId] = "<< /Length " . strlen($stream) . " >>\nstream\n" . $stream . "\nendstream";
        }

        $objects[$fontObjectId] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';
        if ($logoObjectId !== null && $logoImageObject !== null) {
            $objects[$logoObjectId] = $logoImageObject;
        }

        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $id => $content) {
            $offsets[$id] = strlen($pdf);
            $pdf .= $id . " 0 obj\n" . $content . "\nendobj\n";
        }

        $xrefStart = strlen($pdf);
        $count = max(array_keys($objects));

        $pdf .= "xref\n0 " . ($count + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= $count; $i++) {
            $offset = $offsets[$i] ?? 0;
            $pdf .= str_pad((string) $offset, 10, '0', STR_PAD_LEFT) . " 00000 n \n";
        }

        $pdf .= "trailer\n<< /Size " . ($count + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xrefStart . "\n%%EOF";

        return $pdf;
    }

    private function escapePdfText(string $text): string
    {
        $text = preg_replace('/[^\x20-\x7E]/', ' ', $text) ?? '';
        $text = str_replace('\\', '\\\\', $text);
        $text = str_replace('(', '\\(', $text);
        return str_replace(')', '\\)', $text);
    }

    private function pdfStyleSpec(string $style): array
    {
        $styles = [
            'title' => ['size' => 17, 'lineHeight' => 21, 'x' => 86, 'color' => [0.247, 0.271, 0.247]],
            'meta' => ['size' => 10, 'lineHeight' => 14, 'x' => 86, 'color' => [0.247, 0.271, 0.247]],
            'section' => ['size' => 13, 'lineHeight' => 18, 'x' => 42, 'color' => [0.494, 0.561, 0.478]],
            'subsection' => ['size' => 10, 'lineHeight' => 15, 'x' => 42, 'color' => [0.690, 0.616, 0.522]],
            'label' => ['size' => 11, 'lineHeight' => 15, 'x' => 42, 'color' => [0.247, 0.271, 0.247]],
            'highlight' => ['size' => 12, 'lineHeight' => 16, 'x' => 52, 'color' => [0.247, 0.271, 0.247]],
            'note' => ['size' => 11, 'lineHeight' => 15, 'x' => 52, 'color' => [0.247, 0.271, 0.247]],
            'muted' => ['size' => 10, 'lineHeight' => 15, 'x' => 52, 'color' => [0.494, 0.561, 0.478]],
            'spacer' => ['size' => 10, 'lineHeight' => 8, 'x' => 42, 'color' => [0.247, 0.271, 0.247]],
            'body' => ['size' => 11, 'lineHeight' => 15, 'x' => 42, 'color' => [0.247, 0.271, 0.247]],
        ];

        return $styles[$style] ?? $styles['body'];
    }

    private function buildLogoImageObject(): ?string
    {
        $logoPath = public_path('images/logo/biblo.webp');
        if (!is_file($logoPath)) {
            return null;
        }

        $imageData = @file_get_contents($logoPath);
        if ($imageData === false || $imageData === '') {
            return null;
        }

        if (!function_exists('imagecreatefromstring') || !function_exists('imagejpeg')) {
            return null;
        }

        $image = @imagecreatefromstring($imageData);
        if ($image === false) {
            return null;
        }

        $width = imagesx($image);
        $height = imagesy($image);
        if ($width <= 0 || $height <= 0) {
            imagedestroy($image);
            return null;
        }

        ob_start();
        imagejpeg($image, null, 88);
        $jpegData = (string) ob_get_clean();
        imagedestroy($image);

        if ($jpegData === '') {
            return null;
        }

        return "<< /Type /XObject /Subtype /Image /Width {$width} /Height {$height} /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length " . strlen($jpegData) . " >>\nstream\n" . $jpegData . "\nendstream";
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'cfi_range' => ['required', 'string'],
            'highlighted_text' => ['required', 'string'],
            'note_content' => ['nullable', 'string'],
            'color_code' => ['nullable', 'string', 'max:20'],
        ]);

        $note = HighlightNote::create([
            'user_id' => $request->user()->id,
            'book_id' => $validated['book_id'],
            'cfi_range' => $validated['cfi_range'],
            'highlighted_text' => $validated['highlighted_text'],
            'note_content' => $validated['note_content'] ?? null,
            'color_code' => $validated['color_code'] ?? '#FDE047',
        ]);

        app(TaskAutoCompletionService::class)->syncForUser((int) $request->user()->id);

        return response()->json([
            'success' => true,
            'id' => $note->id,
            'message' => 'Highlight dan note berhasil disimpan.',
        ]);
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $sort = $request->query('sort', 'latest');

        $query = HighlightNote::with('book')
            ->where('user_id', $request->user()->id);

        if ($search !== '') {
            $query->where(function (Builder $noteQuery) use ($search) {
                $noteQuery->where('highlighted_text', 'like', '%' . $search . '%')
                    ->orWhere('note_content', 'like', '%' . $search . '%')
                    ->orWhereHas('book', function (Builder $bookQuery) use ($search) {
                        $bookQuery->where('title', 'like', '%' . $search . '%')
                            ->orWhere('author', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $notes = $query->get();

        $totalHighlights = $notes->count();
        $totalNotes = $notes->filter(function ($note) {
            return !empty(trim((string) $note->note_content));
        })->count();

        return view('mynotes', compact('notes', 'totalHighlights', 'totalNotes', 'search', 'sort'));
    }
    public function destroy(Request $request, HighlightNote $note): RedirectResponse
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $note->delete();

        return back()->with('status', 'Catatan berhasil dihapus.');
    }

    public function update(Request $request, HighlightNote $note): RedirectResponse
    {
        // 🔒 सुरक्षा: ensure user owns the note
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'note_content' => ['nullable', 'string'],
            'color_code' => ['nullable', 'string', 'max:20'],
        ]);

        $note->update([
            'note_content' => $validated['note_content'] ?? $note->note_content,
            'color_code' => $validated['color_code'] ?? $note->color_code,
        ]);

        return back()->with('status', 'Catatan berhasil diperbarui.');
    }
}
