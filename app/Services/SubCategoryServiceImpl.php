<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;

use App\Interfaces\Repository\CategoryRepository;
use App\Interfaces\Repository\SubCategoryRepository;

use App\Interfaces\Service\SubCategoryService;

class SubCategoryServiceImpl implements SubCategoryService
{
    private $subCategoryRepository;
    private $categoryRepository;

    public function __construct(
        SubCategoryRepository $subCategoryRepository,
        CategoryRepository $categoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     *
     * @return \App\Helpers\Result
     */
    public function getSubCategories(): Result
    {
        return $this->subCategoryRepository->getSubCategories();
    }

    /**
     * @param array $input
     * @return \App\Helpers\Result
     */
    public function saveSubCategory(array $input): Result
    {
        $result = $this->subCategoryRepository->getSubCategoryByName($input['name']);
        if (!$result->isSuccess()) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryServiceImpl > saveSubCategory -> getSubCategoryByName',
                    $result->getError()->getMessage(),
                    $result->getError()->getCode(),
                )
            );
        }

        $result_category = $this->categoryRepository->getCategoryByid($input['category_id']);
        if (!$result_category->isSuccess()) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryServiceImpl > saveSubCategory > getCategoryByid',
                    'Não foi encontrada uma categoria com o ID especificado',
                    $result_category->getError()->getCode(),
                )
            );
        }
        return $this->subCategoryRepository->saveSubCategory($input);
    }

    /**
     *
     * @param array $input
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function updateSubCategory(array $input, string $id): Result
    {
        $result_category = $this->subCategoryRepository->getSubCategoryByid($id);
        if (!$result_category->isSuccess()) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryServiceImpl > updateSubCategory > getSubCategoryByid',
                    'Não existe nenhuma sub-categoria com o id informado',
                    $result_category->getError()->getCode(),
                )
            );
        }
        return $this->subCategoryRepository->updateSubCategory($input, $id);
    }

    /**
     *
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function getSubCategoryById(string $id): Result
    {
        return $this->subCategoryRepository->getSubCategoryById($id);
    }

    /**
     *
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function deleteSubCategoryById(string $id): Result
    {
        return $this->subCategoryRepository->deleteSubCategoryById($id);
    }
}
