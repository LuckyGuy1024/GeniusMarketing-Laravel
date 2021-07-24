@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <form action="{{ route('admin.subscriber.sendEmail') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Subject</label>
                            <input type="text" class="form-control" placeholder="Email subject" name="subject" value="{{ old('subject') }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email Body</label>
                            <textarea name="body" rows="10" class="form-control nicEdit" placeholder="Your email template">{{ old('body') }}</textarea>
                        </div>
                      
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-block btn-primary mr-2"><i class="fa fa-fw fa-paper-plane"></i>Send Mail</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.subscriber.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>
@endpush