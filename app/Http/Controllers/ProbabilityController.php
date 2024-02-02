<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Probability\ProbabilityRepository;

class ProbabilityController extends Controller
{
    public $probabilityRepository;

    public function __construct(ProbabilityRepository $probabilityRepository) {
        $this->probabilityRepository = $probabilityRepository;
    }

    public function index(Request $request)
    {
        return $this->probabilityRepository->getById(1);
    }
}
