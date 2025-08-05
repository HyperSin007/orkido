@extends('layouts.admin')

@section('content')
<div class="p-4 lg:p-6">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-xl lg:text-2xl font-bold mb-6 text-center bg-white py-4 rounded shadow">Edit Student</h2>
        <div class="bg-white shadow rounded p-4 lg:p-6">
            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Passport Number</label>
                        <input type="text" name="passport_number" value="{{ old('passport_number', $student->passport_number) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                        @error('passport_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">GPA (0.00 - 4.00)</label>
                        <input type="number" name="gpa" value="{{ old('gpa', $student->gpa) }}" step="0.01" min="0" max="4" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                        @error('gpa')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium mb-1">Address</label>
                        <textarea name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>{{ old('address', $student->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">IELTS Score (0.0 - 9.0) - Optional</label>
                        <input type="number" name="ielts_score" value="{{ old('ielts_score', $student->ielts_score) }}" step="0.5" min="0" max="9" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                        @error('ielts_score')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 lg:mt-8 flex flex-col lg:flex-row justify-center lg:justify-end gap-3 lg:gap-4">
                    <a href="{{ route('students.index') }}" class="py-3 lg:py-2 px-6 lg:px-4 rounded bg-gray-300 hover:bg-gray-400 text-gray-800 text-center font-medium transition-colors duration-200">Cancel</a>
                    <button type="submit" class="py-3 lg:py-2 px-6 lg:px-4 rounded bg-green-600 hover:bg-green-700 text-white font-medium transition-colors duration-200">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
