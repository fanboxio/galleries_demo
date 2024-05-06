<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Reaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        parent::boot();

        /**
         * Whenever instance of User model is retrieved from DB,
         * attach 'admin' property which has bool type and it's
         * calculated based on user having 'admin dashboard' permission.
         */
        static::retrieved(function (User $user) {
            $user['admin'] = $user->hasPermissionTo('admin dashboard');
        });

        /**
         * Since 'admin' field is not part of User model and users DB table,
         * we need to remove that field before each saving of user instance into DB
         */
        static::saving(function(User $user) {
            unset($user->admin);
        });

    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'creator_id');
    }

    public function likedGalleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class, 'gallery_reactions')->wherePivot('reaction', Reaction::Like->value);
    }

    public function dislikedGalleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class, 'gallery_reactions')->wherePivot('reaction', Reaction::Dislike->value);
    }

    public function hasLiked(Gallery $gallery): bool
    {
        return $this->likedGalleries->contains($gallery);
    }

    public function hasDisliked(Gallery $gallery): bool
    {
        return $this->dislikedGalleries->contains($gallery);
    }

    /**
     * Since there is unique constraint for gallery_reactions to have unique pair of gallery and user,
     * before saving new like reaction we check if there is already a dislike reaction for same gallery and user pair.
     * If there is already a dislike reaction, we just update that reaction to like.
     */
    public function like(Gallery $gallery): void
    {
        if ($this->hasDisliked($gallery)) {
            $this->dislikedGalleries()->updateExistingPivot($gallery, ['reaction' => Reaction::Like->value]);
            return;
        }

        $this->likedGalleries()->attach($gallery, ['reaction' => Reaction::Like->value]);
    }

    /**
     * Since there is unique constraint for gallery_reactions to have unique pair of gallery and user,
     * before saving new dislike reaction we check if there is already a like reaction for same gallery and user pair.
     * If there is already a like reaction, we just update that reaction to dislike.
     */
    public function dislike(Gallery $gallery): void
    {
        if ($this->hasLiked($gallery)) {
            $this->likedGalleries()->updateExistingPivot($gallery, ['reaction' => Reaction::Dislike->value]);
            return;
        }

        $this->dislikedGalleries()->attach($gallery, ['reaction' => Reaction::Dislike->value]);
    }
}
