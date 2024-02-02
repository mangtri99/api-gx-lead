<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repository\Lead\LeadRepository;
use Exception;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public $leadRepository;

    public function __construct(LeadRepository $leadRepository) {
        $this->leadRepository = $leadRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->leadRepository->getAll($request));
    }

    public function charts(Request $request)
    {
        return SuccessResource::collection($this->leadRepository->charts($request));
    }

    public function store(Request $request)
    {
        try {
            $lead = $this->leadRepository->create($request);
            return new SuccessResource($lead);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function show($id)
    {
        return new SuccessResource($this->leadRepository->getById((int) $id));
    }

    public function update(Request $request, $id)
    {
        try {
            $lead = $this->leadRepository->update($request, (int) $id);
            return new SuccessResource($lead);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $lead = $this->leadRepository->delete((int) $id);
            return new SuccessResource($lead);
        } catch (Exception $e) {
            return response()->json(new ErrorResource($e), 500);
        }
    }
}
