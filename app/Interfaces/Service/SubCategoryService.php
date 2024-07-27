<?php

namespace App\Interfaces\Service;

use App\Helpers\Result;

interface SubCategoryService
{
    public function getSubCategories(): Result;
    public function saveSubCategory(array $input): Result;
    public function updateSubCategory(array $input, string $id): Result;
    public function getSubCategoryById(string $id): Result;
    public function deleteSubCategoryById(string $id): Result;
}
