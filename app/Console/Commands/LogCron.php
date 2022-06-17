<?php

namespace App\Console\Commands;

use App\Models\TUE;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Http\Controllers;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an hourly TUE';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Tickets = DB::select('select * from Ticket');
        foreach ($Tickets as $item) {
            TUE::updateOrCreate(
                ['UserRef' => $item->UserRef, 'TicketRef' => $item->id],
                ['Cost' => $item->Cost, 'TCap' => $item->TCap, 'CCap' => $item->CCap, 'Vat' => ($item->Cost) * 1.09, 'ToCost' => (($item->Cost) * ($item->TCap) + ($item->Cost) * 1.09)]
            );
        }
    }
}
