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

    public function create()
    {
        return view('evaluationRequests.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'contact_method' => 'required|string',
        ]);

        EvaluationRequest::create([
            'user_id' => auth()->id(),
            'comment' => $data['comment'],
            'contact_method' => $data['contact_method'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Request submitted successfully.');
    }
}
