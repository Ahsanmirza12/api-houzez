<?php
namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SavedSearchRepository;
use Illuminate\Database\Eloquent\Casts\Json;
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
    public function index()
    {
        return response()->json([
            'saved_searches' => $this->savedSearchRepo->getUserSavedSearches(),
        ]);
    }

    // ✅ Save a new search
   public function store(Request $request): JsonResponse
{
    $userId = Auth::id(); // ✅ Get logged-in user ID

    $request->validate([
        'search_parameters' => 'required|array',
    ]);

    // ✅ Check if search already exists
    $existingSearch = $this->savedSearchRepo->getUserSavedSearches($userId, $request->search_parameters);

    if ($existingSearch) {
        return response()->json([
            'message' => 'Search already exists',
            'data' => $existingSearch,
        ], 409); // HTTP 409 Conflict
    }

    // ✅ Save search if not already saved
    $savedSearch = $this->savedSearchRepo->saveSearch($userId, $request->search_parameters);

    return response()->json([
        'message' => 'Search saved successfully',
        'data' => $savedSearch,
    ], 201); // HTTP 201 Created
}


    // ✅ Delete a saved search
    public function destroy($id)
    {
        $this->savedSearchRepo->deleteSavedSearch($id);
        return response()->json(['message' => 'Search deleted successfully']);
        
    }
}
