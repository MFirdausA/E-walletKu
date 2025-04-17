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
        <h1>Hi {{ $reminderPlanned->user->name }}</h1>
        <p>We remind you have planned payment duo soon</p>
        <p>Here are the details:</p>
        <div>
            <p>Title: {{ $reminderPlanned->title }}</p>
            <p>Do Date: {{ $reminderPlanned->start_date }}</p>
            <p>Wallet: {{ $reminderPlanned->wallet->name }}</p>
            <p>Category: {{ $reminderPlanned->category->name }}</p>
            <p>Amount: {{ $reminderPlanned->amount }}</p>
            <p>Description: {{ $reminderPlanned->description }}</p>
        </div>
        <div>
            <p><strong>Paid your payment before overdue and status will be updated to complete.</strong></p>
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