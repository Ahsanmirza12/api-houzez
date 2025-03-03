<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SavedSearchRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SavedSearchController extends Controller
{
    protected $savedSearchRepo;

    public function __construct(SavedSearchRepository $savedSearchRepo)
    {
        $this->savedSearchRepo = $savedSearchRepo;
    }

    // ✅ Get all saved searches for logged-in user
    public function index(): JsonResponse
{
    $userId = Auth::id(); // ✅ Logged-in user ka ID lein
    return response()->json([
        'saved_searches' => $this->savedSearchRepo->getUserSavedSearches($userId),
    ]);
}


    // ✅ Save a new search
    public function store(Request $request): JsonResponse
{
    $userId = Auth::id(); // ✅ Get logged-in user ID

    $request->validate([
        'search_parameters' => 'required|array',
    ]);

    // ✅ Directly save search without checking if it already exists
    $savedSearch = $this->savedSearchRepo->saveSearch($userId, $request->search_parameters);

    return response()->json([
        'message' => 'Search saved successfully',
        'data' => $savedSearch,
    ], 201); // HTTP 201 Created
}


    // ✅ Delete a saved search
    public function destroy($id): JsonResponse
    {
        $this->savedSearchRepo->deleteSavedSearch($id);
        return response()->json(['message' => 'Search deleted successfully']);
    }
}
