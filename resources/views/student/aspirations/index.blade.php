@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-orange-600">
        My Aspirations
    </h1>

    <a href="{{ route('aspirations.create') }}"
       class="bg-gradient-to-r from-orange-500 to-amber-500
              hover:from-orange-600 hover:to-amber-600
              text-white px-4 py-2 rounded-lg shadow transition">
        + New Aspiration
    </a>
</div>

@if($aspirations->isEmpty())
    <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
        You haven't submitted any aspirations yet.
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
@foreach($aspirations as $aspiration)
    <div class="bg-white p-5 rounded-xl shadow
                hover:shadow-xl transition border-l-4 border-orange-400">

        {{-- TITLE --}}
        <h2 class="text-lg font-semibold mb-1 text-gray-800">
            {{ $aspiration->title }}
        </h2>

        {{-- META --}}
        <p class="text-sm text-gray-500 mb-2">
            Category:
            <span class="font-medium text-orange-600">
                {{ $aspiration->category->name }}
            </span>
        </p>

        {{-- STATUS --}}
        <div class="mb-3 flex flex-wrap gap-2">
            @if($aspiration->status === 'pending')
                <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full">
                    Pending
                </span>
            @elseif($aspiration->status === 'in_progress')
                <span class="bg-amber-100 text-amber-700 text-xs px-3 py-1 rounded-full">
                    In Progress
                </span>
            @elseif($aspiration->status === 'completed')
                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                    Completed
                </span>
            @else
                <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">
                    Canceled
                </span>
            @endif

            @if($aspiration->feedback)
                <span class="bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full">
                    Feedback Available
                </span>
            @endif
        </div>

        {{-- DESCRIPTION --}}
        <p class="text-gray-600 text-sm mb-4">
            {{ Str::limit($aspiration->description, 100) }}
        </p>

        {{-- ACTION --}}
        <a href="{{ route('aspirations.show', $aspiration->id) }}"
           class="inline-flex items-center text-orange-600 hover:text-orange-700
                  text-sm font-semibold">
            View Detail
            <span class="ml-1">→</span>
        </a>
    </div>
@endforeach
</div>
@endsection