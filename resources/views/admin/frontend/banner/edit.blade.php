@extends('admin.layouts.app')

@section('panel')





<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.frontend.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ get_image(config('constants.frontend.banner.path') .'/'. $banner->value->image) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image_input" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload1" class="bg-primary">Change Image</label>
                                            <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg</b>. Image will be resized into <b>{{ Config::get('constants.frontend.banner.size') }}px</b> and thumbnail will be resized into <b>{{ Config::get('constants.frontend.testimonial.thumb') }}px</b></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  value="{{ $banner->value->title }}" name="title" required />
                            </div>
                            <div class="form-group">
                                <label>Subtitle <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  value="{{ $banner->value->subtitle }}" name="subtitle" required/>
                            </div>
                            <div class="form-group">
                                <label>Short detail <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="details" >{{ $banner->value->details }}</textarea>
                            </div>



                        </div>
                        
                    </div>
                   
                </div>
                <div class="card-footer">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
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