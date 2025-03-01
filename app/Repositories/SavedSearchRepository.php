<?php

namespace App\Repositories;

use App\Models\SavedSearch;
use Illuminate\Support\Facades\Auth;

class SavedSearchRepository implements SavedSearchRepositoryInterface
{
    public function getUserSavedSearches()
    {
        return SavedSearch::where('user_id', Auth::id())->get();
    }

    public function saveSearch(array $data)
    {
        return SavedSearch::create([
            'user_id' => Auth::id(),
            'search_parameters' => $data,
        ]);
    }

    public function deleteSavedSearch($id)
    {
        return SavedSearch::where('user_id', Auth::id())->where('id', $id)->delete();
    }
}
