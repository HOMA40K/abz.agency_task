<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Firebase\JWT\JWT;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'picture_path',
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
    public static function createToken(string $userId, string $user): string
    {
        $key = env('JWT_SECRET', 'your_secret_key');
        $payload = [
            'iss' => env('JWT_ISSUER', 'your_issuer'),
            'aud' => env('JWT_AUDIENCE', 'your_audience'),
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600, // Token valid for 1 hour
            'sub' => $userId,
            'userMail' => $user,
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }


}
