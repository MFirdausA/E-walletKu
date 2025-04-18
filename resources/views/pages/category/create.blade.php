@extends('layouts.app')
<title>Category</title>
@section('content')
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
<div class="container p-6">

    <div class="flex justify-start items-center w-full mb-4">
        <a href="{{ route('category.index') }}" >
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="">
        </a>
        <div class="flex items-center justify-center w-full">
            <h1 class="text-2xl font-bold">Manage Category</h1>
        </div>
    </div>

    <div class="flex flex-col justify-center mb-2">
        <div class=" grid-flow-col auto-cols-4">
            <div class="flex justify-start items-center">
                <button data-modal-target="addWalletModal" data-modal-toggle="addWalletModal" type="button" class="flex items-center bg-[#ffa500] text-white font-bold py-2 px-4 rounded-lg gap-2">
                    <span>Add category</span>
                    <span class="bg-white text-[#ffa500] rounded-full w-6 h-6 flex items-center justify-center">+</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-[repeat(auto-fill,minmax(160px,1fr))] gap-1">
        {{-- grid-flow-cols auto-cols-4 --}}
        @foreach ($categories as $category)
        <div class="border border-[#ffa500] p-3 rounded-lg flex items-center justify-between hover:shadow-md transition-all">
            <!-- Edit Button -->
            @if ($category->id >= 20)
            <button data-modal-target="editWalletModal{{ $category->id }}" data-modal-toggle="editWalletModal{{ $category->id }}" type="button" class="flex items-center gap-2 flex-1">
                <img src="{{ asset('storage/'.$category->cover) }}" class="w-6 h-6 object-contain" alt="icon">
                <span class="text-sm truncate">{{ $category->name }}</span>
            </button>
            @else
            <button type="button" class="flex items-center gap-2 flex-1 cursor-not-allowed" disabled>
                <img src="{{ asset('storage/'.$category->cover) }}" class="w-6 h-6 object-contain" alt="icon">
                <span class="text-sm truncate">{{ $category->name }}</span>
            </button>
            @endif
            
            <!-- Delete Button -->
            @if ($category->id >= 20)
            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1 onclick:confirm('Are you sure you want to delete this category?') hover:bg-red-300 rounded-lg transition-colors">
                    <img src="{{ asset('img/trash-icon.svg') }}" class="w-4 h-4" alt="Delete">
                </button>
            </form>
            @else
            <button class="p-1 rounded-lg cursor-not-allowed" disabled>
                <img src="{{ asset('img/trash-icon.svg') }}" class="w-4 h-4 opacity-50" alt="Cannot Delete">
            </button>
            @endif
        </div>
        <div id="editWalletModal{{ $category->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-lg font-semibold text-black">
                            Update category
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editWalletModal{{ $category->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col gap-4 mb-4">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $category->name ?? old('name') }}"  autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div class="flex flex-col">
                                <x-input-label for="cover" :value="__('Icon')" />
                                @if ($category->cover)
                                <img src="{{ asset('storage/'.$category->cover) }}" class="w-10" alt="img">
                                <span>{{ $category->cover }}</span>
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
    </div>
    <div id="addWalletModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-black">
                        Add new category
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addWalletModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
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
    
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
@endsection
