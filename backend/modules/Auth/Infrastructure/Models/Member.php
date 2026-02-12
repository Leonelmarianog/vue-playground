<?php

namespace Modules\Auth\Infrastructure\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Auth\Infrastructure\Database\Factories\MemberFactory;

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

    protected static function newFactory(): MemberFactory
    {
        return MemberFactory::new();
    }
}
