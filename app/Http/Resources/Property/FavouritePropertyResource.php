<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouritePropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $firstImage = $this->property->images->first(); // Get the first image
    
        return [
            'thumbnail' => is_object($firstImage) ? $firstImage->image_path : null, // Ensure it's an object
            'title' => $this->property->title ?? 'N/A',
            'address' => $this->property->address ?? 'N/A',
            'type' => $this->property->type ?? 'N/A',
            'status' => $this->property->status ?? 'N/A',
            'price' => $this->property->price ?? 0,
            'featured' => $this->property->featured ?? false,
        ];
    }
    
    


}
