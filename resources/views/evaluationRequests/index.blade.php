@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Evaluation Requests</h1>

        @if($requests->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No requests found.</p>
        @else
            @foreach ($requests as $request)
                <div class="mt-4 bg-white dark:bg-gray-800 shadow p-4">
                    <p class="text-gray-600 dark:text-gray-200">{{ $request->request_details }}</p>
                    {{-- Display other details as needed --}}
                </div>
            @endforeach
        @endif
    </div>
@endsection