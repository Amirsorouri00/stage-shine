<?php

namespace App\Http\Controllers;

use App\Constants\Tables;
use App\Http\Requests\EventRequest;
use App\Models\Channel;
use App\Models\ChannelFollower;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Optimus\Bruno\EloquentBuilderTrait;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class ChannelFollowersController extends Controller
{
    use EloquentBuilderTrait;

    public function panel_index(EventRequest $request): JsonResponse
    {
        $queryResource = ChannelFollower::query()
            ->join(Tables::STAGESHINE_USERS, Tables::STAGESHINE_USERS.'.id', '=', Tables::STAGESHINE_CHANNEL_FOLLOWERS.'.user_id')
            ->join(Tables::STAGESHINE_CHANNELS, Tables::STAGESHINE_CHANNELS.'.id', '=', Tables::STAGESHINE_CHANNEL_FOLLOWERS.'.channel_id')
            ->select([
                Tables::STAGESHINE_CHANNELS.'.*',
                Tables::STAGESHINE_USERS.'.*',
                Tables::STAGESHINE_CHANNELS.'.id as channel_id',
            ]);
//        dd($queryResource->get());

//        $queryResource = $queryResource->orderBy(Tables::STAGESHINE_CHANNEL_FOLLOWERS. '.created_at','DESC');

        $total = $queryResource->count();

        $resourceOptions = $this->parseResourceOptions();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
//        dd($list);
        $parsedData = $this->parseData($list, $resourceOptions);

        Log::info('[StageShineChannelFollowersController][panel_index] the stage-shine channel-followers have been listed');

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    public function index(): JsonResponse
    {
//        $queryResource = ChannelFollower::getLatestEvents();
        $queryResource = ChannelFollower::query();
        $total = $queryResource->count();
        $resourceOptions = $this->parseResourceOptions();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
//        $list->makeHidden(['max_books','max_audios','remain_audios','remain_books']);
        $parsedData = $this->parseData($list, $resourceOptions);
        Log::info('[StageShineChannelFollowersController][index] the stage-shine ChannelFollowers has been listed');

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    public function store(EventRequest $request)
    {
        try {
            $inputs = $request->all();
            $channelFollower = ChannelFollower::create($inputs);
        } catch (\Exception $err) {
            Log::error('[StageShineChannelFollowersController][store] throw exception');
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        Log::info('[StageShineChannelFollowersController][store] the stage-shine channel-follower has been stored');
        return new JsonResponse(['data'=> $channelFollower ],ResponseCode::HTTP_CREATED );
    }

    public function show(int $id)
    {
        try{
            $channelFollower = ChannelFollower::findOrFail($id);
        } catch (\Exception $err) {
            Log::error('[StageShineChannelFollowersController][show] throw exception');
            return new JsonResponse( ['data'=>['status' => 'failed','message' => $err->getMessage()]] ,ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[StageShineChannelFollowersController][show] the stage-shine channel-follower has been showed');
        return new JsonResponse( ['data' => $channelFollower] ,ResponseCode::HTTP_OK);
    }

    public function update(EventRequest $request, int $id)
    {
        try {
            $channelFollower = ChannelFollower::findOrFail($id);
            $channelFollower->update($request->all());
        } catch (\Exception $err){
            Log::error('[StageShineChannelFollowersController][update] throw exception');
            return new JsonResponse( ['data'=>['status' => 'failed','message' => $err->getMessage()]],ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[StageShineChannelFollowersController][update] the subscription channel-follower has been updated');
        return new JsonResponse(['data' => $channelFollower],ResponseCode::HTTP_OK );
    }
}
