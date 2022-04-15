<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// model
use App\Models\JobCategory;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class JobCategoryController  extends Controller
{
    /**
     * 職種 一覧取得
     *
     * @param  JobCategoryListRequest $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        // oasのリクエストモデルに変換
        $parameters = new OpenAPI\Model\QueryJobCategoryList($request->all());

        // メインロジック
        $name = $parameters->getName();
        $content = $parameters->getContent();
        $items = JobCategory::when(isset($name), function ($query) use ($name) {
            return $query->where('name', 'like', "%$name%");
        })->when(isset($content), function ($query) use ($content) {
            return $query->where('content', 'like', "%$content%");
        })->orderBy('sort_no')->get()->toArray();

        # oasのレスポンスモデルに変換して返す。
        return response()->json(
            OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\JobCategory::class, $items),
            Response::HTTP_OK
        );
    }
}
