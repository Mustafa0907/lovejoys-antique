@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">
    <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Request Evaluation</h1>

    <form action="{{ route('evaluation-requests.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="comment">Details:</label>
            <textarea name="comment" id="comment" required></textarea>
        </div>
        <div>
            <label for="contact_method">Preferred Contact Method:</label>
            <select name="contact_method" id="contact_method" required>
                <option value="phone">Phone</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="mt-4">Submit Request</button>
    </form>
</div>
@endsection
