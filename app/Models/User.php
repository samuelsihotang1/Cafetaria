<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name_slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        'password' => 'hashed',
    ];

    
  public function getLinks(): array
  {
    $baseUri = '/api/users/' . $this->id;
    
    return [
      'self' => [
        'href' => $baseUri,
        'method' => 'GET',
        'type' => 'application/json',
        'description' => 'Get user details',
      ],
      'update' => [
        'href' => $baseUri . '/update',
        'method' => 'PUT',
        'type' => 'application/json',
        'description' => 'Update user details',
      ],
      'delete' => [
        'href' => $baseUri . '/delete',
        'method' => 'DELETE',
        'type' => 'application/json',
        'description' => 'Delete user',
      ],
    ];
  }
}
