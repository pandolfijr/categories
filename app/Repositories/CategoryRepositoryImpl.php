<?php

namespace App\Repositories;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;

use App\Interfaces\Repository\CategoryRepository;

use App\Models\Category;

class CategoryRepositoryImpl implements CategoryRepository
{
    /**
     *
     * @return \App\Helpers\Result
     */
    public function getCategories(): Result
    {
        try {
            $categories = Category::with('subcategories')->orderBy('id')->get();
            if ($categories->isEmpty()) {
                return Result::error(
                    new ErrorApplication(
                        'CategoryRepositoryImpl > getCategories',
                        'Nenhuma categoria encontrada',
                        404,
                    )
                );
            }
            return Result::success(['categories' => $categories]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CategoryRepositoryImpl > getCategories',
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
    public function saveCategory(array $input): Result
    {
        try {
            $category = Category::create($input);
            if (!$category) {
                return Result::error(
                    new ErrorApplication(
                        'CategoryRepositoryImpl > saveCategory',
                        'Erro ao salvar categoria',
                        404,
                    )
                );
            }
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CategoryRepositoryImpl > saveCategory',
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
    public function updateCategory(array $input, string $id): Result
    {
        try {
            $result = Category::where('id', $id)->first();
            $result->fill($input);
            $category = $result->save();
            if (!$category) {
                return Result::error(
                    new ErrorApplication(
                        'CategoryRepositoryImpl > updateCategory',
                        'Erro ao alterar categoria',
                        404,
                    )
                );
            }
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CategoryRepositoryImpl > updateCategory',
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
    public function getCategoryById(string $id): Result
    {
        try {
            $category = Category::with('subcategories')->where('id', $id)->first();
            if (!$category) {
                return Result::error(
                    new ErrorApplication(
                        'CategoryRepositoryImpl > getCategoryById',
                        'Nenhuma categoria encontrada',
                        404,
                    )
                );
            }
            return Result::success(['category' => $category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CategoryRepositoryImpl > getCategoryById',
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
    public function getCategoryByName(string $name): Result
    {
        try {
            $category = Category::where('name', $name)->first();
            if (!empty($category)) {
                return Result::error(
                    new ErrorApplication(
                        'CategoryRepositoryImpl > getCategoryByName',
                        'Já existe uma categoria com o nome informado',
                        409,
                    )
                );
            }
            return Result::success(['category' => $category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CategoryRepositoryImpl > getCategoryByName',
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
    public function deleteCategoryById(string $id): Result
    {
        try {
            $category = Category::where('id', $id)->first();
            if (!$category) {
                return Result::error(
                    new ErrorApplication(
                        'CategoryRepositoryImpl > deleteCategoryById',
                        'Nenhuma categoria encontrada para deletar',
                        404,
                    )
                );
            }
            $category->delete();
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CategoryRepositoryImpl > deleteCategoryById',
                    'Ocorreu um erro: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
