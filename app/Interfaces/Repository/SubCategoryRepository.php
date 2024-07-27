<?php

namespace App\Interfaces\Repository;

use App\Helpers\Result;

interface SubCategoryRepository
{
    public function getSubCategories(): Result;
    public function saveSubCategory(array $input): Result;
    public function updateSubCategory(array $input, string $id): Result;
    public function getSubCategoryById(string $id): Result;
    public function getSubCategoryByName(string $name): Result;
    public function deleteSubCategoryById(string $id): Result;
    public function getLinkedCategory(string $category_id): Result;

}
