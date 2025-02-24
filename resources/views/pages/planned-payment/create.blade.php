@extends('layouts.app')
<style>
    .peer:checked {
    border-color: #6366f1; /* Indigo */
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5); /* Indigo Ring */
}
</style>
@section('content')
<div class="container p-6 min-h-screen bg-white">

    <div class="font-bold flex justify-center items-center text-xl">PLANNED PAYMENT</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <button id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">
            {{ $transactionName }}
        </button>
    </div>
    <button id="planned" class="border w-full bg-[#D97706] mt-3 py-2 px-4 my-1 mx-0.2 rounded-lg">
        choose planned payment
    </button>
    <div class=" w-full flex flex-col bg-white mt-3">
        <form action="{{ route('planned.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user }}">
            <input type="hidden" name="status_id" value="{{ $status }}">
            <input type="hidden" name="transaction_type_id" value="{{ $transactionid }}">
            <div class="">
                <x-input-label for="Title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" autofocus autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div class="w-full flex justify-start items-center mt-3 gap-3">
                <select id="category" name="category_id" class="border border-[#ffa500] py-2 my-1 rounded-lg">
                    <option value="" disabled selected>Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ Str::title($category->name) }}</option>
                    @endforeach
                </select>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
            <div class="mt-3">
                <x-input-label for="Description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" autofocus autocomplete="description" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Wallet" :value="__('Wallet')" />
                <select id="wallet_id" name="wallet_id" type="select" class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="" disabled selected>Select Wallet</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ old('wallet_id') == $wallet->id ? 'selected' : '' }}>{{ Str::title($wallet->name) }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('wallet_id')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Amount" :value="__('Amount')" />
                <x-text-input id="amount" name="amount" type="number" min="0" class="mt-1 block w-full" :value="old('amount')"  autofocus autocomplete="Amount" />
                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
            </div>
            <div id="plannedModal" class="hidden fixed inset-0 z-50 justify-center items-center">
                <div class="w-full max-w-[640px] shadow-lg">
                    <div class="fixed bg-[#F2F4F5] max-w-[640px] bottom-0 rounded-t-xl px-5 w-full left-[50%] translate-x-[-50%] gap-4 py-4 flex-row items-center justify-center">
                        <div class="flex-col">
                            <div class="flex w-[32px] h-[32px] justify-center items-center rounded-full cursor-pointer">
                                <div id="closeModalButton1" class="text-black hover:text-gray-700">&times;</div>
                            </div>
                            <div class="flex justify-center items-center p-2 mb-2">Plan for</div>
                        </div>
                        <div class="mt-3">
                            <select id="repeat" name="planned_transaction_type_id" class="border w-full border-[#ffa500] py-2 my-1 rounded-lg">
                                <option value="" disabled selected>Select Type Transaction</option>
                                <option value="1" {{ old('planned_transaction_type_id') == 1 ? 'selected' : '' }}>Income</option>
                                <option value="4" {{ old('planned_transaction_type_id') == 4 ? 'selected' : '' }}>Expense</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('planned_transaction_type_id')" />
                        </div>
                        <div class="mt-3">
                            <x-input-label for="Start date" :value="__('Start date')" />
                            <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full" :value="old('start_date')" autofocus autocomplete="start_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>
                        <div class="mt-3">
                            <x-input-label for="Repeat" :value="__('Repeat ')" />
                            <div class="flex justify-between items-center mt-0.5 gap-1">
                                <div class="">
                                    <input type="number" name="repeat_count" value="1" min="1" class="border-gray-300 text-gray-600 py-2 rounded-lg" value="{{ old('repeat_count') }}" />
                                    <x-input-error class="mt-2" :messages="$errors->get('repeat_count')" />
                                </div>
                                <div class="flex w-full">
                                    <select id="repeat" name="repeat_type_id" class="border w-full border-[#ffa500] py-2 my-1 rounded-lg">
                                        @foreach ($repeatTypes as $repeatType)
                                        <option value="{{ $repeatType->id }}" {{ old('repeat_type_id') == $repeatType->id ? 'selected' : '' }}>{{ Str::title($repeatType->name) }}</option>                                    
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('repeat_type_id')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <a href="{{ route('income.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">income</a>
                            <a href="{{ route('transfer.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">Transfer</a>
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
const closeModalButtons = document.querySelectorAll('#closeModalButton');
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
const openModalButton = document.getElementById('planned');
const closeModalButtons = document.querySelectorAll('#closeModalButton1');
const modal = document.getElementById('plannedModal');

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
{{-- <div class="">
                <div class="flex justify-between items-center mt-0.5 gap-1">
                    <!-- Income Option -->
                    <div class="h-[30px] w-full px-2 py-0.5 bg-[#5cf58a] rounded-lg justify-center items-center gap-2 inline-flex cursor-pointer" >
                        <input type="radio" name="transaction_type_id" value="1">
                        <div class="justify-center items-center gap-2.5 flex">
                            <div class="text-center text-black text-xs font-normal font-['Poppins']">Income</div>
                        </div>
                    </div>
                    <!-- Expense Option -->
                    <div class="h-[30px] w-full px-2 py-0.5 bg-[#4baae5] rounded-lg justify-center items-center gap-2 inline-flex cursor-pointer" >
                        <input type="checkbox" name="transaction_type_id" value="4">
                        <div class="justify-center items-center gap-2.5 flex">
                            <div class="text-center text-black text-xs font-normal font-['Poppins']">Expense</div>
                        </div>
                    </div>
                </div>
            </div> --}}
@endsection