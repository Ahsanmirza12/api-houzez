<?php

namespace App\Models\Property;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    //
     //
     use HasFactory;

     protected $fillable = ['setting_type', 'agents'];
 
     protected $casts = [
         'agents' => 'array', // Automatically cast JSON to an array
     ];
     public function property()
 {
     return $this->belongsTo(Property::class, 'property_id');
 }
}
