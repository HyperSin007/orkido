@extends('layouts.admin')

@section('content')
<div class="p-4 lg:p-6">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-xl lg:text-2xl font-bold mb-6 text-center bg-white py-4 rounded shadow">Add University</h2>
        <div class="bg-white shadow rounded p-4 lg:p-6">
            <form method="POST" action="{{ route('universities.store') }}">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Country</label>
                    <input type="text" name="country" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">City</label>
                    <input type="text" name="city" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Subjects Name</label>
                    <input type="text" name="subjects_name" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Semester</label>
                    <input type="text" name="semester" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Bachelor</label>
                    <select name="bachelor" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Masters</label>
                    <select name="masters" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Scholarship</label>
                    <input type="text" name="scholarship" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tuition Fees</label>
                    <input type="text" name="tuition_fees" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Application Fees</label>
                    <input type="text" name="application_fees" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Requirements</label>
                    <input type="text" name="requirements" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">IELTS</label>
                    <input type="number" step="0.1" name="ielts" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Minimum CGPA</label>
                    <input type="text" name="minimum_cgpa" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-400">
                </div>
            </div>
            <div class="mt-6 lg:mt-8 flex justify-center lg:justify-end">
                <button type="submit" class="w-full lg:w-auto py-3 lg:py-2 px-6 lg:px-4 rounded bg-green-600 hover:bg-green-700 text-white font-medium transition-colors duration-200">Add University</button>
            </div>
        </form>
    </div>
</div>
@endsection
