<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overdue Planned</title>
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: poppins, sans-serif;
            line-height: 1.5;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hi {{ $overduePlanned->user->name }}</h1>
        <p>We have detected that you have overdue planned tasks.</p>
        <p>Here are the details:</p>
        <div>
            <p>Title: {{ $overduePlanned->title }}</p>
            <p>Do Date: {{ $overduePlanned->start_date }}</p>
            <p>Wallet: {{ $overduePlanned->wallet->name }}</p>
            <p>Category: {{ $overduePlanned->category->name }}</p>
            <p>Amount: {{ $overduePlanned->amount }}</p>
            <p>Description: {{ $overduePlanned->description }}</p>
        </div>
        <div>
            <p><strong>Paid and status will be updated to complete.</strong></p>
        </div>
        <div>
            <p>
                We are E-Walletku Support
            </p>
            <p>
                <strong>copyright &copy; {{ date('Y') }} E-Walletku</strong>, All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>