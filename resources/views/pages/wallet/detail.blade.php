@extends('layouts.app')
@section('content')

<div class="container p-6">
    <div class="font-bold flex justify-center items-center text-xl">ACCOUNT</div>
    <a href="{{ route('wallet.index') }}" class="w-full flex justify-between items-center mt-4">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        <div class="w-[42px] h-[42px] px-2 bg-[#ffa500] rounded-[100px] justify-center items-center gap-2.5 inline-flex">
            <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
        </div>
    </a>
    <div class="bg-white rounded-xl py-3 justify-around items-center mt-[32px] flex">
        <div class="items-center text-wrap">
            <div class="text-black font-bold">income this month</div>
            <div class="flex justify-center">
                <div class="text-black font-bold">{{ number_format($incomeAmount, 2, ',', '.') }}</div>
            </div>
        </div>
        <div class="items-center text-wrap">
            <div class="text-black font-bold">expense this month</div>
            <div class="flex justify-center">
                <div class="text-black font-bold">{{ number_format($expenseAmount, 2, ',', '.') }}</div>
            </div>
        </div>
    </div>
    @foreach ($wallets as $wallet)
    <div class="card">
        <div class=" bg-[#ffa500] rounded-tl-xl rounded-tr-xl mt-[24px] p-3">
            <div class="w-full">
                <div class="self-stretch font-medium">
                    {{ $wallet->name }}
                </div>
                <div class="justify-center items-center mt-[18px]">
                    <div class="self-stretch text-2xl font-bold flex text-wrap justify-center">{{ number_format($wallet->remainingBalance, 2, ',', '.') }} IDR  </div>
                </div>
            </div>
        </div>
            <div class="bg-white rounded-b-xl py-3 justify-around items-center flex">
                <div class="items-center text-wrap">
                    <div class="text-black font-bold">income this month</div>
                    <div class="flex justify-center">
                        <div class="text-black font-bold">{{ number_format($wallet->incomeAmount, 2, ',', '.') }} IDR</div>
                    </div>
                </div>
                <div class="items-center text-wrap">
                    <div class="text-black font-bold">expense this month</div>
                    <div class="flex justify-center">
                        <div class="text-black font-bold">{{ number_format($wallet->expenseAmount, 2, ',', '.') }} IDR</div>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
    <div id="BottomNav" class="relative flex w-full h-[100px] shrink-0">
        <nav class="fixed bottom-5 w-full max-w-[640px] px-5 left-[50%] translate-x-[-50%] z-10">
            <div class="grid grid-cols-3 h-fit rounded-[40px] justify-between items-center py-4 px-5 bg-[#ffa500]">
                <a href="{{ route('home.index') }}" class="flex m-auto flex-row items-center text-center gap-2">
                    <img src="{{ asset('img/home-icon.svg') }}" class="w-4 h-4 flex shrink-0" alt="icon">
                    <span class="font-semibold text-sm text-white">Home</span>
                </a>
                <a href="" class="flex flex-col items-center  text-center gap-2">
                    <div class="w-9 h-9 bg-[#f2f4f5] rounded-full flex-row justify-center items-center inline-flex">
                        <div class="text-center text-[#ffa500] text-xl font-normal font-['Poppins']">+</div>
                    </div>
                </a>
                <a href="" class="flex flex-row items-center m-auto text-center gap-2">
                    <img src="{{ asset('img/wallet-icon.svg') }}" class="w-4 h-4 flex shrink-0" alt="icon">
                    <span class="font-semibold text-sm text-white">Wallet</span>
                </a>
            </div>
        </nav>
    </div>
</div>
@endsection