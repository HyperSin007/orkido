@extends('layouts.admin')

@section('content')
    <div class="p-4 lg:p-6">
        <div class="bg-white shadow rounded mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between px-4 lg:px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-800 mb-4 lg:mb-0">University List</h2>
                
                <!-- Mobile-friendly filters -->
                <form method="GET" action="" class="flex flex-col lg:flex-row lg:items-center gap-2 lg:gap-2">
                    <div class="grid grid-cols-2 lg:flex gap-2">
                        <select name="country" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-2 text-sm lg:px-8 lg:py-1 lg:w-56">
                            <option value="">All Countries</option>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ $selectedCountry == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                        <select name="bachelor" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-2 text-sm lg:px-8 lg:py-1 lg:w-36">
                            <option value="">Bachelor</option>
                            <option value="Yes" {{ request('bachelor') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ request('bachelor') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                        <select name="masters" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-2 text-sm lg:px-8 lg:py-1 lg:w-36">
                            <option value="">Masters</option>
                            <option value="Yes" {{ request('masters') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ request('masters') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                        <select name="scholarship" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-2 text-sm lg:px-8 lg:py-1 lg:w-36">
                            <option value="">Scholarship</option>
                            <option value="Yes" {{ request('scholarship') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ request('scholarship') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="p-4 lg:p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-600 text-sm lg:text-base">{{ session('success') }}</div>
                @endif
                @if($universities->count())
                    <!-- Mobile Card View -->
                    <div class="lg:hidden space-y-4">
                        @foreach($universities as $uni)
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $uni->name }}</h3>
                                    <div class="flex space-x-1">
                                        <a href="{{ route('universities.edit', $uni) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">Edit</a>
                                        <form method="POST" action="{{ route('universities.destroy', $uni) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div><span class="font-medium">Country:</span> {{ $uni->country }}</div>
                                    <div><span class="font-medium">City:</span> {{ $uni->city }}</div>
                                    <div><span class="font-medium">Semester:</span> {{ $uni->semester ?? 'N/A' }}</div>
                                    <div><span class="font-medium">Bachelor:</span> 
                                        <span class="px-1 py-0.5 rounded text-xs {{ $uni->bachelor == 'Yes' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $uni->bachelor }}
                                        </span>
                                    </div>
                                    <div><span class="font-medium">Masters:</span>
                                        <span class="px-1 py-0.5 rounded text-xs {{ $uni->masters == 'Yes' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $uni->masters }}
                                        </span>
                                    </div>
                                    <div><span class="font-medium">Scholarship:</span>
                                        <span class="px-1 py-0.5 rounded text-xs {{ $uni->scholarship == 'Yes' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $uni->scholarship }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs">
                                    <div><span class="font-medium">Subjects:</span> {{ $uni->subjects_name }}</div>
                                    <div><span class="font-medium">Tuition:</span> {{ $uni->tuition_fees }}</div>
                                    <div><span class="font-medium">Application:</span> {{ $uni->application_fees }}</div>
                                    <div><span class="font-medium">Requirements:</span> {{ $uni->requirements }}</div>
                                    <div><span class="font-medium">IELTS:</span> {{ $uni->ielts }}</div>
                                    <div><span class="font-medium">Min CGPA:</span> {{ $uni->minimum_cgpa }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                <th class="px-4 py-2 border">Country</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">City</th>
                                <th class="px-4 py-2 border">Subjects</th>
                                <th class="px-4 py-2 border">Semester</th>
                                <th class="px-4 py-2 border">Bachelor</th>
                                <th class="px-4 py-2 border">Masters</th>
                                <th class="px-4 py-2 border">Scholarship</th>
                                <th class="px-4 py-2 border">Tuition Fees</th>
                                <th class="px-4 py-2 border">Application Fees</th>
                                <th class="px-4 py-2 border">Requirements</th>
                                <th class="px-4 py-2 border">IELTS</th>
                                <th class="px-4 py-2 border">Min CGPA</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($universities as $university)
                                <tr>
                                    <td class="border px-4 py-2">{{ $university->country }}</td>
                                    <td class="border px-4 py-2">{{ $university->name }}</td>
                                    <td class="border px-4 py-2">{{ $university->city }}</td>
                                    <td class="border px-4 py-2">{{ $university->subjects_name }}</td>
                                    <td class="border px-4 py-2">{{ $university->semester }}</td>
                                    <td class="border px-4 py-2">{{ $university->bachelor }}</td>
                                    <td class="border px-4 py-2">{{ $university->masters }}</td>
                                    <td class="border px-4 py-2">{{ $university->scholarship }}</td>
                                    <td class="border px-4 py-2">{{ $university->tuition_fees }}</td>
                                    <td class="border px-4 py-2">{{ $university->application_fees }}</td>
                                    <td class="border px-4 py-2">{{ $university->requirements }}</td>
                                    <td class="border px-4 py-2">{{ $university->ielts }}</td>
                                    <td class="border px-4 py-2">{{ $university->minimum_cgpa }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('universities.edit', $university) }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2">Edit</a>
                                        <form action="{{ route('universities.destroy', $university) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this university?');">
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
                <p class="text-gray-500">No universities to show yet.</p>
            @endif
        </div>
        <!-- Removed modal for Add University as the form is now on a separate page -->
    </div>
@endsection
