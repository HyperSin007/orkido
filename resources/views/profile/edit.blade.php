@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto w-full p-4 lg:p-8">
    <h2 class="text-2xl font-bold mb-8 text-center bg-white py-4 rounded shadow">Edit Profile</h2>
    <div class="space-y-8">
        <div class="bg-white shadow rounded p-6">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="bg-white shadow rounded p-6">
            @include('profile.partials.update-password-form')
        </div>
        <div class="bg-white shadow rounded p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
