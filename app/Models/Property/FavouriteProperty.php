<?php

namespace App\Models\Property;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FavouriteProperty extends Model
{
    protected $fillable = ['user_id', 'property_id'];
    protected $table = 'favorites';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }
}
