@extends('layouts.admin')

@section('content')
    <div class="p-4 lg:p-6">
        <div class="bg-white shadow rounded mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between px-4 lg:px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-800 mb-4 lg:mb-0">Students List</h2>
                <a href="{{ route('students.create') }}" class="w-full lg:w-auto py-3 lg:py-2 px-6 lg:px-4 rounded bg-green-600 hover:bg-green-700 text-white font-medium transition-colors duration-200 text-center">
                    Add New Student
                </a>
            </div>
            <div class="p-4 lg:p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-600 text-sm lg:text-base">{{ session('success') }}</div>
                @endif
                @if($students->count())
                    <!-- Mobile Card View -->
                    <div class="lg:hidden space-y-4">
                        @foreach($students as $student)
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $student->full_name }}</h3>
                                    <div class="flex space-x-1">
                                        <a href="{{ route('students.edit', $student) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">Edit</a>
                                        <form method="POST" action="{{ route('students.destroy', $student) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div><span class="font-medium">Passport:</span> {{ $student->passport_number }}</div>
                                    <div><span class="font-medium">Email:</span> {{ $student->email }}</div>
                                    <div><span class="font-medium">Phone:</span> {{ $student->phone_number }}</div>
                                    <div><span class="font-medium">GPA:</span> 
                                        <span class="px-1 py-0.5 rounded text-xs {{ $student->gpa >= 3.5 ? 'bg-green-100 text-green-800' : ($student->gpa >= 3.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $student->gpa }}
                                        </span>
                                    </div>
                                    <div><span class="font-medium">IELTS:</span> 
                                        @if($student->ielts_score)
                                            <span class="px-1 py-0.5 rounded text-xs {{ $student->ielts_score >= 7.0 ? 'bg-green-100 text-green-800' : ($student->ielts_score >= 6.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $student->ielts_score }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2 text-xs">
                                    <div><span class="font-medium">Address:</span> {{ Str::limit($student->address, 50) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Passport Number</th>
                                    <th class="px-4 py-2 border">Email</th>
                                    <th class="px-4 py-2 border">Phone</th>
                                    <th class="px-4 py-2 border">Address</th>
                                    <th class="px-4 py-2 border">GPA</th>
                                    <th class="px-4 py-2 border">IELTS Score</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $student->full_name }}</td>
                                        <td class="border px-4 py-2">{{ $student->passport_number }}</td>
                                        <td class="border px-4 py-2">{{ $student->email }}</td>
                                        <td class="border px-4 py-2">{{ $student->phone_number }}</td>
                                        <td class="border px-4 py-2">{{ Str::limit($student->address, 30) }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="px-2 py-1 rounded text-xs {{ $student->gpa >= 3.5 ? 'bg-green-100 text-green-800' : ($student->gpa >= 3.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $student->gpa }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if($student->ielts_score)
                                                <span class="px-2 py-1 rounded text-xs {{ $student->ielts_score >= 7.0 ? 'bg-green-100 text-green-800' : ($student->ielts_score >= 6.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ $student->ielts_score }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('students.edit', $student) }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2">Edit</a>
                                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No students to show yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
