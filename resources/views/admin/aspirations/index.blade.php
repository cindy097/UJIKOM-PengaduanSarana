@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-orange-600">
        All Aspirations
    </h1>
</div>

{{-- FILTER --}}
<form method="GET"
      class="bg-white p-4 rounded-xl shadow mb-6
             flex flex-wrap gap-3 items-end">

    <div>
        <label class="text-sm font-semibold block mb-1">
            Date
        </label>
        <input type="date"
               name="date"
               value="{{ request('date') }}"
               class="border rounded p-2 focus:ring-2 focus:ring-orange-400">
    </div>

    <div>
        <label class="text-sm font-semibold block mb-1">
            Category
        </label>
        <select name="category_id"
                class="border rounded p-2 focus:ring-2 focus:ring-orange-400">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="bg-gradient-to-r from-orange-500 to-amber-500
                   hover:from-orange-600 hover:to-amber-600
                   text-white px-6 py-2 rounded-lg shadow transition">
        Filter
    </button>
</form>

{{-- TABLE --}}
<div class="bg-white rounded-xl shadow overflow-x-auto">
<table class="w-full text-sm">
    <thead class="bg-orange-100 text-orange-700">
        <tr>
            <th class="p-3 text-left">Date</th>
            <th class="p-3 text-left">Student</th>
            <th class="p-3 text-left">Title</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Action</th>
        </tr>
    </thead>

    <tbody>
    @forelse($aspirations as $aspiration)
        <tr class="border-t hover:bg-orange-50 transition">
            <td class="p-3">
                {{ $aspiration->created_at->format('d M Y') }}
            </td>

            <td class="p-3 font-medium text-gray-700">
                {{ $aspiration->user->name }}
            </td>

            <td class="p-3">
                {{ $aspiration->title }}
            </td>

            <td class="p-3">
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
            </td>

            <td class="p-3">
                <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                   class="text-orange-600 hover:text-orange-700 font-semibold">
                    Detail →
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5"
                class="p-6 text-center text-gray-500">
                No aspirations found.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>

@endsection