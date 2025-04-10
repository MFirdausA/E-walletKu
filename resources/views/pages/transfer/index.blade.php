@extends('layouts.app')
@section('content')

<div class="container p-6 bg-[#f2f2f7]">
    <div class="flex items-center w-full  relative">

        <div class="flex">
            <a href="{{ route('home.index')}}">
                <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
            </a>
        </div>

        <div class="grow text-center">
            <div class="font-bold text-center text-xl">Transfer History</div>
        </div>
    </div>
    <div class="flex justify-end items-center my-2">
        <div class="px-4 py-3 bg-[#ffa500] rounded-full justify-center items-center gap-1.5 inline-flex">
            <button id="openFilterButton" class="flex justify-between items-center gap-1.5">
                <p class="text-xs font-normal items-center">Filter</p>
                <svg id="fi_7693332" enable-background="new 0 0 24 24" height="12" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><g><path d="m18 13h-12c-.6 0-1-.4-1-1s.4-1 1-1h12c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g><g><path d="m15 19h-6c-.6 0-1-.4-1-1s.4-1 1-1h6c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g><g><path d="m21 7h-18c-.6 0-1-.4-1-1s.4-1 1-1h18c.6 0 1 .4 1 1s-.4 1-1 1z"></path></g></svg>
            </button>
        </div>
    </div>
    <!-- Modal Filter -->
    <div id="FilterModal" class="hidden fixed inset-0 z-50 justify-center items-center">
        <div class="w-full max-w-[640px] shadow-lg">
            <div class="fixed bg-white max-w-[640px] bottom-0 rounded-t-xl px-5 w-full left-[50%] translate-x-[-50%] gap-4 py-4 flex-row items-center justify-center">
                <div class="flex-col">
                    <button class="flex w-[32px] h-[32px] justify-center items-center rounded-full">
                        <div id="closeFilterModalButton" class="text-black hover:text-gray-700">&times;</div>
                    </button>
                    <div class="flex justify-center items-center p-2 mb-2">Filter Transactions</div>
                </div>
                <div class="flex-col">
                    <form id="filterForm" action="{{ route('transfer.index') }}" method="GET">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="filterType" class="block text-sm font-medium text-gray-700">Filter Type</label>
                                <select id="filterType" name="filterType" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Last 7 Days</option>
                                    <option value="monthly">Monthly</option>
                                    {{-- <option value="yearly">Yearly</option> --}}
                                    <option value="custom">Custom Date Range</option>
                                </select>
                            </div>
                            <div id="customDateRange" class="hidden">
                                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" id="startDate" name="startDate" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" id="endDate" name="endDate" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <button type="submit" class="w-full bg-[#FFA600] text-white py-2 px-4 rounded-md hover:bg-[#D97706]">Apply Filter</button>
                        </div>
                    </form>
                </div>
                <div class="flex-col w-full my-4 justify-center">
                    <a href="{{ route('transfer.index') }}" class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">Reset Filter</a>
                </div>
            </div>
        </div>
    </div>
    <section class="mt-2">
        @foreach ($transfers as $transfer )
        <a href="{{ route('pages.transaction-detail', ['id' => $transfer->id , 'type' => 'Transfer', 'from' => 'history-transfer'] )}}" class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transfer->category->name }}</div>
                    <img class="w-4 h-4" src="{{ asset('storage/' . $transfer->category->cover) }}" />
                    </div>
                </div>
                <div class="px-3 py-auto  bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transfer->wallet->name }}</div>
                    <img class="w-4 h-4" src="{{ asset('storage/' . $transfer->wallet->cover) }}" />
                    <span>
                        >
                    </span>
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transfer->toWallet->name }}</div>
                    <img class="w-4 h-4" src="{{ asset('storage/' . $transfer->toWallet->cover) }}" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-2">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="{{ asset('storage/' . $transfer->transactionType->cover) }}" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">{{ number_format($transfer->amount, 2, ',', '.') }}</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-end items-center">
                <div class="text-slate-400 text-[12px] font-medium italic">{{ \Carbon\Carbon::parse($transfer->date)->format('d M Y H:i') }}</div>
            </div>
        </a>
        @endforeach
    </section>
    <div class="relative flex shrink-0">
        <nav class="fixed bottom-10 w-full max-w-[640px] px-5 left-[50%] translate-x-[-50%] z-10">
            <a href="{{ route('transfer.create', ['from' => 'history-transfer']) }}" class="w-[42px] h-[42px] px-2 bg-[#ffa500] rounded-[100px] justify-center items-center gap-2.5 inline-flex">
                <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
            </a>
        </nav>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButton = document.getElementById('openFilterButton');
        const filterModal = document.getElementById('FilterModal');
        const closeFilterModalButton = document.getElementById('closeFilterModalButton');
        const filterType = document.getElementById('filterType');
        const customDateRange = document.getElementById('customDateRange');

        function openFilterModal() {
            filterModal.classList.remove('hidden');
        }

        function closeFilterModal() {
            filterModal.classList.add('hidden');
        }

        filterButton.addEventListener('click', openFilterModal);
        closeFilterModalButton.addEventListener('click', closeFilterModal);

        filterType.addEventListener('change', function() {
            if (this.value === 'custom') {
                customDateRange.classList.remove('hidden');
            } else {
                customDateRange.classList.add('hidden');
            }
        });
    });
</script>

@endsection