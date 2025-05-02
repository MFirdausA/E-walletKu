@extends('layouts.app')
@section('content')
    <div class="container p-6">
        <div class="flex justify-end items-center w-full">
            @if (@$type == 'Income') 
            <form action="{{ route('income.destroy', $transaction->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-white p-2 rounded-lg shadow-lg flex items-center">
                    <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                </button>
            </form>
            @elseif (@$type == 'Expense')
            <form action="{{ route('expense.destroy', $transaction->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-white p-2 rounded-lg shadow-lg flex items-center">
                    <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                </button>
            </form>
            @elseif (@$type == 'Transfer')
            <form action="{{ route('transfer.destroy', $transaction->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-white p-2 rounded-lg shadow-lg flex items-center">
                    <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                </button>
            </form>
            @elseif (@$type == 'Planned')
            <form action="{{ route('planned.destroy', $transaction->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-white p-2 rounded-lg shadow-lg flex items-center">
                    <img src="{{ asset('img/trash-icon.svg') }}" alt="">
                </button>
            </form>
            @endif
        </div>
        <input type="hidden" name="from" value="{{ @$from }}">
        <input type="hidden" name="type" value="{{ @$type }}">
        <div class="flex justify-start items-center w-full -1">
            @if(@$from == 'detail-income')
                <a href="{{ route('income.show') }}" >
                    <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
                </a>
            @elseif (@$from == 'detail-expense')
                <a href="{{ route('expense.show') }}" >
                    <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
                </a>
            @elseif (@$from == 'history-transfer')
                <a href="{{ route('transfer.index') }}" >
                    <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
                </a>
            @elseif (@$from == 'planned-schedule')
                <a href="{{ route('planned.index') }}" >
                    <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
                </a>
            @else 
            <a href="{{ route('home.index') }}" >
                <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
            </a>
            @endif
            <div class="flex items-center justify-center w-full">
                <h1 class="text-2xl font-bold">Transaction Detail</h1>
            </div>
        </div>
        @if (@$type == 'Income')
        <div class="container">
            <div class="flex-row bg-white p-3 rounded-lg shadow-lg mt-6">
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
                </div>
                <p class=" mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
            </div>
            <div class="grid-cols-3 flex justify-around items-center w-full bg-white p-3 rounded-lg shadow-lg mt-6">
                <div class="col-span-2 items-center text-[#5F5F5F]">
                    Category
                </div>
                <div class="col-span-1 flex items-center gap-3">
                    <div class="flex items-center">
                        <div class="bg-[#FFA600] p-2 rounded-full">
                            <img class="w-4" src="{{ asset('storage/' . $transaction->category->cover) }}" alt="">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-black">{{ $transaction->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        @elseif (@$type == 'Expense')
        <div class="container">
            <div class="flex-row bg-white p-3 rounded-lg shadow-lg mt-6">
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
                </div>
                <p class=" mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
            </div>
            <div class="grid-cols-3 flex justify-around items-center w-full bg-white p-3 rounded-lg shadow-lg mt-6">
                <div class="col-span-2 items-center text-[#5F5F5F]">
                    Category
                </div>
                <div class="col-span-1 flex items-center gap-3">
                    <div class="flex items-center">
                        <div class="bg-[#FFA600] p-2 rounded-full">
                            <img class="w-4" src="{{ asset('storage/' . $transaction->category->cover) }}" alt="">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-black">{{ $transaction->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        @elseif (@$type == 'Transfer')
        <div class="container">
            <div class="flex-row bg-white p-3 rounded-lg shadow-lg mt-6">
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
                </div>
                <p class=" mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
            </div>
            <div class="grid-cols-3 flex justify-around items-center w-full bg-white p-3 rounded-lg shadow-lg mt-6">
                <div class="col-span-2 items-center text-[#5F5F5F]">
                    Category
                </div>
                <div class="col-span-1 flex items-center gap-3">
                    <div class="flex items-center">
                        <div class="bg-[#FFA600] p-2 rounded-full">
                            <img class="w-4" src="{{ asset('storage/' . $transaction->category->cover) }}" alt="">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-black">{{ $transaction->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        @elseif (@$type == 'Planned')
        <div class="container">
            <div class="flex-row bg-white p-3 rounded-lg shadow-lg mt-6">
		@if ($status->name == 'Upcoming')
                <div class="bg-orange-200 py-1 px-4 rounded-full w-fit">
                    <p class="text-orange-500">{{ $status->name }}</p>
                </div>
                @elseif ($status->name == 'Overdue')
                <div class="bg-red-200 py-1 px-4 rounded-full w-fit">
                    <p class="text-red-500">{{ $status->name }}</p>
                </div>
                @endif
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
                        <p class="text-[#5F5F5F]">Created At</p>
                        <p>{{ $transaction->start_date }}</p>
                    </div>
                    <div class="mt-2 w-full">
                        <p class="text-[#5F5F5F]">Type of Plan</p>
                        <p>{{ $transaction->transactionType->name }}</p>
                    <div class="mt-2 w-full">
                        <p class="text-[#5F5F5F]">Repeat Every</p>
                        <p>{{ $transaction->repeatType->name }} / {{ $transaction->repeat_count }}X</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="grid-cols-3 flex justify-around items-center w-full bg-white p-3 rounded-lg shadow-lg mt-6">
                <div class="col-span-2 items-center text-[#5F5F5F]">
                    Category
                </div>
                <div class="col-span-1 flex items-center gap-3">
                    <div class="flex items-center">
                        <div class="bg-[#FFA600] p-2 rounded-full">
                            <img class="w-4" src="{{ asset('storage/' . $transaction->category->cover) }}" alt="">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-black">{{ $transaction->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="fixed bottom-5 w-full max-w-[640px] px-5 left-[50%] translate-x-[-50%] z-10">
            <div class="flex justify-between gap-2">
                @if (@$type == 'Income')
                <a href="{{ route('income.edit', $transaction->id) }}" class="w-full text-black font-bold py-4 rounded-lg bg-white hover:bg-gray-100 border border-[#FFA600]">
                    <button class="w-full">
                        Edit Transaction
                    </button>
                </a>
                @elseif (@$type == 'Expense')
                <a href="{{ route('expense.edit', $transaction->id) }}" class="w-full text-black font-bold py-4 rounded-lg bg-white hover:bg-gray-100 border border-[#FFA600]">
                    <button class="w-full">
                        Edit Transaction
                    </button>
                </a>
                @elseif (@$type == 'Transfer')
                <a href="{{ route('transfer.edit', $transaction->id) }}" class="w-full text-black font-bold py-4 rounded-lg bg-white hover:bg-gray-100 border border-[#FFA600]">
                    <button class="w-full">
                        Edit Transaction
                    </button>
                </a>
                @elseif (@$type == 'Planned')
                <a href="{{ route('planned.edit', $transaction->id) }}" class="w-full text-black font-bold py-4 rounded-lg bg-white hover:bg-gray-100 border border-[#FFA600]">
                    <button class="w-full">
                        Edit Transaction
                    </button>
                </a>
                @endif
                <a href="{{ route('pages.transaction-save', $transaction->id) }}" id="saveTransaction" class="bg-yellow-500 flex w-full justify-center text-black font-bold py-4 rounded-lg hover:bg-yellow-600">
                    Save Transaction
                </a>
            </div>
        </div>
    </div>
@endsection
