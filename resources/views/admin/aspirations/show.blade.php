@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- BACK BUTTON --}}
    <a href="{{ route('admin.aspirations.index') }}"
       class="inline-flex items-center mb-4 text-sm font-semibold
              text-orange-600 hover:text-orange-700">
        ← Back to All Aspirations
    </a>

    <div class="bg-white p-6 rounded-xl shadow-lg">

        {{-- TITLE --}}
        <h1 class="text-2xl font-bold mb-4 text-orange-600">
            {{ $aspiration->title }}
        </h1>

        {{-- META INFO --}}
        <div class="mb-5 text-sm text-gray-700 space-y-2">

            <p>
                <strong>Student:</strong>
                <span class="text-gray-800 font-medium">
                    {{ $aspiration->user->name }}
                </span>
            </p>

            <p>
                <strong>Date Submitted:</strong>
                {{ $aspiration->created_at->format('d M Y H:i') }}
            </p>

            <p>
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
            </p>
        </div>

        {{-- DESCRIPTION --}}
        <div class="mb-6">
            <h2 class="font-semibold mb-2 text-gray-800">
                Description
            </h2>
            <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                {{ $aspiration->description }}
            </p>
        </div>

        {{-- SUPPORTING PHOTO --}}
        @if($aspiration->supporting_photo)
            <div class="mb-6">
                <h2 class="font-semibold mb-2 text-gray-800">
                    Supporting Photo
                </h2>

                <img src="{{ asset('storage/' . $aspiration->supporting_photo) }}"
                     alt="Supporting Photo"
                     class="max-w-full rounded-xl shadow border mx-auto">
            </div>
        @endif

        {{-- UPDATE STATUS --}}
        <div class="mb-6">
            <h2 class="font-semibold mb-2 text-gray-800">
                Update Status
            </h2>

            <form method="POST"
                  action="{{ route('admin.aspirations.status', $aspiration->id) }}"
                  class="flex flex-wrap gap-3 items-center">
                @csrf
                @method('PUT')

                <select name="status"
                        class="border rounded p-2 focus:ring-2 focus:ring-orange-400">
                    <option value="pending" {{ $aspiration->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="in_progress" {{ $aspiration->status == 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>
                    <option value="completed" {{ $aspiration->status == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                    <option value="canceled" {{ $aspiration->status == 'canceled' ? 'selected' : '' }}>
                        Canceled
                    </option>
                </select>

                <button
                    class="bg-gradient-to-r from-orange-500 to-amber-500
                           hover:from-orange-600 hover:to-amber-600
                           text-white px-5 py-2 rounded-lg shadow transition">
                    Update
                </button>
            </form>
        </div>

        {{-- FEEDBACK --}}
        <div>
            <h2 class="font-semibold mb-2 text-gray-800">
                Send Feedback to Student
            </h2>

            <form method="POST"
                  action="{{ route('admin.aspirations.feedback', $aspiration->id) }}"
                  class="space-y-3">
                @csrf

                <textarea name="response"
                          rows="4"
                          class="border rounded p-2 w-full focus:ring-2 focus:ring-orange-400"
                          placeholder="Write feedback here..."
                          required></textarea>

                <button
                    class="bg-gradient-to-r from-orange-500 to-amber-500
                           hover:from-orange-600 hover:to-amber-600
                           text-white px-6 py-2 rounded-lg shadow transition">
                    Send Feedback
                </button>
            </form>
        </div>

    </div>
</div>
@endsection