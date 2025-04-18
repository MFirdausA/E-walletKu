{{-- @extends('layouts.app')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="transaction-receipt container p-6 min-h-screen bg-gradient-to-b from-[#ffa500] to-white">
        <div class="flex flex-col items-center">
            <x-main-app-logo class="block w-auto fill-current" />
            <h1 class="text-2xl font-bold">E-WalletKu</h1>
        </div>
        
        <div class="flex-row bg-white p-2 rounded-lg shadow-lg mt-6">
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
                <div class="mt-2 w-full">
                    <p class="text-[#5F5F5F]">Category</p>
                    <p>{{ $transaction->category->name }}</p>
                </div>
            </div>
            <p class=" mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
        </div>
    </div>
@endsection --}}
<!DOCTYPE html>
<html>
<head>
    <title>Transaction Receipt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' media="screen,print">
    <link rel="stylesheet" href="https://cdn.tailwindcss.com" media="screen,print">
    <style>
        
        @media print {
            body {
                margin: 0;
                padding: 0;
                font-family: 'Poppins';
                background-color: white;
                -webkit-print-color-adjust: exact;
            }

            #body {
                margin: 0px 0px;
                background-color: white;
            }

        }
        
        #Content-Container {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 640px;
            /* min-height: 100vh; */
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            overflow-x: hidden;
        }
        
        .transaction-receipt {
            padding: 1rem;
            margin-top: auto;
            margin-bottom: auto;
            background: #FFA500;
            border-radius: 1rem;
            /* background:  */
            /* background: linear-gradient(180deg, rgba(255, 165, 0, 1) 0%, rgba(255, 255, 255, 1) 90%); */
        }
        
        /* Header Styles */
        .transaction-receipt .flex-col {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .transaction-receipt h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 0.5rem;
        }
        
        /* Receipt Card Styles */
        .transaction-receipt .flex-row {
            display: flex;
            flex-direction: column;
            background-color: white;
            padding: 0.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin-top: 1.5rem;
        }
        
        .transaction-receipt .w-full {
            width: 100%;
        }
        
        /* Transaction Details */
        .transaction-receipt .text-2xl {
            font-size: 1.5rem;
        }
        
        .transaction-receipt .font-semibold {
            font-weight: 600;
        }
        
        .transaction-receipt .text-\[\#5F5F5F\] {
            color: #5F5F5F;
        }
        
        .transaction-receipt .text-\[14px\] {
            font-size: 14px;
        }
        
        .transaction-receipt .mt-2 {
            margin-top: 0.5rem;
        }
        
        .transaction-receipt .my-3 {
            margin-top: 0.75rem;
            margin-bottom: 0.75rem;
        }
        
        .transaction-receipt .text-\[24px\] {
            font-size: 24px;
        }
        
        .transaction-receipt .font-bold {
            font-weight: 700;
        }
        
        /* Tag Styles */
        .transaction-receipt .bg-gray-200 {
            background-color: #e5e7eb;
        }
        
        .transaction-receipt .rounded-lg {
            border-radius: 0.5rem;
        }
        
        .transaction-receipt .p-2 {
            padding: 0.5rem;
        }
        
        .transaction-receipt .w-fit {
            width: fit-content;
        }
        
        .transaction-receipt .flex {
            display: flex;
        }
        
        .transaction-receipt .items-center {
            align-items: center;
        }
        
        .transaction-receipt .mt-1 {
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div id="Content-Container">
        <div class="transaction-receipt">
            <div class="flex-col items-center">
                <img src="{{ asset('img/app-logo.png') }}" alt="E-WalletKu Logo" style="width: 250px">
                <h1>E-WalletKu</h1>
            </div>
            
            <div class="flex-row">
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
                    <div class="mt-2 w-full">
                        <p class="text-[#5F5F5F]">Category</p>
                        <p>{{ $transaction->category->name }}</p>
                    </div>
                </div>
                <p class="mt-1 bg-gray-200 flex w-fit items-center rounded-lg p-2">#{{ $transaction->tag->name }}</p>
            </div>
        </div>
    </div>
</body>
</html>