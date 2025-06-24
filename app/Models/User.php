<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'nrc_no',
        'company',
        'job_title',
        'birth_date',
        'city',
        'state',
        'country',
        'postal_code',
        'profile_picture',
        'is_admin',
        'is_active',
        'is_verified',
        'is_banned',
        'is_deleted',
        'is_email_verified',
        'is_phone_verified',
        'is_two_factor_enabled',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
        'is_banned' => 'boolean',
        'is_deleted' => 'boolean',
        'is_email_verified' => 'boolean',
        'is_phone_verified' => 'boolean',
        'is_two_factor_enabled' => 'boolean',
        'password' => 'hashed',
    ];
}
