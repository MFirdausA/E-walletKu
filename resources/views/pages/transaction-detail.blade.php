@extends('layouts.app')
@section('content')
    <div class="container p-6">
        <div class="flex justify-end items-center w-full">
            <div class="bg-white p-2 rounded-lg shadow-lg flex items-center">
                <img src="{{ asset('img/trash-icon.svg') }}" alt="">
            </div>
        </div>
        <div class="flex justify-start items-center w-full -1">
            <a href="{{ route('home.index') }}" >
                <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
            </a>
            <div class="flex items-center justify-center w-full">
                <h1 class="text-2xl font-bold">Transaction Detail</h1>
            </div>
        </div>
        <div class="flex-row bg-white p-3 rounded-lg shadow-lg mt-6">
            <div class="w-full">
                <div class="w-full text-2xl font-semibold">
                    <p class="text-[#5F5F5F]">{{ $transaction->title }}</p>
                </div>
                <div class="mt-2 w-full text-[14px]">
                    <p class="text-[#5F5F5F]">{{ $transaction->description }}</p>
                </div>
                <div class="my-3 w-full font-bold text-[24px]">
                    <p><span>IDR </span>{{ number_format($transaction->amount, 2, ',', '.') }}</p>
                </div>
                <div class="w-full">
                    <p class="text-[#5F5F5F]">Wallet</p>
                    <p>{{ $transaction->wallet->name }}</p>
                </div>
                <div class="mt-2 w-full">
                    <p class="text-[#5F5F5F]">Date & Time</p>
                    <p>{{ $transaction->created_at }}</p>
                </div>
            </div>
            <p class=" mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
        </div>
        <div class="grid-cols-3 flex justify-around items-center w-full bg-white p-3 rounded-lg shadow-lg mt-6">
            <div class="col-span-2 items-center text-[#5F5F5F]">
                Category
            </div>
            <div class="col-span-1 flex items-center gap-3">
                <div class="flex items-center">
                    <div class="bg-[#FFA600] p-2 rounded-full">
                        <img class="w-4" src="{{ asset('storage/' . $transaction->category->cover) }}" alt="">
                    </div>
                </div>
                <div class="flex items-center">
                    <p class="text-black">{{ $transaction->category->name }}</p>
                </div>
            </div>
        </div>
        <div class="fixed bottom-5 w-full max-w-[640px] px-5 left-[50%] translate-x-[-50%] z-10">
            <div class="flex justify-between gap-2">
                <button class="w-full text-black font-bold py-4 rounded-lg bg-white hover:bg-gray-100 border border-[#FFA600]">Edit Transaction</button>
                <button id="saveTransaction" class="bg-yellow-500 w-full text-black font-bold py-4 rounded-lg hover:bg-yellow-600">Simpan</button>
            </div>
        </div>
    </div>
@endsection
