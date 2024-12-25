@extends('layouts.app')

@section('content')
<div class="container">
    <x-guest-layout>
        <div class="w-full items-center justify-center flex">
            <div class="text-black text-2xl font-extrabold font-['Poppins']">E-WalletKu</div>
        </div>

        <div class="w-full mt-2 items-center justify-center flex">
            <div class="text-[#8d8d8d] text-base font-normal font-['Poppins']">FINANCIAL MANAGEMENT</div>
        </div>

        <div class="h-6 px-2 justify-center items-center ">
            <div class="text-center text-[#8d8d8d] text-base font-normal font-['Poppins']">-Login Your Account-</div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
    
            <div class="flex items-center justify-center mt-4">
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 flex items-center space-x-1"
                    >
                        <span>Don’t have an account?</span>
                        <span class="text-[#ff9d00] font-semibold hover:underline">Register</span>
                    </a>
                @endif
            </div>

            <x-primary-button class="flex w-full justify-center mt-4">
                {{ __('Log in') }}
            </x-primary-button>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-guest-layout>
</div>
@endsection