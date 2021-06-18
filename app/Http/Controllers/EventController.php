<?php

namespace App\Http\Controllers;

use App\Constants\Tables;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Optimus\Bruno\EloquentBuilderTrait;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class EventController extends Controller
{
    use EloquentBuilderTrait;

    public function panel_index(EventRequest $request): JsonResponse
    {
        $queryResource = Event::query();
        $queryResource = $queryResource->orderBy(Tables::STAGESHINE_EVENTS. '.created_at','DESC');

        $total = $queryResource->count();

        $resourceOptions = $this->parseResourceOptions();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
        $parsedData = $this->parseData($list, $resourceOptions);

        Log::info('[StageShineEventsController][panel_index] the stage-shine events have been listed');

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    public function index(): JsonResponse
    {
//        $queryResource = Event::getLatestEvents();
        $queryResource = Event::query();
        $total = $queryResource->count();
        $resourceOptions = $this->parseResourceOptions();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
//        $list->makeHidden(['max_books','max_audios','remain_audios','remain_books']);
        $parsedData = $this->parseData($list, $resourceOptions);
        Log::info('[StageShineEventsController][index] the stage-shine events has been listed');

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    public function store(EventRequest $request)
    {
        try {
            $inputs = $request->all();
            $event = Event::create($inputs);
        } catch (\Exception $err) {
            Log::error('[StageShineEventsController][store] throw exception');
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        Log::info('[StageShineEventsController][store] the stage-shine event has been stored');
        return new JsonResponse(['data'=> $event ],ResponseCode::HTTP_CREATED );
    }

    public function show(int $id)
    {
        try{
            $event = Event::findOrFail($id);
        } catch (\Exception $err){
            Log::error('[SubscriptionPlansController][show] throw exception');
            return new JsonResponse( ['data'=>['status' => 'failed','message' => $err->getMessage()]] ,ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[StageShineEventsController][show] the stage-shine event has been showed');
        return new JsonResponse( ['data' => $event] ,ResponseCode::HTTP_OK);
    }

    public function update(EventRequest $request, int $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->update($request->all());
        } catch (\Exception $err){
            Log::error('[StageShineEventsController][update] throw exception');
            return new JsonResponse( ['data'=>['status' => 'failed','message' => $err->getMessage()]],ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[StageShineEventsController][update] the subscription event has been updated');
        return new JsonResponse(['data' => $event],ResponseCode::HTTP_OK );
    }

}
