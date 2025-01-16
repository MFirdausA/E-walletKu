@extends('layouts.app')
<title>Home</title>
@section('content')        
        <div class="container p-6">
            <div>
                <div class="flex justify-between w-full">
                    <div class="text-base text-black font-bold underline">
                        <a href="{{route('profile.edit')}}"><p>Hi, {{ Auth::user()->name }}</p></a>
                    </div>
                    <div class="px-1.5 py-px bg-[#ffa500] rounded-md justify-center items-center gap-1.5 inline-flex">
                        <button class="flex justify-between items-center gap-1.5">
                            <p class="text-xs font-normal items-center">Filter</p>
                            <svg id="fi_7693332" enable-background="new 0 0 24 24" height="12" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><g><path d="m18 13h-12c-.6 0-1-.4-1-1s.4-1 1-1h12c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g><g><path d="m15 19h-6c-.6 0-1-.4-1-1s.4-1 1-1h6c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g><g><path d="m21 7h-18c-.6 0-1-.4-1-1s.4-1 1-1h18c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g></svg>
                        </button>
                    </div>
                </div>
                <div class="w-full items-center mt-[8px]">
                    <div class="text-[32px] font-bold">
                        IDR {{ number_format($amount, 2, ',', '.') }}
                    </div>
                </div>
            </div>
            <section>
                <div class="flex gap-2.5 mt-[8px]">
                    <a href="{{ route('income.show') }}" class="bg-[#5cf58a] w-full rounded-lg">
                        <div class="p-2 flex-col w-full justify-start items-start inline-flex">
                            <div class="justify-start items-start gap-2 inline-flex">
                                <img class="w-6 h-6" src="{{ asset('img/arrow.png') }}" />
                                <div class="text-center text-white text-base font-semibold">Income</div>
                            </div>
                            <div class="justify-center items-center inline-flex gap-1">
                                <div class="text-center text-white text-base font-bold">
                                    {{ number_format($incomeAmount, 2, ',', '.') }}
                                </div>
                                <div class="text-center text-white text-xs font-normal">IDR</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('expense.show') }}" class="bg-[#4baae5] w-full rounded-lg">
                        <div class="p-2 flex-col w-full justify-start items-start inline-flex">
                            <div class="justify-start items-start gap-2 inline-flex">
                                <img class="w-6 h-6 rotate-180" src="{{ asset('img/arrow.png') }}" />
                                <div class="text-center text-white text-base font-semibold">Expense</div>
                            </div>
                            <div class="justify-center items-center inline-flex gap-1">
                                <div class="text-center text-white text-base font-bold">
                                    {{-- 50.000.000.000 --}}
                                    {{ number_format($expenseAmount, 2, ',', '.') }}
                                </div>
                                <div class="text-center text-white text-xs font-normal">IDR</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="justify-start items-center flex gap-1">
                    <div class="text-center text-[#5cf58a] font-semibold">Cashflow: +{{ number_format($amount, 2, ',', '.') }}</div>
                    <div class="text-center text-[#5cf58a] font-semibold">IDR</div>
                </div>
            </section>
            <section class="mt-3 pb-1">
                <div class="w-full bg-[#fdfdfd]/90 rounded-lg shadow-[0px_3px_2px_0px_rgba(0,0,0,0.11)] flex-row justify-start items-start inline-flex">
                    <div class="flex w-full justify-center items-center p-[18px] gap-6">
                        <button  class="w-full items-center">
                            <a href="{{ route('category.index') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/category.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Category</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('planned.index') }}">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/planned-icon.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Planned</div>
                            </div>
                        </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="{{ route('report.index') }}">
                                <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                    <img src="{{ asset('img/report-icon.svg') }}" alt="">
                                </div>
                                <div class="gap-1 inline-flex">
                                    <div class="text-black text-xs text-center font-normal font-['Poppins']">Report</div>
                                </div>
                            </a>
                        </button>
                        <button class="w-full items-center">
                            <a href="">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/loan-icon.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Loan</div>
                            </div>
                        </a>
                        </button>
                    </div>
                </div>
            </section>
            <section class="mt-1">
                <div class="w-full self-stretch border-t border-[#919191] justify-start items-center gap-2 inline-flex">
                    <div class="w-full justify-start items-center pt-1 gap-2.5 flex">
                        <div class="text-black text-base font-semibold font-['Poppins']">{{ $dateFormat }},<br/>{{ $dateOfDay }}</div>
                    </div>
                    <div class="w-full justify-end items-end flex gap-1">
                        <div class="text-center text-[#c41d1d] text-base font-semibold font-['Poppins']">{{ number_format($amount, 2, ',', '.') }}</div>
                        <div class="text-center text-[#c41d1d] text-base font-semibold font-['Poppins']">IDR</div>
                    </div>
                </div>
            </section>
            <section>
                @foreach ($transactions as $transaction)
                <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
                    <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                        <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                            <div class="justify-center items-center gap-3 inline-flex">
                            <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transaction->category->name }}</div>
                            <img class="w-4 h-4" src="{{ asset('img/categories/' . $transaction->category->cover) }}" />
                            </div>
                        </div>
                        <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                            <div class="justify-center items-center gap-3 inline-flex">
                            <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transaction->wallet->name }}</div>
                            <img class="w-4 h-4" src="{{ $transaction->cover }}" />
                            </div>
                        </div>
                    </div>
                    <div class="flex-col justify-start items-center pt-2 pb-5">
                        <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                            <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                                <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                            </div>
                            <div class="h-full justify-start items-center gap-2.5 inline-flex">
                                <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">{{ number_format($transaction->amount, 2, ',', '.') }}</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>
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
            {{-- <div id="NavModal" class="hidden fixed inset-0 z-50 flex justify-center items-center">
                <div class="bg-gradient-to-t from-white/100 to-zinc-50/90 backdrop-blur-sm w-full h-full max-w-[640px] shadow-lg">
                    <div id="buttonContainer" class="fixed bottom-5 px-5 w-full left-[50%] translate-x-[-50%] gap-4 py-4 grid grid-cols-4 justify-between">
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
                    <div class="w-full mt-4 items-center justify-center px-5">
                        <button class="flex w-[42px] h-[42px] justify-center items-center bg-slate-300 rounded-full">
                            <div id="closeModalButton" class="text-gray-500 hover:text-gray-700">&times;</div>
                        </button>
                    </div>
                </div>
            </div> --}}
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