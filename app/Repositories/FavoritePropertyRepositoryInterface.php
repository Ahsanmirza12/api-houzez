<?php

namespace App\Repositories;
use App\Models\FavouriteProperty;
use Illuminate\Support\Collection;

interface FavoritePropertyRepositoryInterface
{
    /**
     * Add a property to favorites
     * 
     * @param int $userId
     * @param int $propertyId
     * @return Favorite
     */
    public function addToFavorites(int $userId, int $propertyId): FavouriteProperty;
    public function getUserFavorite(int $userId, int $propertyId);

    /**
     * Remove a property from favorites
     * 
     * @param int $userId
     * @param int $propertyId
     * @return bool
     */
    public function removeFromFavorites(int $userId, int $propertyId): bool;

    /**
     * Get a list of user's favorite properties
     * 
     * @param int $userId
     * @return Collection
     */
    public function getUserFavorites(int $userId): Collection;
}

