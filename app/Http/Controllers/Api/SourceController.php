<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SourceRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Source\SourceRepository;
use Exception;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public $sourceRepository;

    public function __construct(SourceRepository $sourceRepository) {
        $this->sourceRepository = $sourceRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->sourceRepository->getAll($request));
    }

    public function store(SourceRequest $request)
    {
        try {
            $source = $this->sourceRepository->create($request);
            return new SuccessResource($source);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->sourceRepository->getById((int) $id));
    }

    public function update(SourceRequest $request, $id)
    {
        try {
            $source = $this->sourceRepository->update($request, (int) $id);
            return new SuccessResource($source);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $source = $this->sourceRepository->delete((int) $id);
            return new SuccessResource($source);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
