@extends('layouts.admin')

@section('content')
    <div class="bg-white shadow rounded mb-6">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 flex-1">University List</h2>
            <form method="GET" action="" class="flex items-center gap-2">
                <select name="country" onchange="this.form.submit()" class="border-gray-300 rounded px-8 py-1 w-56">
                    <option value="">All Countries</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ $selectedCountry == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                <select name="bachelor" onchange="this.form.submit()" class="border-gray-300 rounded px-8 py-1 w-36">
                    <option value="">Bachelor</option>
                    <option value="Yes" {{ request('bachelor') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ request('bachelor') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                <select name="masters" onchange="this.form.submit()" class="border-gray-300 rounded px-8 py-1 w-36">
                    <option value="">Masters</option>
                    <option value="Yes" {{ request('masters') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ request('masters') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                <select name="scholarship" onchange="this.form.submit()" class="border-gray-300 rounded px-8 py-1 w-36">
                    <option value="">Scholarship</option>
                    <option value="Yes" {{ request('scholarship') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ request('scholarship') == 'No' ? 'selected' : '' }}>No</option>
                </select>
            </form>
            
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            @if($universities->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Country</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">City</th>
                                <th class="px-4 py-2 border">Subjects</th>
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
