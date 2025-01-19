@extends('layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
    #container {
    height: 250px;
    border-radius: 8px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 640px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-description {
    margin: 0.3rem 10px;
}
</style>
@section('content')
<div class="container p-6 min-h-screen bg-[#f2f2f7]">

    <div class="font-bold flex justify-center items-center text-xl">EXPENSE DETAIL</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <a href="{{ route('expense.create',['from' => 'detail']) }}" class="flex gap-3 items-center">
            <button class="border border-[#ffa500] flex justify-between gap-1 py-2 px-4 my-1 mx-0.2 rounded-lg"><img src="{{ asset('img/calender-icon.svg') }}" alt="">Month</button>
            <div class="w-[42px] h-[42px] px-2 bg-[#ffa500] rounded-[100px] justify-center items-center gap-2.5 inline-flex">
                <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
            </div>
        </a>
    </div>
    <div class="w-full mt-3">
        <div class="text-black text-2xl font-normal font-['Poppins']">Income</div>
        <div class="text-black text-[32px] font-bold font-['Poppins']">IDR 100.000</div>
    </div>
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
    <section>
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

    <script>
        // Data retrieved from https://olympics.com/en/olympic-games/beijing-2022/medals
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Medals',
        data: [
            ['Norway', 16],
            ['Germany', 12],
            ['USA', 8],
            ['Sweden', 8],
            ['Netherlands', 8],
            ['ROC', 6],
            ['Austria', 7],
            ['Canada', 4],
            ['Japan', 3]

        ]
    }]
});

    </script>
@endsection