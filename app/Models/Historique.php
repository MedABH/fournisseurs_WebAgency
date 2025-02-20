<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'login_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Empêcher les doublons avant l'insertion
    public static function boot()
    {
        parent::boot();

        static::creating(function ($historique) {
            $exists = self::where('user_id', $historique->user_id)
                ->where('login_at', $historique->login_at)
                ->exists();

            if ($exists) {
                return false; // Annule la création si un doublon existe
            }
        });
    }
}
