<x-app-layout>
    <div class="dashboard-page dashboard-notification max-w-4xl mx-auto space-y-6 sm:space-y-8">
        
        <section class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-biblo-charcoal">Notifikasi</h1>
                <p class="text-biblo-charcoal/50 text-sm mt-1">Pantau aktivitas terbaru dan pembaruan buku favoritmu.</p>
            </div>
            
            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                <form action="{{ route('notification.markAllAsRead') }}" method="POST" class="w-full md:w-auto">
                    @csrf
                    <button type="submit" class="bg-biblo-charcoal text-white px-4 sm:px-5 py-2 rounded-full text-[11px] sm:text-xs font-bold hover:bg-biblo-charcoal/90 transition-all whitespace-nowrap w-full md:w-auto">
                        Tandai Semua Dibaca
                    </button>
                </form>
            </div>
        </section>

        <div class="space-y-4">
            @if($notifications->isEmpty())
                <div class="text-center py-12 text-biblo-charcoal/50">
                    <p class="text-sm">Belum ada notifikasi. Mulai membaca buku untuk mendapatkan notifikasi!</p>
                </div>
            @else
                @foreach($notifications as $notification)
                <div class="group relative transition-all mark-as-read-card {{ !$notification->is_read ? 'bg-white border border-biblo-moss/30 shadow-sm' : 'bg-biblo-cream/20 border border-biblo-greige/10' }} rounded-[24px] sm:rounded-[2.5rem] p-4 sm:p-6 cursor-pointer" data-notification-id="{{ $notification->id }}">
                    <form method="POST" action="{{ route('notification.mark-as-read', $notification->id) }}" class="hidden mark-as-read-form"></form>
                    
                    <div class="flex gap-3 sm:gap-5 items-start">
                        <div class="flex-shrink-0 w-12 h-12 {{ !$notification->is_read ? 'bg-biblo-moss/10' : 'bg-biblo-greige/20' }} rounded-2xl flex items-center justify-center text-xl">
                            @php
                                $icons = [
                                    'book_completed' => '📖',
                                    'level_up' => '⬆️',
                                    'pet_hungry' => '🍲',
                                    'pet_hungry_hungry' => '😫',
                                    'pet_full' => '😊',
                                    'new_book' => '✨',
                                    'book_available' => '📚',
                                    'review_like' => '❤️',
                                    'achievement' => '🏆',
                                    'promotion' => '🏷️',
                                    'promo' => '🏷️',
                                    'update' => '📖',
                                    'social' => '❤️',
                                    'reminder' => '⏳',
                                ];
                            @endphp
                            {{ $icons[$notification->type] ?? '📬' }}
                        </div>

                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1">
                                <h4 class="font-bold text-biblo-charcoal {{ !$notification->is_read ? 'text-base' : 'text-sm text-biblo-charcoal/60' }}">
                                    {{ $notification->title }}
                                </h4>
                                <span class="text-[10px] font-medium text-biblo-charcoal/30 uppercase tracking-wider">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm {{ !$notification->is_read ? 'text-biblo-charcoal/60' : 'text-biblo-charcoal/40' }} leading-relaxed">
                                {{ $notification->message }}
                            </p>
                        </div>

                        @if(!$notification->is_read)
                        <div class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2">
                            <div class="w-2.5 h-2.5 bg-biblo-moss rounded-full shadow-[0_0_10px_rgba(126,143,122,0.5)]"></div>
                        </div>
                        @endif
                    </div>

                    <div class="hidden sm:flex absolute inset-y-0 right-4 items-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="delete-notification-btn p-2 text-biblo-charcoal/20 hover:text-red-500 transition-colors" data-notification-id="{{ $notification->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mark as read on click
            document.querySelectorAll('.mark-as-read-card').forEach(card => {
                card.addEventListener('click', async function(e) {
                    if (e.target.closest('.delete-notification-btn')) return;
                    
                    const notificationId = this.dataset.notificationId;
                    const form = this.querySelector('.mark-as-read-form');
                    
                    try {
                        const response = await fetch("/notification/" + notificationId + "/read", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        });
                        
                        const data = await response.json();
                        if (data.success) {
                            // Update styling
                            this.classList.remove('bg-white', 'border-biblo-moss/30', 'shadow-sm');
                            this.classList.add('bg-biblo-cream/20', 'border-biblo-greige/10');
                            
                            // Hide read indicator
                            const indicator = this.querySelector('.w-2\\.5');
                            if (indicator) indicator.remove();
                            
                            // Update text color
                            const title = this.querySelector('h4');
                            if (title) {
                                title.classList.remove('text-base');
                                title.classList.add('text-sm', 'text-biblo-charcoal/60');
                            }
                            
                            const desc = this.querySelector('p');
                            if (desc) {
                                desc.classList.remove('text-biblo-charcoal/60');
                                desc.classList.add('text-biblo-charcoal/40');
                            }
                        }
                    } catch (error) {
                        console.error('Error marking notification as read:', error);
                    }
                });
            });
            
            // Delete notification
            document.querySelectorAll('.delete-notification-btn').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (!confirm('Hapus notifikasi ini?')) return;
                    
                    const notificationId = this.dataset.notificationId;
                    const card = this.closest('.mark-as-read-card');
                    
                    try {
                        const response = await fetch("/notification/" + notificationId, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        });
                        
                        const data = await response.json();
                        if (data.success) {
                            card.style.opacity = '0';
                            setTimeout(() => card.remove(), 300);
                        }
                    } catch (error) {
                        console.error('Error deleting notification:', error);
                    }
                });
            });
        });
    </script>
</x-app-layout>