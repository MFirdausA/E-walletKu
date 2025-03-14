<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\plannedPayment;
use Illuminate\Console\Command;

class UpdateOverduePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-overdue-payments';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update past upcoming payments status to Overdue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        plannedPayment::where('status_id', '!=', 'Complete')
        ->whereDate('start_date', '<', Carbon::today()->timezone('Asia/Jakarta'))
        ->update(['status_id' => 'Overdue']);

    $this->info('Overdue payments updated successfully.');
    }
}
