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

        <div class="p-4 w-full bg-white shadow sm:rounded-lg">
            <h1 class="text-lg font-medium text-gray-900">Logout Account</h1>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('securely logs the user out of account.') }}
            </p>

            <form method="POST" action="{{ route('logout')}}" class="w-full flex">
                @csrf
                <button type="submit" class="w-full items-center px-4 py-2 mt-3 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Logout
                </button>
            </form>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection