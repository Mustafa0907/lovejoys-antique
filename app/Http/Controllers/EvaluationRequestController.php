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

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'comment' => 'required|string',
    //         'contact_method' => 'required|string',
            
    //     ]);

    //     EvaluationRequest::create([
    //         'user_id' => auth()->id(),
    //         'comment' => $data['comment'],
    //         'contact_method' => $data['contact_method'],
    //     ]);

    //     return redirect()->route('dashboard')->with('success', 'Request submitted successfully.');
    // }
    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'contact_method' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validation rule for image
        ]);

        // Create an evaluation request instance
        $evaluationRequest = new EvaluationRequest([
            'user_id' => auth()->id(),
            'comment' => $data['comment'],
            'contact_method' => $data['contact_method'],
            // Don't set 'image' here, as it's handled separately below
        ]);

        // Handle the image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = $request->file('image')->store('evaluation_images', 'public');
            $evaluationRequest->image = $imageName;
        } else {
            \Log::info('No image or image is invalid');
        }
        

        $evaluationRequest->save();

        return redirect()->route('dashboard')->with('success', 'Request submitted successfully.');
    }

    public function destroy(Request $request, EvaluationRequest $evaluationRequest)
    {
        // Ensure that the user can only delete their own requests
        if ($evaluationRequest->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this request.');
        }

        // Delete the request
        $evaluationRequest->delete();

        return redirect()->route('dashboard')->with('success', 'Request deleted successfully.');
    }

    
}
