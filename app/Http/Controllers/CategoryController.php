<?php

namespace App\Http\Controllers;

use App\Constants\Tables;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Optimus\Bruno\EloquentBuilderTrait;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class CategoryController extends Controller
{
    use EloquentBuilderTrait;

    public function panel_index(EventRequest $request): JsonResponse
    {
        $queryResource = Category::query();
        $queryResource = $queryResource->orderBy(Tables::STAGESHINE_CATEGORIES. '.created_at','DESC');

        $total = $queryResource->count();

        $resourceOptions = $this->parseResourceOptions();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
        $parsedData = $this->parseData($list, $resourceOptions);

        Log::info('[StageShineCategoryController][panel_index] the stage-shine categories have been listed');

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    public function index(): JsonResponse
    {
//        $queryResource = Category::getLatestEvents();
        $queryResource = Category::query();
        $total = $queryResource->count();
        $resourceOptions = $this->parseResourceOptions();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
//        $list->makeHidden(['max_books','max_audios','remain_audios','remain_books']);
        $parsedData = $this->parseData($list, $resourceOptions);
        Log::info('[StageShineCategoryController][index] the stage-shine categories has been listed');

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    public function store(EventRequest $request)
    {
        try {
            $inputs = $request->all();
            $event = Category::create($inputs);
        } catch (\Exception $err) {
            Log::error('[StageShineCategoryController][store] throw exception');
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        Log::info('[StageShineCategoryController][store] the stage-shine category has been stored');
        return new JsonResponse(['data'=> $event ],ResponseCode::HTTP_CREATED );
    }

    public function show(int $id)
    {
        try{
            $event = Category::findOrFail($id);
        } catch (\Exception $err) {
            Log::error('[StageShineCategoryController][show] throw exception');
            return new JsonResponse( ['data'=>['status' => 'failed','message' => $err->getMessage()]] ,ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[StageShineCategoryController][show] the stage-shine category has been showed');
        return new JsonResponse( ['data' => $event] ,ResponseCode::HTTP_OK);
    }

    public function update(EventRequest $request, int $id)
    {
        try {
            $event = Category::findOrFail($id);
            $event->update($request->all());
        } catch (\Exception $err){
            Log::error('[StageShineCategoryController][update] throw exception');
            return new JsonResponse( ['data'=>['status' => 'failed','message' => $err->getMessage()]],ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[StageShineCategoryController][update] the subscription category has been updated');
        return new JsonResponse(['data' => $event],ResponseCode::HTTP_OK );
    }
}
