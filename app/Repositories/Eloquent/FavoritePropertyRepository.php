<?php

namespace App\Repositories\Eloquent;
use App\Models\FavouriteProperty;
use App\Repositories\FavoritePropertyRepositoryInterface;
use Illuminate\Support\Collection;

class FavoritePropertyRepository implements FavoritePropertyRepositoryInterface
{
    /**
     * Add a property to favorites
     */
    public function getUserFavorite(int $userId, int $propertyId)
{
    return FavouriteProperty::where('user_id', $userId)
        ->where('property_id', $propertyId)
        ->first();
}

    public function addToFavorites(int $userId, int $propertyId): FavouriteProperty
    {
        return FavouriteProperty::firstOrCreate([
            'user_id' => $userId,
            'property_id' => $propertyId,
        ]);
    }

    /**
     * Remove a property from favorites
     */
    public function removeFromFavorites(int $userId, int $propertyId): bool
    {
        return FavouriteProperty::where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->delete() > 0;
    }

    /**
     * Get a list of user's favorite properties
     */
    public function getUserFavorites(int $userId): Collection
{
    return FavouriteProperty::where('user_id', $userId)
        ->with(['property' => function ($query) {
            $query->with(['images' => function ($imageQuery) {
                $imageQuery->where('is_thumbnail', 1); // Only fetch the thumbnail
            }]);
        }])
        ->get();
}

}
