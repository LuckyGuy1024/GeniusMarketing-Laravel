@extends('admin.layouts.app')

@section('panel')
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.frontend.update', $titles->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Copyright</label>
                        <input type="text" name="title" class="form-control" placeholder="Section Title" value="{{ $titles->value->title }}">
                    </div>
                    <div class="form-group">
                        <label>Foorter About</label>
                        <input type="text" name="subtitle" class="form-control"  placeholder="Section Sub-Title" value="{{ $titles->value->subtitle }}">
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
