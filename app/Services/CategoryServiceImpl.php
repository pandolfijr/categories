<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;

use App\Interfaces\Repository\CategoryRepository;
use App\Interfaces\Repository\SubCategoryRepository;

use App\Interfaces\Service\CategoryService;

class CategoryServiceImpl implements CategoryService
{
    private $categoryRepository;
    private $subCategoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    /**
     *
     * @return \App\Helpers\Result
     */
    public function getCategories(): Result
    {
        return $this->categoryRepository->getCategories();
    }

    /**
     *
     * @param array $input
     * @return \App\Helpers\Result
     */
    public function saveCategory(array $input): Result
    {
        $result = $this->categoryRepository->getCategoryByName($input['name']);
        if (!$result->isSuccess()) {
            return Result::error(
                new ErrorApplication(
                    'CategoryServiceImpl > saveCategory',
                    $result->getError()->getMessage(),
                    $result->getError()->getCode(),
                )
            );
        }
        return $this->categoryRepository->saveCategory($input);
    }

    /**
     *
     * @param array $input
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function updateCategory(array $input, string $id): Result
    {
        return $this->categoryRepository->updateCategory($input, $id);
    }

    /**
     *
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function getCategoryById(string $id): Result
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    /**
     *
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function deleteCategoryById(string $id): Result
    {
        $result = $this->subCategoryRepository->getLinkedCategory($id);
        if (!$result->isSuccess()) {
            return Result::error(
                new ErrorApplication(
                    'CategoryServiceImpl > deleteCategoryById',
                    'Você não pode remover esta categoria, pois a mesma possui sub-categoria(s) associada(s)',
                    $result->getError()->getCode(),
                )
            );
        }
        return $this->categoryRepository->deleteCategoryById($id);
    }
}
