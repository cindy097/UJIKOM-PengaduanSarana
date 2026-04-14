@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">

    {{-- HEADER --}}
    <h1 class="text-2xl font-bold mb-2 text-orange-600">
        {{ $aspiration->title }}
    </h1>

    {{-- META --}}
    <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-4">
        <div>
            <strong>Status:</strong>
            @if($aspiration->status === 'pending')
                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full">
                    Pending
                </span>
            @elseif($aspiration->status === 'in_progress')
                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full">
                    In Progress
                </span>
            @elseif($aspiration->status === 'completed')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    Completed
                </span>
            @else
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                    Canceled
                </span>
            @endif
        </div>

        <div>
            <strong>Category:</strong>
            <span class="text-orange-600 font-medium">
                {{ $aspiration->category->name }}
            </span>
        </div>
    </div>

    {{-- DESCRIPTION --}}
    <div class="mb-6">
        <h2 class="font-semibold mb-1 text-gray-800">
            Description
        </h2>
        <p class="text-gray-700 leading-relaxed">
            {{ $aspiration->description }}
        </p>
    </div>

    {{-- PHOTO --}}
    @if($aspiration->supporting_photo)
        <div class="mb-6">
            <h2 class="font-semibold mb-2 text-gray-800">
                Supporting Photo
            </h2>
            <img src="{{ asset('storage/'.$aspiration->supporting_photo) }}"
                 class="w-full max-w-md rounded-lg shadow mx-auto">
        </div>
    @endif

    {{-- FEEDBACK --}}
    @if($aspiration->feedback)
        <div class="bg-orange-50 border-l-4 border-orange-400 p-4 rounded-lg mb-6">
            <h2 class="font-semibold text-orange-600 mb-1">
                Admin Feedback
            </h2>
            <p class="text-gray-700">
                {{ $aspiration->feedback->response }}
            </p>
        </div>
    @endif

    {{-- BACK BUTTON --}}
    <div class="text-right">
        <a href="{{ route('aspirations.index') }}"
           class="inline-block text-orange-600 hover:text-orange-700 font-semibold">
            ← Back to My Aspirations
        </a>
    </div>

</div>
@endsection