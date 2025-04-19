@extends('layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

<div class="container p-6">
    <div class="font-bold flex justify-center items-center text-xl">ACCOUNT</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index') }}" class="w-full flex justify-between items-center">
                <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <button data-modal-target="addWalletModal" data-modal-toggle="addWalletModal" type="button" class="w-[45px] h-[42px] px-2 bg-[#ffa500] rounded-full justify-center items-center gap-2.5 inline-flex">
            <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
        </button>
    </div>
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
    <div class="card @if($wallet->id < 3) cursor-not-allowed @endif"
        @if($wallet->id >= 3)
            data-modal-target="editWalletModal{{ $wallet->id }}"
            data-modal-toggle="editWalletModal{{ $wallet->id }}"
        @endif
        >
        <div class=" bg-[#ffa500] rounded-tl-xl rounded-tr-xl mt-[24px] p-3">
            <div class="w-full">
                <div class="self-stretch font-medium flex justify-between items-center">
                    <div>
                        {{ $wallet->name }}
                    </div>
                    @if ($wallet->id >= 3)
                    <div>
                        <form action="{{ route('wallet.destroy', $wallet->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1 bg-white hover:bg-red-600 rounded-lg transition-colors">
                                <img src="{{ asset('img/trash-icon.svg') }}" class="w-4 h-4 fill-white" alt="Delete">
                            </button>
                        </form>
                    </div>
                    @else
                    <button type="submit" class="p-1 bg-white rounded-lg transition-colors cursor-not-allowed" disabled>
                                <img src="{{ asset('img/trash-icon.svg') }}" class="w-4 h-4 fill-white" alt="Delete">
                            </button>
                    @endif
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
    <div id="editWalletModal{{ $wallet->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-black">
                        Update category
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editWalletModal{{ $wallet->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('wallet.update', $wallet->id) }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-4 mb-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $wallet->name ?? old('name') }}"  autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="flex flex-col">
                            <x-input-label for="cover" :value="__('Icon')" />
                            @if ($wallet->cover)
                            <img src="{{ asset('storage/'.$wallet->cover) }}" class="w-10" alt="img">
                            <span>{{ $wallet->cover }}</span>
                            @endif
                            <input type="file" id="fileInput" name="cover" value="{{ old('cover') }}" class="mb-2 w-full text-sm text-gray-500 file:py-2 rounded-full  file:text-sm file:font-semibold file:bg-[#ffa500] file:text-white hover:file:bg-[#cc8400]">
                            <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                        </div>
                    </div>
                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <div id="addWalletModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-black">
                        Add new Wallet
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-red-600 dark:hover:text-white" data-modal-toggle="addWalletModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('wallet.store') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    <div class="flex flex-col gap-4 mb-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"  autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="flex flex-col">
                            <x-input-label for="cover" :value="__('Icon')" />
                            <input type="file" id="cover" name="cover"
                                class="mb-2 w-full text-sm text-gray-500 file:py-2 rounded-full  file:text-sm file:font-semibold file:bg-[#ffa500] file:text-white hover:file:bg-[#cc8400]">
                            <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                        </div>
                    </div>
                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div> 
    <div id="BottomNav" class="relative flex w-full h-[100px] shrink-0">
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
    </div>
    <div id="NavModal" class="hidden fixed inset-0 z-50 justify-center items-center">
        <div class="w-full max-w-[640px] shadow-lg">
            <div class="fixed bg-white max-w-[640px] bottom-0 rounded-t-xl px-5 w-full left-[50%] translate-x-[-50%] gap-4 py-4 flex-row items-center justify-center">
                <div class="flex-col">
                    <button class="flex w-[32px] h-[32px] justify-center items-center  rounded-full">
                        <div id="closeModalButton" class="text-black hover:text-gray-700">&times;</div>
                    </button>
                    <div class="flex justify-center items-center p-2 mb-2">Add Transaction</div>
                </div>
                <div class="flex-col">
                    <div class="grid grid-cols-4 gap-2">
                        <button  class="w-full items-center">
                            <a href="{{ route('income.create') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-[#E86A14] rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/arrow.png') }}" class="w-6 h-6" alt="income">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Income</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('expense.create') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-[#E86A14] rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/arrow.png') }}" class="w-6 h-6 rotate-180" alt="expense">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Expense</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('planned.create') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-[#E86A14] rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/plannedPayment-icon.svg') }}" class="w-6 h-6" alt="planned">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Planned</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('transfer.create') }}">
                                <div class="w-[42px] h-[42px] m-auto bg-[#E86A14] rounded-full flex justify-center items-center">
                                    <img src="{{ asset('img/transferTransaction-icon.svg') }}" class="w-6 h-6" alt="transfer">
                                </div>
                                <div class="gap-1 inline-flex">
                                    <div class="text-black text-xs text-center font-normal font-['Poppins']">Transfer</div>
                                </div>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
const openModalButton = document.getElementById('openModal');
const closeModalButtons = document.querySelectorAll('#closeModalButton, #closeModalFooterButton');
const modal = document.getElementById('NavModal');

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