<?php

namespace App\Repositories;

interface SavedSearchRepositoryInterface
{
    public function getUserSavedSearches($userId, $searchParameters = null);
    public function saveSearch($userId, array $searchParameters);
    public function deleteSavedSearch($id);
}
