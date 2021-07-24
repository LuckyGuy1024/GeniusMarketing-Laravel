@extends('admin.layouts.app')

@section('panel')
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.contact.setting.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>CONTACT PHONE</label>
                        <input type="text" name="phone" class="form-control"  value="{{ $data->contact_phone }}">
                    </div>
                    <div class="form-group">
                        <label>CONTACT EMAIL</label>
                        <input type="email" name="email" class="form-control" value="{{ $data->contact_email }}">
                    </div>
                    <div class="form-group">
                        <label>CONTACT ADDRESS</label>
                        <input type="text" name="address" class="form-control"  value="{{ $data->contact_address }}">
                    </div>

                </div>
                <div class="card-footer py-4">
                    <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                </div>
            </form>


        </div>
    </div>

@endsection

@push('breadcrumb-plugins')


@endpush

@push('style-lib')

@endpush


@push('script')



@endpush
