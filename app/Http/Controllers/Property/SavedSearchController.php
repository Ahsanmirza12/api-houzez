<?php
namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SavedSearchRepository;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;

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

        $request->validate([
            'search_parameters' => 'required|array',
        ]);

        $this->savedSearchRepo->saveSearch($request->search_parameters);

        return response()->json(['message' => 'Search saved successfully']);
    }

    // ✅ Delete a saved search
    public function destroy($id)
    {
        $this->savedSearchRepo->deleteSavedSearch($id);
        return response()->json(['message' => 'Search deleted successfully']);
    }
}
