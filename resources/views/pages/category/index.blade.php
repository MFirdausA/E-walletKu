@extends('layouts.app')
<title>Category</title>
@section('content')
<div class="container p-6">

    <div class="font-bold flex justify-center items-center text-xl mb-6">Add Your Category</div>

    <div class="flex flex-col justify-center items-start">
        <div class=" grid-flow-col auto-cols-3">
            <div class="flex justify-start items-center">
                <button class="flex items-center bg-[#ffa500] text-white font-bold mb-2 py-2 px-4 rounded-lg gap-2">
                    <span>Add Category</span>
                    <span class="bg-white text-[#ffa500] rounded-full w-6 h-6 flex items-center justify-center">+</span>
                </button>
            </div>
            @foreach ( $categories as $category )
            <button class="grid-flow-col auto-cols-3 border border-[#ffa500] py-2 px-4 my-1 mx-0.2 rounded-lg">{{ $category->name}}</button>
            @endforeach
        </div>
    </div>
</div>
@endsection
