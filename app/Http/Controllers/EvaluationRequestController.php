<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationRequest;

class EvaluationRequestController extends Controller
{
    public function index()
    {
        $requests = EvaluationRequest::all();
        return view('evaluationRequests.index', compact('requests'));
    }
}
