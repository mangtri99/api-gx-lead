<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Media\MediaRepository;
use Exception;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public $mediaRepository;

    public function __construct(MediaRepository $mediaRepository) {
        $this->mediaRepository = $mediaRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->mediaRepository->getAll($request));
    }

    public function store(MediaRequest $request)
    {
        try {
            $probability = $this->mediaRepository->create($request);
            return new SuccessResource($probability);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->mediaRepository->getById((int) $id));
    }

    public function update(MediaRequest $request, $id)
    {
        try {
            $probability = $this->mediaRepository->update($request,(int) $id);
            return new SuccessResource($probability);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $channel = $this->mediaRepository->delete((int) $id);
            return new SuccessResource($channel);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
