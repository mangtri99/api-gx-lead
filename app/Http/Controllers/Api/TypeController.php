<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Type\TypeRepository;
use Exception;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public $typeRepository;

    public function __construct(TypeRepository $typeRepository) {
        $this->typeRepository = $typeRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->typeRepository->getAll($request));
    }

    public function store(TypeRequest $request)
    {
        try {
            $type = $this->typeRepository->create($request);
            return new SuccessResource($type);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->typeRepository->getById((int) $id));
    }

    public function update(TypeRequest $request, $id)
    {
        try {
            $type = $this->typeRepository->update($request, (int) $id);
            return new SuccessResource($type);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $type = $this->typeRepository->delete((int) $id);
            return new SuccessResource($type);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
