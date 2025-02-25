
@extends('layouts.app')
@section('content')

<div class="container p-6">
    <div class="font-bold flex justify-center items-center text-xl">CATEGORIES</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index')}}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <a href="{{ route('category.create') }}" class="w-[42px] h-[42px] px-2 bg-[#ffa500] rounded-[100px] justify-center items-center gap-2.5 inline-flex">
            <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
        </a>
    </div>
    @foreach ( $categories as $category )
    <div class="card">
        <div class=" bg-[#ffa500] rounded-tl-xl rounded-tr-xl mt-[32px] p-3">
            <div class="w-full">
                <div class="self-stretch font-medium">
                    {{ $category->name }}
                </div>
                <div class="justify-center items-center mt-[18px]">
                    <div class="self-stretch text-2xl font-bold flex text-wrap justify-center">{{ number_format($category->remainingBalance, 2, ',', '.') }} IDR</div>
                </div>
            </div>
        </div>
            <div class="bg-white rounded-b-xl py-3 justify-around items-center flex">
                <div class="items-center text-wrap">
                    <div class="text-black font-bold">income this month</div>
                    <div class="flex justify-center">
                        <div class="text-black font-bold">{{ number_format($category->incomeAmount, 2, ',', '.') }} IDR</div>
                    </div>
                </div>
                <div class="items-center text-wrap">
                    <div class="text-black font-bold">expense this month</div>
                    <div class="flex justify-center">
                        <div class="text-black font-bold">{{ number_format($category->expenseAmount, 2, ',', '.') }} IDR</div>
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
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Income</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('expense.create') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Expense</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('planned.create') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Planned</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('transfer.create') }}">
                                <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                    <img src="{{ asset('') }}" alt="">
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