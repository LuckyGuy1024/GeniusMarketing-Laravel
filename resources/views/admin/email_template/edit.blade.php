@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th>Short Code</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($email_template->shortcodes as $shortcode => $key)
                        <tr>
                            <th>@php echo "{{". $shortcode ."}}"  @endphp</th>
                            <td>{{ $key }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="100%" class="text-muted text-center">No shortcode available</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="card-title font-weight-normal">{{ $page_title }}</h4>
            </div>
            <form action="{{ route('admin.email-template.update', $email_template->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-8">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email subject" name="subject" value="{{ $email_template->subj }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Status <span class="text-danger">*</span></label>

                            <input type="checkbox" data-height="46px" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Send Email" data-off="Don't Send" name="email_status" @if($email_template->email_status) checked @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Message <span class="text-danger">*</span></label>
                            <textarea name="email_body" rows="10" class="form-control nicEdit" placeholder="Your message using shortcodes">{{ $email_template->email_body }}</textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-block btn-primary mr-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.email-template.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a> 
@endpush