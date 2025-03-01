<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'search_parameters'];

    protected $casts = [
        'search_parameters' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
