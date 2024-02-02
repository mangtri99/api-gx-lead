<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Branch\BranchRepository;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public $branchRepository;

    public function __construct(BranchRepository $branchRepository) {
        $this->branchRepository = $branchRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->branchRepository->getAll($request));
    }

    public function store(Request $request)
    {
        try {
            $branch = $this->branchRepository->create($request);
            return new SuccessResource($branch);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->branchRepository->getById((int) $id));
    }

    public function update(Request $request, $id)
    {
        try {
            $branch = $this->branchRepository->update($request, (int) $id);
            return new SuccessResource($branch);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $branch = $this->branchRepository->delete((int) $id);
            return new SuccessResource($branch);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
