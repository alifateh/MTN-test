<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;


class TicketController extends Controller
{
    public function index()
    {
        $Tickets = DB::select('select * from Ticket');
        return view('Ticket_view', ['Tickets' => $Tickets]);
    }

    public function update(Request $request, $id)
    {
        $Tickets = Ticket::find($id);
        if ($Tickets->CCap == 0) {
            if (400 - ($Tickets->TCap + $request->input('quantity')) == 0) {
                $Tickets->TCap = $Tickets->TCap + $request->input('quantity');
                $Tickets->CCap = 1;
                $Tickets->update();
                return redirect('view-tickets')->with('status', 'Ticket successfully Reserved');
            } else {
                $Tickets->TCap = $Tickets->TCap + $request->input('quantity');
                $Tickets->update();
                return redirect('view-tickets')->with('status', 'Ticket successfully Reserved');
            }
        } else {
            return redirect('view-tickets')->with('status', 'Ticket Not Reserved');
        }
    }
}
