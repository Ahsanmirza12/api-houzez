<?php

namespace App\Repositories;

interface SavedSearchRepositoryInterface
{
  public function getUserSavedSearches();
  public function saveSearch(array $data);
  public function deleteSavedSearch($id);
}
