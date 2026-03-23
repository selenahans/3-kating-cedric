<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');
        $user = $request->user();

        $query = UserNotification::where('user_id', $user->id);

        if ($filter === 'unread') {
            $query->where('is_read', false);
        }

        $notifications = $query->latest()->get();
        $totalNotifications = UserNotification::where('user_id', $user->id)->count();
        $unreadCount = UserNotification::where('user_id', $user->id)->where('is_read', false)->count();

        return view('notification', compact('notifications', 'totalNotifications', 'unreadCount', 'filter'));
    }

    public function markAsRead(Request $request, int $id): RedirectResponse
    {
        $notification = UserNotification::where('user_id', $request->user()->id)
            ->findOrFail($id);

        if (!$notification->is_read) {
            $notification->is_read = true;
            $notification->read_at = now();
            $notification->save();
        }

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function markAllAsRead(Request $request): RedirectResponse
    {
        UserNotification::where('user_id', $request->user()->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $notification = UserNotification::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}