<?php

namespace App\Repositories;

use App\Models\SavedSearch;
use Illuminate\Support\Facades\Auth;

class SavedSearchRepository implements SavedSearchRepositoryInterface
{
    // ✅ Get user saved searches (optimized)
    public function getUserSavedSearches($userId, $searchParameters = null)
    {
        $query = SavedSearch::where('user_id', $userId);

        if ($searchParameters) {
            $query->whereJsonContains('search_parameters', $searchParameters);
        }

        return $query->first(); // ✅ Fetch first matching search
    }

    // ✅ Save a new search (fixed parameters handling)
    public function saveSearch($userId, array $searchParameters)
    {
        return SavedSearch::create([
            'user_id' => $userId,
            'search_parameters' => json_encode($searchParameters), // ✅ Ensure JSON format
        ]);
    }

    // ✅ Delete a saved search
    public function deleteSavedSearch($id)
    {
        return SavedSearch::where('user_id', Auth::id())->where('id', $id)->delete();
    }
}
