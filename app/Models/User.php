<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Webpatser\Uuid\Uuid;

/**
 * @property string $id
 * @property string $role
 * @property string $password
 * @method static create(array $array)
 * @method static whereHas(string $string, \Closure $param)
 * @method static find($id)
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'position_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier(): string
    {
        return $this->id;
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'position_id', 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(User::class, 'position_id', 'id');
    }

}
