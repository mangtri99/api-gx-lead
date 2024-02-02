<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProbabilityRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;
use App\Repository\Probability\ProbabilityRepository;
use Exception;

class ProbabilityController extends Controller
{
    public $probabilityRepository;

    public function __construct(ProbabilityRepository $probabilityRepository) {
        $this->probabilityRepository = $probabilityRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->probabilityRepository->getAll($request));
    }

    public function store(ProbabilityRequest $request)
    {
        try {
            $probability = $this->probabilityRepository->create($request);
            return new SuccessResource($probability);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->probabilityRepository->getById((int) $id));
    }

    public function update(ProbabilityRequest $request, $id)
    {
        try {
            $probability = $this->probabilityRepository->update($request, (int) $id);
            return new SuccessResource($probability);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $probability = $this->probabilityRepository->delete((int) $id);
            return new SuccessResource($probability);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
