<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Resources\Property\FavouritePropertyResource;
use App\Repositories\FavoritePropertyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavouritePropertyConroller extends Controller
{
    protected $favoritePropertyRepository;

    public function __construct(FavoritePropertyRepositoryInterface $favoritePropertyRepository)
    {
        $this->favoritePropertyRepository = $favoritePropertyRepository;
    }

    /**
     * Add a property to favorites
     */
    public function store(Request $request, $propertyId)
    {
        $userId = Auth::id();
        $existingFavorite = $this->favoritePropertyRepository->getUserFavorite($userId, $propertyId);

    if ($existingFavorite) {
        return response()->json([
            'message' => 'Already added to favorite properties',
            'data' => $existingFavorite
        ], 409); // HTTP 409 Conflict
    }

        $favorite = $this->favoritePropertyRepository->addToFavorites($userId, $propertyId);

        return response()->json([
            'message' => 'Property added to favorites',
            'data' => $favorite
        ], 201);
    }

    /**
     * Remove a property from favorites
     */
    public function destroy($propertyId)
    {
        $userId = Auth::id();

        $this->favoritePropertyRepository->removeFromFavorites($userId, $propertyId);

        return response()->json([
            'message' => 'Property removed from favorites',
        ]);
    }

    /**
     * Get user's favorite properties
     */
    public function index()
{
    $userId = Auth::id(); // Get authenticated user ID
    
    $favorites = $this->favoritePropertyRepository->getUserFavorites($userId);
   
    return FavouritePropertyResource::collection($favorites);
}

}
