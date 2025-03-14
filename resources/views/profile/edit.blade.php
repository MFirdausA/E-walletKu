{{-- <x-appsecond>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
</x-other> --}}

@extends('layouts.app')
@section('content')
<div class="p-6">
    <div class="w-full flex items-center mt-4 mb-4">
        <a href="{{ route('settings') }}" class="mr-auto">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <div class="font-bold text-xl text-center flex-grow">SETTINGS</div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection