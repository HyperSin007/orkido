@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center bg-gray-100 py-4 rounded shadow">Edit University</h2>
    <div class="bg-gray-50 shadow rounded" style="margin:25px; padding:15px;">
        <form method="POST" action="{{ route('universities.update', $university) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Country</label>
                    <input type="text" name="country" value="{{ old('country', $university->country) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $university->name) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">City</label>
                    <input type="text" name="city" value="{{ old('city', $university->city) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Subjects Name</label>
                    <input type="text" name="subjects_name" value="{{ old('subjects_name', $university->subjects_name) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Semester</label>
                    <input type="text" name="semester" value="{{ old('semester', $university->semester) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Bachelor</label>
                    <select name="bachelor" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                        <option value="">Select</option>
                        <option value="Yes" {{ old('bachelor', $university->bachelor) == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('bachelor', $university->bachelor) == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Masters</label>
                    <select name="masters" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                        <option value="">Select</option>
                        <option value="Yes" {{ old('masters', $university->masters) == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('masters', $university->masters) == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Scholarship</label>
                    <input type="text" name="scholarship" value="{{ old('scholarship', $university->scholarship) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tuition Fees</label>
                    <input type="text" name="tuition_fees" value="{{ old('tuition_fees', $university->tuition_fees) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Application Fees</label>
                    <input type="text" name="application_fees" value="{{ old('application_fees', $university->application_fees) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Requirements</label>
                    <input type="text" name="requirements" value="{{ old('requirements', $university->requirements) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">IELTS</label>
                    <input type="number" step="0.1" name="ielts" value="{{ old('ielts', $university->ielts) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Minimum CGPA</label>
                    <input type="text" name="minimum_cgpa" value="{{ old('minimum_cgpa', $university->minimum_cgpa) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('universities.index') }}" class="py-2 px-4 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">Cancel</a>
                <button type="submit" class="py-2 px-4 rounded hover:bg-green-700 bg-green-600 text-white">Update University</button>
            </div>
        </form>
    </div>
</div>
@endsection
