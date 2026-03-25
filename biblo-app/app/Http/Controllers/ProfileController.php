<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ReadingGoal;
use App\Models\ReadingLog;
use App\Models\TaskCompletion;
use App\Models\UserBookProgress;
use App\Models\UserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user()->load(['readingGoal', 'pet']);

        $progressRecords = UserBookProgress::with('book')
            ->where('user_id', $user->id)
            ->get();

        $booksRead = $progressRecords->where('status', 'completed')->count();
        $pagesRead = $progressRecords->sum(function ($progress) {
            $totalPages = $progress->book->total_pages ?? 0;
            return (int) round(($progress->progress_percentage / 100) * $totalPages);
        });
        $dailyStreak = max(0, TaskCompletion::where('user_id', $user->id)->distinct('completed_at')->count('completed_at'));
        $hoursSpent = round($pagesRead / 20, 1);

        $stats = [
            'books_read' => $booksRead,
            'pages_today' => $pagesRead,
            'daily_streak' => $dailyStreak,
            'hours_spent' => $hoursSpent,
        ];

        $readingGoal = $user->readingGoal;

        return view('profil', compact('user', 'stats', 'readingGoal'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($validated['email'] !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->hasFile('photo')) {
            if (!empty($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updateReadingGoal(Request $request): RedirectResponse
    {
        $request->validate([
            'daily_target_pages' => ['nullable', 'integer', 'min:1', 'max:500'],
            'target' => ['nullable', 'integer', 'min:1', 'max:500'],
            'reminder_enabled' => ['nullable'],
            'reminder_time' => ['nullable', 'date_format:H:i'],
        ]);

        $user = $request->user();
        $dailyTargetPages = (int) ($request->input('daily_target_pages') ?? $request->input('target') ?? 15);
        $reminderEnabled = $request->boolean('reminder_enabled');
        $reminderTime = $request->filled('reminder_time') ? $request->input('reminder_time') : null;

        ReadingGoal::updateOrCreate(
            ['user_id' => $user->id],
            [
                'daily_target_pages' => $dailyTargetPages,
                'reminder_enabled' => $reminderEnabled,
                'reminder_time' => $reminderTime,
            ]
        );

        UserNotification::create([
            'user_id' => $user->id,
            'type' => 'goal',
            'title' => 'Reading goal diperbarui',
            'message' => 'Target harianmu sekarang ' . $dailyTargetPages . ' halaman.',
            'action_url' => route('profil'),
            'is_read' => false,
        ]);

        return back()->with('success', 'Reading goal berhasil diperbarui.');
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Some relations (e.g. reading_logs.user_id) do not use cascade delete.
        DB::transaction(function () use ($user) {
            if (!empty($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            ReadingLog::where('user_id', $user->id)->delete();
            $user->delete();
        });

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}