<?php

namespace App\Mail;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GalleryReactionNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $gallery;
    protected $user;
    protected $reaction;

    /**
     * Create a new message instance.
     *
     * @param Gallery $gallery
     * @param User $user
     * @param string $reaction
     * @return void
     */
    public function __construct(Gallery $gallery, User $user, string $reaction)
    {
        $this->gallery = $gallery;
        $this->user = $user;
        $this->reaction = $reaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /**
         * Use blade template to provide content for the email.
         * For content, provide data about gallery, user and reaction (like/dislike).
         */
        return $this->subject('New Reaction on Your Gallery')
                    ->markdown('emails.gallery_reaction_notification', [
                        'gallery' => $this->gallery,
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'reaction' => $this->reaction,
                    ]);
    }
}
