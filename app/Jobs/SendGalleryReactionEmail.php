<?php

namespace App\Jobs;

use App\Mail\GalleryReactionNotification;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendGalleryReactionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param Gallery $gallery
     * @param User $user
     * @param string $reaction
     * @return void
     */
    public function __construct(
        protected readonly Gallery $gallery,
        protected readonly User $user,
        protected readonly string $reaction
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
         * Trigger sending of an email notification to creator of gallery.
         * Email notification is describing which user has liked or disliked creator's gallery.
         */
        Mail::to($this->gallery->creator->email)
            ->send(
                new GalleryReactionNotification($this->gallery, $this->user, $this->reaction)
            );
    }
}
