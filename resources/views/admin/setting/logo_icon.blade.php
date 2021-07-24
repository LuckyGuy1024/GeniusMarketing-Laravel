@extends('admin.layouts.app')

@section('panel')
<div class="card">
    <form action="{{ route('admin.setting.logo-icon') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Logo</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ get_image(config('constants.logoIcon.path') .'/logo.png', '?'.time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profilePicPreview" style="background-color: #000;background-size: 100%;background-image: url({{ get_image(config('constants.logoIcon.path') .'/logo.png', '?'.time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="logo">
                                    <label for="profilePicUpload1" class="bg-primary">Select Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Favicon</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ get_image(config('constants.logoIcon.path') .'/favicon.png', '?'.time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profilePicPreview" style="background-color: #000;background-size: 100%;background-image: url({{ get_image(config('constants.logoIcon.path') .'/favicon.png', '?'.time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload2" accept=".png" name="favicon">
                                    <label for="profilePicUpload2" class="bg-primary">Select Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer  bg-white">
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </div>
    </form>
</div>
@endsection 