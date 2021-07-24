@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="chatArea">
                            
                            @forelse($ticket->comments as $comment)
                                @if($comment->type == 0)
                                <div class="row justify-content-end">
                                    <div class="col-sm-10 card msg">
                                        <div class="row">                                                
                                            <div class="col-md-10">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                            <div class="col-md-2">
                                                <img src="{{ get_image(config('constants.user.profile.path') .'/'. $ticket->user->image) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row justify-content-start">
                                    <div class="col-sm-10 card msg">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}" alt="">
                                            </div>
                                            <div class="col-md-10">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                @endif
                            @empty
                                <div class="row">
                                    <div class="col-md-12 card msg">
                                        <h5>{{ __($empty_message) }}</h5>

                                    </div>
                                </div>
                            @endforelse
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="{{ route('admin.ticket.comment', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="comment" class="form-control commentBox" rows="4" placeholder="@lang('Your message')">{{ old('comment') }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer py-4">
            </div>
            
        </div>
    </div>
</div>

@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.supportTicket.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a> 
@endpush

@push('style')
<style>
    textarea.commentBox,textarea.commentBox:focus {
        overflow-y: auto;
    }

    .chatArea {
        padding: 20px;
        background: transparent;
        border: 1px solid #f7f7f7;
    }

    .chatArea .msg {
        background: #3447B8;
        padding: 20px;
        margin-bottom: 10px;
    }

    .chatArea .msg p{
        color: #fff;
        font-size: 0.9rem;
        margin-bottom: 0;
    }


    .msg .row {
        margin-right: -5px;
        margin-left: -5px;
    }

    .msg .row [class*="col"] {
        padding-right: 5px;
        padding-left: 5px;
    }

    .msg img {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        background-size: cover;
    }
</style>
@endpush