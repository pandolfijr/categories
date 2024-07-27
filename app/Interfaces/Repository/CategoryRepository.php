<?php

namespace App\Interfaces\Repository;

use App\Helpers\Result;

interface CategoryRepository
{
    public function getCategories(): Result;
    public function saveCategory(array $input): Result;
    public function updateCategory(array $input, string $id): Result;
    public function getCategoryById(string $id): Result;
    public function getCategoryByName(string $name): Result;
    public function deleteCategoryById(string $id): Result;
}
