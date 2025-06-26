@extends('layouts.admin')

@section('content')
    @php
        $stats = \App\Http\Controllers\UniversityController::getDashboardStats();
    @endphp
    <div class="p-4 lg:p-8">
        <h1 class="text-xl lg:text-2xl font-bold mb-6 lg:mb-8">Welcome, {{ auth()->user()->name }}!</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow p-4 lg:p-6 flex flex-col items-center w-full">
                <canvas id="uniPie" width="80" height="80"></canvas>
                <div class="mt-4 text-2xl lg:text-3xl font-bold">{{ $stats['totalUniversities'] }}</div>
                <div class="text-gray-600 mt-1 text-sm lg:text-base text-center">Total Universities</div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 lg:p-6 flex flex-col items-center w-full">
                <canvas id="bachelorPie" width="80" height="80"></canvas>
                <div class="mt-4 text-2xl lg:text-3xl font-bold">{{ $stats['totalBachelor'] }}</div>
                <div class="text-gray-600 mt-1 text-sm lg:text-base text-center">Total Bachelor</div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 lg:p-6 flex flex-col items-center w-full sm:col-span-2 lg:col-span-1">
                <canvas id="mastersPie" width="80" height="80"></canvas>
                <div class="mt-4 text-2xl lg:text-3xl font-bold">{{ $stats['totalMasters'] }}</div>
                <div class="text-gray-600 mt-1 text-sm lg:text-base text-center">Total Masters</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const total = {{ $stats['totalUniversities'] }};
        const bachelor = {{ $stats['totalBachelor'] }};
        const masters = {{ $stats['totalMasters'] }};
        new Chart(document.getElementById('uniPie'), {
            type: 'doughnut',
            data: {
                labels: ['Universities'],
                datasets: [{ data: [total], backgroundColor: ['#4ade80'] }]
            },
            options: { cutout: '70%', plugins: { legend: { display: false } } }
        });
        new Chart(document.getElementById('bachelorPie'), {
            type: 'doughnut',
            data: {
                labels: ['Bachelor', 'Other'],
                datasets: [{ data: [bachelor, total-bachelor], backgroundColor: ['#60a5fa', '#e5e7eb'] }]
            },
            options: { cutout: '70%', plugins: { legend: { display: false } } }
        });
        new Chart(document.getElementById('mastersPie'), {
            type: 'doughnut',
            data: {
                labels: ['Masters', 'Other'],
                datasets: [{ data: [masters, total-masters], backgroundColor: ['#f472b6', '#e5e7eb'] }]
            },
            options: { cutout: '70%', plugins: { legend: { display: false } } }
        });
    });
</script>
@endpush
