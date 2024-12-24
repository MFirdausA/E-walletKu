@extends('layouts.app')
<title>Home</title>
@section('content')        
        <div class="container p-6">
            <div class="flex justify-between w-full">
                <div class="text-base text-black font-semibold">
                    <p>Hi, {{ Auth::user()->name }}</p>
                </div>
                <div class="px-1.5 py-px bg-[#ffa500] rounded-md justify-center items-center gap-1.5 inline-flex">
                    <button class="flex justify-between items-center gap-1.5">
                        <p class="text-xs font-normal items-center">Filter</p>
                        <svg id="fi_7693332" enable-background="new 0 0 24 24" height="12" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><g><path d="m18 13h-12c-.6 0-1-.4-1-1s.4-1 1-1h12c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g><g><path d="m15 19h-6c-.6 0-1-.4-1-1s.4-1 1-1h6c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g><g><path d="m21 7h-18c-.6 0-1-.4-1-1s.4-1 1-1h18c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g></svg>
                    </button>
                </div>
            </div>
            <section>
                <div class="w-full items-center mt-[16px]">
                    <div class="text-[32px] font-bold">
                        IDR 100.000,00
                    </div>
                </div>
                <div class="flex gap-2.5 mt-[8px]">
                    <button class="bg-[#5cf58a] w-full rounded-lg">
                        <div class="p-2 flex-col w-full justify-start items-start inline-flex">
                            <div class="justify-start items-start gap-2 inline-flex">
                                <img class="w-6 h-6" src="{{ asset('img/arrow.png') }}" />
                                <div class="text-center text-white text-base font-semibold">Income</div>
                            </div>
                            <div class="justify-center items-center inline-flex gap-1">
                                <div class="text-center text-white text-base font-bold">50.000.000.000</div>
                                <div class="text-center text-white text-xs font-normal">IDR</div>
                            </div>
                        </div>
                    </button>
                    <button class="bg-[#4baae5] w-full rounded-lg">
                        <div class="p-2 flex-col w-full justify-start items-start inline-flex">
                            <div class="justify-start items-start gap-2 inline-flex">
                                <img class="w-6 h-6 rotate-180" src="{{ asset('img/arrow.png') }}" />
                                <div class="text-center text-white text-base font-semibold">Expense</div>
                            </div>
                            <div class="justify-center items-center inline-flex mt-2 gap-1">
                                <div class="text-center text-white text-base font-bold">50.000.000.000</div>
                                <div class="text-center text-white text-xs font-normal">IDR</div>
                            </div>
                        </div>
                    </button>
                </div>
                <div class="justify-start items-center flex gap-1">
                    <div class="text-center text-[#5cf58a] text-base font-semibold">Cashflow: +50.000,00</div>
                    <div class="text-center text-[#5cf58a] text-base font-semibold">IDR</div>
                </div>
            </section>
            <section class="mt-3">
                <div class="w-full bg-[#fdfdfd]/90 rounded-lg shadow-[0px_3px_2px_0px_rgba(0,0,0,0.11)] flex-row justify-start items-start inline-flex">
                    <div class="flex w-full justify-center items-center p-[18px] gap-6">
                        <button class="w-full items-center">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/category.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Category</div>
                            </div>
                        </button>
                        <button class="w-full items-center">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/category.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Planned</div>
                            </div>
                        </button>
                        <button class="w-full items-center">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/category.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Report</div>
                            </div>
                        </button>
                        <button class="w-full items-center">
                            <div class="w-[42px] h-[42px] m-auto bg-neutral-100 rounded-full flex justify-center items-center">
                                <img src="{{ asset('img/category.svg') }}" alt="">
                            </div>
                            <div class="gap-1 inline-flex">
                                <div class="text-black text-xs text-center font-normal font-['Poppins']">Loan</div>
                            </div>
                        </button>
                    </div>
                </div>
            </section>
            <section class="mt-1">
                

            </section>
        </div>
@endsection