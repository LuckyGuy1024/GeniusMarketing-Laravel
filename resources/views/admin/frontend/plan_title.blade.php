
@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.update', $titles->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Section Title" value="{{ $titles->value->title }}">
                        </div>
                        <div class="form-group">
                            <label>SubTitle</label>
                            <input type="text" name="subtitle" class="form-control"  placeholder="Section Sub-Title" value="{{ $titles->value->subtitle }}">
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                    </div>
                </form>


            </div>
        </div>

    </div>


@endsection



