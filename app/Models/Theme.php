<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    /** @use HasFactory<\Database\Factories\ThemeFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'data',
        'data_dark'
    ];
    protected $casts = [
    'data' => 'array',
    'data_dark' => 'array',
];

public function user()
{
    return $this->belongsTo(User::class);
}
}
