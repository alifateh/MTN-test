<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\TUE;
use App\Jobs\TUE_tsk;


class TUEController extends Controller
{
    public function index()
    {
        $TUE = DB::select('select * from TUE');
        return view('TUE_view', ['TUE' => $TUE]);
    }

    public function updateOrCreate()
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
