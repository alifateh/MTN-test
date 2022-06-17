<?php

namespace App\Jobs;

use App\Models\TUE;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class TUE_tsk implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
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
