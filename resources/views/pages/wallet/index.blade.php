@extends('layouts.app')
<title>Wallet</title>
@section('content')
<div class="container p-6 bg-white">

    <div class="font-bold flex justify-center items-center bg-white text-xl mb-6">Add Your Wallet</div>

    <div class="min-h-screen flex flex-col justify-center items-start bg-white">
        <div class=" grid-flow-col auto-cols-3">
            <div class="flex justify-start items-center">
                <button class="flex items-center bg-[#ffa500] text-white font-bold py-2 px-4 rounded-lg gap-2">
                    <span>Add Wallet</span>
                    <span class="bg-white text-[#ffa500] rounded-full w-6 h-6 flex items-center justify-center">+</span>
                </button>
            </div>
            <div class="grid-flow-col auto-cols-3">
                <button class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">wallet 1</button>
                <button class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">wallet 2</button>
                <button class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">wallet 3</button>
                <button class="border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">wallet 4</button>
            </div>
        </div>
    </div>
</div>
@endsection
