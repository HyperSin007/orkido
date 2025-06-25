@extends('layouts.admin')

@section('content')
    @php
        $stats = \App\Http\Controllers\UniversityController::getDashboardStats();
    @endphp
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-8">Welcome, {{ auth()->user()->name }}!</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-gray-100 rounded-xl shadow p-6 flex flex-col items-center w-full max-w-xs">
                <canvas id="uniPie" width="80" height="80"></canvas>
                <div class="mt-4 text-3xl font-bold">{{ $stats['totalUniversities'] }}</div>
                <div class="text-gray-600 mt-1">Total Universities</div>
            </div>
            <div class="bg-gray-100 rounded-xl shadow p-6 flex flex-col items-center w-full max-w-xs">
                <canvas id="bachelorPie" width="80" height="80"></canvas>
                <div class="mt-4 text-3xl font-bold">{{ $stats['totalBachelor'] }}</div>
                <div class="text-gray-600 mt-1">Total Bachelor</div>
            </div>
            <div class="bg-gray-100 rounded-xl shadow p-6 flex flex-col items-center w-full max-w-xs">
                <canvas id="mastersPie" width="80" height="80"></canvas>
                <div class="mt-4 text-3xl font-bold">{{ $stats['totalMasters'] }}</div>
                <div class="text-gray-600 mt-1">Total Masters</div>
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
