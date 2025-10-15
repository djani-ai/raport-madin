@extends('filament::page')

@section('title', 'Generate Leger')

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Generate Leger</h1>
        <form method="POST" action="{{ route('leger.generate') }}">
            @csrf
            <div class="mb-4">
                <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                <select id="class" name="class" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">Select Class</option>
                    <!-- Add class options here -->
                </select>
            </div>
            <div class="mb-4">
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select id="semester" name="semester" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">Select Semester</option>
                    <!-- Add semester options here -->
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700">
                Generate
            </button>
        </form>
    </div>
@endsection
