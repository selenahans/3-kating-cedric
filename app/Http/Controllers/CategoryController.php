<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ReadingGoal;
use App\Models\UserNotification;
use App\Models\UserPet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function showOnboarding(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if ($user && $user->is_onboarded) {
            return redirect()->route('dashboard');
        }

        $categories = Category::orderBy('name')->get();

        return view('onboarding', compact('categories'));
    }

    public function storeOnboarding(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pet_name' => ['nullable', 'string', 'max:50'],
            'target' => ['required', 'integer', 'min:1', 'max:500'],
            'categories' => ['nullable', 'array', 'max:10'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ]);

        $user = $request->user();
        $petName = trim($validated['pet_name'] ?? '') ?: 'Barnaby';

        UserPet::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nickname' => $petName,
                'type' => 'owl',
                'xp' => 0,
                'stage' => 'baby',
                'health' => 100,
                'happiness' => 100,
            ]
        );

        ReadingGoal::updateOrCreate(
            ['user_id' => $user->id],
            [
                'daily_target_pages' => $validated['target'],
                'reminder_enabled' => true,
                'reminder_time' => '19:00:00',
            ]
        );

        $user->preferredCategories()->sync($validated['categories'] ?? []);
        $user->onboarding_completed_at = now();
        $user->save();

        UserNotification::create([
            'user_id' => $user->id,
            'type' => 'onboarding',
            'title' => 'Selamat datang di Biblo!',
            'message' => 'Profil awalmu sudah siap. Yuk mulai membaca dan capai target harianmu.',
            'action_url' => route('dashboard'),
            'is_read' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Onboarding berhasil disimpan.');
    }
}