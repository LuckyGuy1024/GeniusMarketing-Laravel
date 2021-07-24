<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SupportTicket;
use App\SupportTicketComment;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index()
    {
        $page_title = 'Support Tickets';
        $empty_message = 'No support ticket';
        $tickets = SupportTicket::orderByDesc('status')->latest()->paginate(config('constants.table.default'));
        return view('admin.ticket.index', compact('page_title', 'empty_message', 'tickets'));
    }

    public function reply($id)
    {
        $ticket = SupportTicket::with(['comments'])->findOrFail($id);
        $page_title = 'Ticket #' . $ticket->ticket;
        $empty_message = 'No ticket message';

        return view('admin.ticket.detail', compact('page_title', 'empty_message', 'ticket'));
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|max:500'
        ]);
        $ticket = SupportTicket::findOrFail($id);
        $ticket->comments()->save(new SupportTicketComment([
            'comment' => $request->comment,
            'type' => 1
        ]));

        if ($ticket->status == 0) {
            $ticket->update([
                'status' => 1
            ]);
        }
        $notify[] = ['success', 'Ticket has replied.'];
        return back()->withNotify($notify);
    }
}
