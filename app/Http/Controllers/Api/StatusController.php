<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Status\StatusRepository;
use Exception;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public $statusRepository;

    public function __construct(StatusRepository $statusRepository) {
        $this->statusRepository = $statusRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->statusRepository->getAll($request));
    }

    public function store(StatusRequest $request)
    {
        try {
            $status = $this->statusRepository->create($request);
            return new SuccessResource($status);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->statusRepository->getById((int) $id));
    }

    public function update(StatusRequest $request, $id)
    {
        try {
            $status = $this->statusRepository->update($request, (int) $id);
            return new SuccessResource($status);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $status = $this->statusRepository->delete((int) $id);
            return new SuccessResource($status);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
