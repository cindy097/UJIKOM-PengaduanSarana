@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-lg">

        {{-- HEADER --}}
        <h1 class="text-2xl font-bold mb-6 text-center text-orange-600">
            Create Aspiration
        </h1>

        <form method="POST"
              action="{{ route('aspirations.store') }}"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf

            {{-- TITLE --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Title
                </label>
                <input type="text"
                       name="title"
                       class="border rounded p-2 w-full focus:ring-2 focus:ring-orange-400"
                       required>
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Description
                </label>
                <textarea name="description"
                          rows="4"
                          class="border rounded p-2 w-full focus:ring-2 focus:ring-orange-400"
                          required></textarea>
            </div>

            {{-- CATEGORY --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Category
                </label>
                <select name="category_id"
                        class="border rounded p-2 w-full focus:ring-2 focus:ring-orange-400"
                        required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PHOTO --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Supporting Photo (Optional)
                </label>
                <input type="file"
                       name="supporting_photo"
                       class="w-full text-sm">
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('aspirations.index') }}"
                   class="text-gray-600 hover:text-gray-800 text-sm">
                    ← Cancel
                </a>

                <button type="submit"
                        class="bg-gradient-to-r from-orange-500 to-amber-500
                               hover:from-orange-600 hover:to-amber-600
                               text-white px-6 py-2 rounded-lg shadow transition">
                    Submit
                </button>
            </div>

        </form>

    </div>
</div>
@endsection