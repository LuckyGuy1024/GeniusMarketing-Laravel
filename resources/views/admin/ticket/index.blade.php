@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">Ticket</th>
                            <th scope="col">Subject</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->ticket }}</td>
                                <td>{{ description_shortener($ticket->subject, 120) }}</td>
                                <td>{{ $ticket->user->username }}</td>
                                <td>



                                    @if($ticket->status == 0)
                                        <span class="badge badge-danger">Closed</span>
                                    @else

                                        @php
                                            $reply = \App\SupportTicketComment::orderBy('id', 'DESC')->where('ticket_id', $ticket->id)->first();
                                        @endphp
                                        @if ($reply->type == 0)
                                            <span class="badge badge-primary">@lang('customer reply')</span>
                                        @else
                                            <span class="badge badge-info">@lang('admin reply')</span>
                                        @endif



                                        <span class="badge badge-success">Open</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.supportTicket.reply', [$ticket->id, slug($ticket->ticket)]) }}" class="btn btn-rounded btn-primary replyBtn"><i class="fa fa-fw fa-reply"></i>Reply</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        {{ $tickets->appends($_GET)->links() }}
                    </nav>
                </div>

            </div>
        </div>
    </div>


@endsection
