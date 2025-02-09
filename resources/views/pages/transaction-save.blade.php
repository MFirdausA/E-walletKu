@extends('layouts.app')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="transaction-details container p-6 min-h-screen bg-gradient-to-b from-[#ffa500] to-white">
        <div class="flex flex-col items-center">
            <x-main-app-logo class="block w-auto fill-current" />
            <h1 class="text-2xl font-bold">E-WalletKu</h1>
        </div>
        
        <div class="flex-row bg-white p-2 rounded-lg shadow-lg mt-6">
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
                <div class="mt-2 w-full">
                    <p class="text-[#5F5F5F]">Category</p>
                    <p>{{ $transaction->category->name }}</p>
                </div>
            </div>
            <p class=" mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
        </div>
    </div>
@endsection
