@extends('layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
        #container {
        height: 250px;
        border-top-left-radius: 0.5rem; /* 8px */
        border-top-right-radius: 0.5rem; /* 8px */
    }
        #container1 {
        height: 250px;
        border-top-left-radius: 0.5rem; /* 8px */
        border-top-right-radius: 0.5rem; /* 8px */
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

    <div class="font-bold flex justify-center items-center text-xl">REPORT</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <div class="flex gap-3 items-center">
            <button class="border border-[#ffa500] bg-white flex justify-between gap-1 py-2 px-4 my-1 mx-0.2 rounded-lg"><img src="{{ asset('img/calender-icon.svg') }}" alt="">Month</button>
        </div>
    </div>
    <div>
        <div class="w-full flex justify-between items-center mt-3">
            <div class="text-black font-normal font-['Poppins']">Income</div>
            <div class="text-black font-bold font-['Poppins']">IDR {{ number_format($incomeAmount , 2, ',', '.') }}</div>
        </div>
        <div class="w-full flex justify-between items-center mt-1">
            <div class="text-black font-normal font-['Poppins']">Expense</div>
            <div class="text-black font-bold font-['Poppins']">IDR {{ number_format($expenseAmount , 2, ',', '.') }}</div>
        </div>
        <div class="w-full flex justify-between items-center mt-1">
            <div class="text-black font-normal font-['Poppins']">Total</div>
            <div class="text-black font-bold font-['Poppins']">IDR {{ number_format($totalAmount , 2, ',', '.') }}</div>
        </div>
    </div>
    <div class="mt-4">
        <figure class="highcharts-figure">
            <div id="container"></div>
            <div class="p-2 bg-white rounded-b-[8px] border-t">
                <a href="{{ route('income.show')}}" class="text-black hover:text-[#ffa500]">details</a>
            </div>
        </figure>
    </div>
    <div class="mt-4">
        <figure class="highcharts-figure">
            <div id="container1"></div>
            <div class="p-2 bg-white rounded-b-[8px] border-t">
                <a href="{{ route('expense.show')}}" class="text-black hover:text-[#ffa500]">details</a>
            </div>
        </figure>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/income-chart')
            .then(response => response.json())
            .then(data => {
                const chartData = data.map(item => [item.category, item.amount]);

                Highcharts.chart('container', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 35
                        }
                    },
                    title: {
                        text: 'Income'
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 100,
                            depth: 35
                        }
                    },
                    series: [{
                        name: 'Amount',
                        data: chartData
                    }]
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/expense-chart')
            .then(response => response.json())
            .then(data => {
                const chartData = data.map(item => [item.category, item.amount]);

                Highcharts.chart('container1', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 35
                        }
                    },
                    title: {
                        text: 'Expense'
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 100,
                            depth: 35
                        }
                    },
                    series: [{
                        name: 'Amount',
                        data: chartData
                    }]
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>
@endsection