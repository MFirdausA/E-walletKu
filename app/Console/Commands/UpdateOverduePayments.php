<?php

namespace App\Console\Commands;

use App\Mail\OverduePlanned;
use App\Mail\ReminderPlanned;
use Carbon\Carbon;
use App\Models\plannedPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UpdateOverduePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:planned-payment';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update past upcoming payments status to Overdue';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $today = Carbon::now()->timezone('Asia/Jakarta');
        $reminderDate = $today->subDay()->timezone('Asia/Jakarta');

        $reminderPlanneds = plannedPayment::where('start_date', '>=', now()->subDays(1))
        ->where('start_date', '<', now())
        ->where('status_id', 1)
        ->where('reminder_sent', 0)
        ->get();

        foreach ($reminderPlanneds as $reminderPlanned) {
            Mail::to($reminderPlanned->user->email)->send(new ReminderPlanned($reminderPlanned));
            $reminderPlanned->update(['reminder_sent' => 1]);
        }

        $overduePlanneds = plannedPayment::where('start_date', '<=', now())
        ->where('status_id', 1)
        ->get();

        foreach ($overduePlanneds as $overduePlanned) {
            $overduePlanned->update(['status_id' => 2]);
            Mail::to($overduePlanned->user->email)->send(new OverduePlanned($overduePlanned));
        }

        $this->info('Overdue payments updated and emails sent successfully.');
        Log::info('Overdue payments updated and emails sent successfully.', [
            'overduePlanneds' => $overduePlanneds,
            'reminderPlanneds' => $reminderPlanneds,
        ]);
    }
}
