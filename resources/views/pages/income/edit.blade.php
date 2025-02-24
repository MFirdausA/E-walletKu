@extends('layouts.app')
@section('content')
<div class="container p-6 min-h-screen bg-white">

    <div class="font-bold flex justify-center items-center text-xl">Update Income</div>
    <div class="w-full flex justify-between items-center mt-4">
        @if (@$from == 'detail')
        <a href="{{ route('home.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        @else
        <a href="{{ route('income.show') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        @endif
        <button id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">
            {{ $transactionName }}
        </button>
    </div>
    <div class=" w-full flex flex-col bg-white mt-6">
        <form action="{{ route('income.update', ['id'=> $id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="transaction_type_id" value="{{ $transactionid }}">
            <input type="hidden" name="user_id" value="{{ $user }}">
            <div class="mt-3">
                <x-input-label for="Title" :value="__('Title')" />
                <x-text-input id="Title" name="title" type="text" class="mt-1 block w-full" value="{{ $transaction->title ?? old('title') }}"  autofocus autocomplete="Title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div class="w-full flex justify-start items-center mt-3 gap-3">
                <select id="category" name="category_id" class="border border-[#ffa500] py-2 my-1 rounded-lg">
                    <option value="" disabled selected>Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select id="tags" name="tag_id" class="border border-[#ffa500] py-2 my-1 rounded-lg">
                    <option value="" disabled selected>Tags</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ old('tag_id', $transaction->tag_id ?? '') == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <x-input-label for="Description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ $transaction->description ?? old('description') }}"  autofocus autocomplete="description" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Created At" :value="__('Created At')" />
                <x-text-input id="date" name="date" type="datetime-local" class="mt-1 block w-full" value="{{ $transaction->date ?? old('date') }}"  autofocus="date" />
                <x-input-error class="mt-2" :messages="$errors->get('date')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Wallet" :value="__('Wallet')" />
                <select id="wallet_id" name="wallet_id" type="select" class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"  autofocus autocomplete="Payment Method" >
                    <option value="" disabled selected>Select Wallet</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ old('wallet_id', $transaction->wallet_id ?? '') == $wallet->id ? 'selected' : '' }}>
                            {{ Str::title($wallet->name) }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('wallet_id')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Amount" :value="__('Amount')" />
                <x-text-input id="amount" name="amount" type="number" min="0" class="mt-1 block w-full" value="{{ $transaction->amount ?? old('amount') }}"  autofocus autocomplete="Amount" />
                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
            </div>
            <div class="flex mt-4">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
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
                        <a href="{{ route('transfer.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">Transfer</a>
                        <a href="{{ route('planned.create') }}" id="transaction" class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">planned</a>
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