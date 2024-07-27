<?php

namespace App\Http\Controllers;

use App\Interfaces\Service\SubCategoryService;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    private $subCategoryService;

    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }
    public function index()
    {
        try {
            $result = $this->subCategoryService->getSubCategories();
            if (!$result->isSuccess())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            $sub_categories = $result->getData()['sub_categories'];
            return response()->json(['sub_categories' => $sub_categories], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'string|required|max:50',
                'category_id' => 'required',
            ]);
            $input = $request->all();
            $result = $this->subCategoryService->saveSubCategory($input);
            if (!$result->isSuccess())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            return response()->json(['message' => 'Sub-Categoria salva com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        if (empty($id)) return response()->json(['message' => 'Você precisa informar o id da sub-categoria'], 400);
        try {
            $result = $this->subCategoryService->getSubCategoryById($id);
            if (!$result->isSuccess())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            $sub_category = $result->getData()['sub_category'];
            return response()->json(['sub_category' => $sub_category], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $sub_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        if (empty($id)) return response()->json(['message' => 'Você precisa informar o id da sub-categoria'], 400);
        try {
            $input = $request->all();
            $result = $this->subCategoryService->updateSubCategory($input, $id);
            if (!$result->isSuccess())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            return response()->json(['message' => 'Sub-categoria alterada com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $result = $this->subCategoryService->deleteSubCategoryById($id);
            if (!$result->isSuccess())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            return response()->json(['message' => 'Sub-categoria deletada com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
