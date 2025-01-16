@extends('layouts.app')
@section('content')
<div class="container p-6 min-h-screen bg-white">

    <div class="font-bold flex justify-center items-center text-xl">Transfer </div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <button id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">{{ $transactionName }}</button>
    </div>
    <div class=" w-full flex flex-col bg-white mt-6">
        <form action="{{ route('transfer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="" name="user_id" value="{{ $user }}"> --}}
            <div class="mt-3">
                <x-input-label for="Title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div class="w-full flex justify-start items-center mt-3 gap-3">
                <select id="category" name="category_id" class="border border-[#ffa500] py-2 my-1 rounded-lg">
                    <option value="" disabled selected>Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select id="tags" name="tag_id" class="border border-[#ffa500] py-2 my-1 rounded-lg">
                    <option value="" disabled selected>Tags</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <x-input-label for="Description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" autofocus autocomplete="Description" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Created At" :value="__('Created At')" />
                <x-text-input id="date" name="date" type="datetime-local" class="mt-1 block w-full" :value="old('date')" autofocus autocomplete="Created At" />
                <x-input-error class="mt-2" :messages="$errors->get('date')" />
            </div>
            <div class="mt-3">
                <x-input-label for="From Wallet" :value="__('From wallet')" />
                <select id="wallet_id" name="wallet_id" type="select" class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"  autofocus autocomplete="Payment Method" >
                    <option value="" disabled selected>From</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ old('wallet_id') == $wallet->id ? 'selected' : '' }}>{{ Str::title($wallet->name) }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('wallet_id')" />
            </div>
            <div class="mt-3">
                <x-input-label for="To Wallet" :value="__('To wallet')" />
                <select id="to_wallet_id" name="to_wallet_id" type="select" class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"  autofocus autocomplete="Payment Method" >
                    <option value="" disabled selected>destination</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ old('to_wallet_id') == $wallet->id ? 'selected' : '' }}>{{ Str::title($wallet->name) }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('to_wallet_id')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Fee" :value="__('Fee')" />
                <x-text-input id="fee" name="fee" type="number" min="0" class="mt-1 block w-full" :value="old('fee')"  autofocus autocomplete="fee" />
                <x-input-error class="mt-2" :messages="$errors->get('fee')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Amount" :value="__('Amount')" />
                <x-text-input id="amount" name="amount" type="number" min="0" class="mt-1 block w-full" :value="old('amount')"  autofocus autocomplete="Amount" />
                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
            </div>
            <div class="flex mt-3">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
        <div id="transactionModal" class="hidden fixed inset-0 z-50 justify-center items-center">
            <div class="w-full max-w-[640px] shadow-lg">
                <div class="fixed bg-[#F2F4F5] max-w-[640px] bottom-0 rounded-t-xl px-5 w-full left-[50%] translate-x-[-50%] gap-4 py-4 flex-row items-center justify-center">
                    <div class="flex-col">
                        <button class="flex w-[32px] h-[32px] justify-center items-center  rounded-full">
                            <div id="closeModalButton" class="text-black hover:text-gray-700">&times;</div>
                        </button>
                        <div class="flex justify-center items-center p-2 mb-2">Choose Type</div>
                    </div>
                    <div class="flex-col">
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('expense.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">Expense</a>
                            <a href="{{ route('income.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">Income</a>
                            <a href="{{ route('planned.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">planned</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
const openModalButton = document.getElementById('transaction');
const closeModalButtons = document.querySelectorAll('#closeModalButton, #closeModalFooterButton');
const modal = document.getElementById('transactionModal');

// Open Modal
openModalButton.addEventListener('click', () => {
modal.classList.remove('hidden');
modal.classList.add('flex');
});

// Close Modal
closeModalButtons.forEach(button => {
button.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
});
});
});

</script>
@endsection