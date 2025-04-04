@extends('layouts.app')
@section('content')

<div class="container p-6">
    <div class="w-full flex items-center mt-4">
        <a href="{{ route('home.index') }}" class="mr-auto">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <div class="font-bold text-xl text-center flex-grow">SETTINGS</div>
    </div>

    <a href="{{ route('profile.edit') }}" class="mt-4 cursor-pointer bg-white hover:bg-slate-50 rounded-lg p-2 flex items-center justify-between">
        <img class="w-[58px] shadow p-0.8 rounded-full" src="{{ Auth::user()->profile ? asset('img/' . Auth::user()->profile) : asset('img/default-profile.png') }}" >
        <div class="w-full pl-4">
            <div class="text-black text-[17px] font-normal font-['Poppins'] leading-snug">Hi, {{ Auth::user()->name }}</div>
            <div class="text-black text-[13px] font-normal font-['Poppins'] leading-none">Credential, profile & more</div>
        </div>
        <div class="text-[#c7c7cc] text-xl mr-5 font-normal font-['Poppins']">></div>
    </a>

    <div class="mt-4 bg-white justify-between items-center rounded-lg flex-row">
        <button class="justify-between items-center flex w-full px-[12px] py-2 border-b">
            <div class="flex gap-2 items-center">
                <img class="bg gap-1 bg-blue-600 rounded-md p-0.5" src="{{ asset('img/moon.svg') }}" alt="icon">
                <div>Data</div>
            </div>
            <div class="flex">
                <div class="text-[#c7c7cc] text-xl font-normal font-['Poppins']">></div>
            </div>
        </button>
        <button class="justify-between items-center flex w-full px-[12px] py-2 border-b">
            <div class="flex gap-2 items-center">
                <img class="bg gap-1 to-blue-600 rounded-xl" src="{{ asset('img/moon.svg') }}" alt="icon">
                <div>Theme</div>
            </div>
            <div class="flex">
                <div class="text-[#c7c7cc] text-xl font-normal font-['Poppins']">></div>
            </div>
        </button>
        <button class="justify-between items-center flex w-full px-[12px] py-2 border-b">
            <div class="flex gap-2 items-center">
                <img class="bg gap-1 to-blue-600 rounded-xl" src="{{ asset('img/moon.svg') }}" alt="icon">
                <div>Report a bug</div>
            </div>
            <div class="flex">
                <div class="text-[#c7c7cc] text-xl font-normal font-['Poppins']">></div>
            </div>
        </button>
    </div>
    {{-- <div id="BottomNav" class="relative flex w-full h-[100px] shrink-0">
        <nav class="fixed bottom-5 w-full max-w-[640px] px-5 left-[50%] translate-x-[-50%] z-10">
            <div class="grid grid-cols-3 h-fit rounded-[40px] justify-between items-center py-4 px-5 bg-[#ffa500]">
                <a href="{{ route('home.index') }}" class="flex m-auto flex-row items-center text-center gap-2">
                    <img src="{{ asset('img/home-icon.svg') }}" class="w-4 h-4 flex shrink-0" alt="icon">
                    <span class="font-semibold text-sm text-white">Home</span>
                </a>
                <a href="javascript:void(0)" id="openModal" class="flex flex-col items-center text-center gap-2">
                    <div class="w-9 h-9 bg-[#f2f4f5] rounded-full flex-row justify-center items-center inline-flex">
                        <div class="text-center text-[#ffa500] text-xl font-normal font-['Poppins']">+</div>
                    </div>
                </a>
                <a href="{{ route('wallet.create') }}" class="flex flex-row items-center m-auto text-center gap-2">
                    <img src="{{ asset('img/wallet-icon.svg') }}" class="w-4 h-4 flex shrink-0" alt="icon">
                    <span class="font-semibold text-sm text-white">Wallet</span>
                </a>
            </div>
        </nav>
    </div> --}}
</div>

@endsection