<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Channel\ChannelRepository;
use Exception;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public $channelRepository;

    public function __construct(ChannelRepository $channelRepository) {
        $this->channelRepository = $channelRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->channelRepository->getAll($request));
    }

    public function store(ChannelRequest $request)
    {
        try {
            $channel = $this->channelRepository->create($request);
            return new SuccessResource($channel);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->channelRepository->getById((int) $id));
    }

    public function update(ChannelRequest $request, $id)
    {
        try {
            $channel = $this->channelRepository->update($request, (int) $id);
            return new SuccessResource($channel);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $channel = $this->channelRepository->delete((int) $id);
            return new SuccessResource($channel);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
