<?php

namespace App\Repositories;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;

use App\Interfaces\Repository\SubCategoryRepository;

use App\Models\SubCategory;

class SubCategoryRepositoryImpl implements SubCategoryRepository
{
    /**
     *
     * @return \App\Helpers\Result
     */
    public function getSubCategories(): Result
    {
        try {
            $sub_categories = SubCategory::with('category')->orderBy('id')->get();
            if ($sub_categories->isEmpty()) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > getSubCategories',
                        'Nenhuma sub-categoria encontrada',
                        404,
                    )
                );
            }
            return Result::success(['sub_categories' => $sub_categories]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > getSubCategories',
                    'Ocorreu um erro:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param array $input
     * @return \App\Helpers\Result
     */
    public function saveSubCategory(array $input): Result
    {
        try {
            $sub_category = SubCategory::create($input);
            if (!$sub_category) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > saveSubCategory',
                        'Erro ao salvar sub-Categoria',
                        400,
                    )
                );
            }
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > saveSubCategory',
                    'Ocorreu um erro:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param array $input
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function updateSubCategory(array $input, string $id): Result
    {
        try {
            $result = SubCategory::where('id', $id)->first();
            $result->fill($input);
            $sub_category = $result->save();
            if (!$sub_category) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > updateSubCategory',
                        'Erro ao alterar sub-categoria',
                        400,
                    )
                );
            }
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > updateSubCategory',
                    'Ocorreu um erro:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function getSubCategoryById(string $id): Result
    {
        try {
            $sub_category = SubCategory::with('category')->where('id', $id)->first();
            if (!$sub_category) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > getSubCategoryById',
                        'Nenhuma sub-categoria encontrada',
                        404,
                    )
                );
            }
            return Result::success(['sub_category' => $sub_category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > getSubCategoryById',
                    'Ocorreu um erro:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param string $name
     * @return \App\Helpers\Result
     */
    public function getSubCategoryByName(string $name): Result
    {
        try {
            $sub_category = SubCategory::where('name', $name)->first();
            if (!empty($sub_category)) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > getSubCategoryByName',
                        'Já existe uma sub-categoria com o nome informado',
                        409,
                    )
                );
            }
            return Result::success(['sub_category' => $sub_category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > getSubCategoryByName',
                    'Ocorreu um erro:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param string $id
     * @return \App\Helpers\Result
     */
    public function deleteSubCategoryById(string $id): Result
    {
        try {
            $sub_category = SubCategory::where('id', $id)->first();
            if (!$sub_category) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > deleteSubCategoryById',
                        'Nenhuma sub-categoria encontrada para deletar',
                        404,
                    )
                );
            }
            $sub_category->delete();
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > deleteSubCategoryById',
                    'Ocorreu um erro: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param string $name
     * @return \App\Helpers\Result
     */
    public function getLinkedCategory(string $category_id): Result
    {
        try {
            $sub_category = SubCategory::where('category_id', $category_id)->exists();
            if ($sub_category) {
                return Result::error(
                    new ErrorApplication(
                        'SubCategoryRepositoryImpl > getLinkedCategory',
                        'Já existe uma sub-categoria com o nome informado',
                        409,
                    )
                );
            }
            return Result::success(['sub_category' => $sub_category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'SubCategoryRepositoryImpl > getLinkedCategory',
                    'Ocorreu um erro:' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
