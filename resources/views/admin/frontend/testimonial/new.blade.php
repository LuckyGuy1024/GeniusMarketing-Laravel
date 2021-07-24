@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.frontend.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="key" value="testimonial">
                <input type="hidden" name="has_image" value="1">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ get_image(config('constants.image.default')) }})">
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image_input" id="profilePicUpload1" accept=".png, .jpg, .jpeg" required>
                                            <label for="profilePicUpload1" class="bg-primary">Upload Image</label>
                                            <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg</b>. Image will be resized into <b>{{ Config::get('constants.frontend.testimonial.size') }}px</b> and thumbnail will be resized into <b>{{ Config::get('constants.frontend.testimonial.thumb') }}px</b></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Author Name" value="{{ old('author') }}" name="author" required />
                            </div>
                            <div class="form-group">
                                <label>Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Author Designation" value="{{ old('designation') }}" name="designation" required  />
                            </div>
                            <div class="form-group">
                                <label>Quote <span class="text-danger">*</span></label>
                                <textarea rows="10" class="form-control" placeholder="Authors speach ..." name="quote" required>{{ old('quote') }}</textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="card-footer">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.frontend.testimonial.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a> 
@endpush