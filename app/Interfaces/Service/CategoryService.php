<?php

namespace App\Interfaces\Service;

use App\Helpers\Result;

interface CategoryService
{
    public function getCategories(): Result;
    public function saveCategory(array $input): Result;
    public function updateCategory(array $input, string $id): Result;
    public function getCategoryById(string $id): Result;
    public function deleteCategoryById(string $id): Result;
}
