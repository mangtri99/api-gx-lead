<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Repository\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return SuccessResource::collection($this->userRepository->getAll($request));
    }
}
