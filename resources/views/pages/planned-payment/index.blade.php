@extends('layouts.app')
@section('content')

<div class="container p-6 min-h-screen bg-[#f2f2f7]">
    <div class="font-bold flex justify-center items-center text-xl">INCOME DETAIL</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <div class="w-[42px] h-[42px] px-2 bg-[#ffa500] rounded-[100px] justify-center items-center gap-2.5 inline-flex">
            <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
        </div>
    </div>
    <div class="w-full mt-3">
        <div class="text-black text-2xl font-normal font-['Poppins']">Planned Payment</div>
        <div class="text-black text-[32px] font-bold font-['Poppins']">IDR 100.000</div>
    </div>
    <section class="mt-2">
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
            <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">food & drink</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
                <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                    <div class="justify-center items-center gap-3 inline-flex">
                    <div class="text-center text-black text-[12px] font-normal font-['Poppins']">Bank</div>
                    <img class="w-4 h-4" src="https://via.placeholder.com/16x16" />
                    </div>
                </div>
            </div>
            <div class="flex-col justify-start items-center pt-2 pb-5">
                <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                        <img class="w-6 h-6" src="https://via.placeholder.com/24x24" />
                    </div>
                    <div class="h-full justify-start items-center gap-2.5 inline-flex">
                        <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">25.000,00</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection