@extends('layouts.app')
@section('content')
<div class="container p-6 min-h-screen bg-white">

    <div class="font-bold flex justify-center items-center text-xl">PLANNED PAYMENT</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('planned.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
    </div>
    <div class=" w-full flex flex-col bg-white mt-6">
        <form action="{{ route('planned.store') }}" method="POST">
            @csrf
            <div class="mt-3">
                <x-input-label for="Title" :value="__('Transaction')" />
                <div class="flex justify-between items-center mt-0.5 gap-1">
                    <div class="h-[30px] w-full px-2 py-0.5 bg-[#5cf58a] rounded-lg justify-center items-center gap-2 inline-flex">
                        <div class="justify-center items-center gap-2.5 flex">
                            <div class="text-center text-black text-xs font-normal font-['Poppins']">Income</div>
                        </div>
                    </div>
                    <div class="h-[30px] w-full px-2 py-0.5 bg-[#4baae5] rounded-lg justify-center items-center gap-2 inline-flex">
                        <div class="justify-center items-center gap-2.5 flex">
                            <div class="text-center text-black text-xs font-normal font-['Poppins']">Income</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <x-input-label for="Title" :value="__('Title')" />
                <x-text-input id="Title" name="Title" type="text" class="mt-1 block w-full" :value="old('Title')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('Title')" />
            </div>
            <div class="w-full flex justify-start items-center mt-3 gap-3">
                <button class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">Category</button>
                <button class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">Tags</button>
            </div>
            <div class="mt-3">
                <x-input-label for="Description" :value="__('Description')" />
                <x-text-input id="Description" name="Description" type="text" class="mt-1 block w-full" :value="old('Description')" required autofocus autocomplete="Description" />
                <x-input-error class="mt-2" :messages="$errors->get('Description')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Planned date of payment" :value="__('Planned date of payment')" />
                <x-text-input id="Planned date of payment" name="Planned date of payment" type="datetime-local" class="mt-1 block w-full" :value="old('Planned date of payment')" required autofocus autocomplete="Planned date of payment" />
                <x-input-error class="mt-2" :messages="$errors->get('Planned date of payment')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Payment Method" :value="__('Wallet')" />
                <x-text-input id="Payment Method" name="Payment Method" type="select" class="mt-1 block w-full" :value="old('Payment Method')" required autofocus autocomplete="Payment Method" />
                <x-input-error class="mt-2" :messages="$errors->get('Payment Method')" />
            </div>
            <div class="mt-3">
                <x-input-label for="Amount" :value="__('Amount')" />
                <x-text-input id="Amount" name="Amount" type="numeric" class="mt-1 block w-full" :value="old('Amount')" required autofocus autocomplete="Amount" />
                <x-input-error class="mt-2" :messages="$errors->get('Amount')" />
            </div>
            <div class="flex mt-3">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection