<?php

namespace App\Services;

use App\Models\UserNotification;

class NotificationService
{
    /**
     * Create book completion notification
     */
    public static function notifyBookCompleted(int $userId, string $bookTitle): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'book_completed',
            'title' => 'Selesai Membaca! 🎉',
            'message' => "Kamu berhasil menyelesaikan buku \"$bookTitle\". Hebat!",
            'is_read' => false,
        ]);
    }

    /**
     * Create pet level up notification
     */
    public static function notifyPetLevelUp(int $userId, string $petName, int $newLevel): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'level_up',
            'title' => 'Naik Level! ⬆️',
            'message' => "$petName naik ke level $newLevel. Terus membaca yuk!",
            'is_read' => false,
        ]);
    }

    /**
     * Create pet hungry notification
     */
    public static function notifyPetHungry(int $userId, string $petName): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'pet_hungry',
            'title' => 'Pet Kamu Lapar! 🍲',
            'message' => "$petName sedang kelaparan. Berikan makanan agar bisa membaca lagi.",
            'is_read' => false,
        ]);
    }

    /**
     * Create pet very hungry notification
     */
    public static function notifyPetVeryHungry(int $userId, string $petName): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'pet_hungry_hungry',
            'title' => 'Pet Kamu Sangat Lapar! 😫',
            'message' => "$petName sangat lapar dan butuh makan sekarang!",
            'is_read' => false,
        ]);
    }

    /**
     * Create pet full/satisfied notification
     */
    public static function notifyPetFull(int $userId, string $petName): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'pet_full',
            'title' => 'Pet Kamu Puas! 😊',
            'message' => "$petName sekarang sudah kenyang dan siap membaca bersama kamu.",
            'is_read' => false,
        ]);
    }

    /**
     * Create new book available notification
     */
    public static function notifyNewBook(int $userId, string $bookTitle, string $author): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'book_available',
            'title' => 'Buku Baru Tersedia! ✨',
            'message' => "\"$bookTitle\" karya $author kini tersedia di Biblo. Jangan lewatkan!",
            'is_read' => false,
        ]);
    }

    /**
     * Create promotion notification
     */
    public static function notifyPromotion(int $userId, string $title, string $message): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'promotion',
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }

    /**
     * Create review like notification
     */
    public static function notifyReviewLike(int $userId, string $reviewerName, string $bookTitle, int $likeCount): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'review_like',
            'title' => 'Review Kamu Disukai! ❤️',
            'message' => "Review kamu tentang \"$bookTitle\" mendapatkan $likeCount suka.",
            'is_read' => false,
        ]);
    }

    /**
     * Create achievement notification
     */
    public static function notifyAchievement(int $userId, string $achievementName): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => 'achievement',
            'title' => 'Achievement Unlock! 🏆',
            'message' => "Kamu telah membuka achievement: $achievementName",
            'is_read' => false,
        ]);
    }

    /**
     * Keep notification unread on user preference
     */
    public static function createGeneric(int $userId, string $type, string $title, string $message): UserNotification
    {
        return UserNotification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }
}
