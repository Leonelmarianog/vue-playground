<?php

namespace Modules\Auth\Infrastructure\Models;

use Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    /** @use HasFactory<MemberFactory> */
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass-assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'email',
        'avatar_url',
        'bio',
    ];

    /**
     * Links to the factory for this model.
     */
    protected static function newFactory(): MemberFactory
    {
        return MemberFactory::new();
    }
}
