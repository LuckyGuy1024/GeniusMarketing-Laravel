@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-body text-center border-bottom">
                <img src="{{ get_image(config('constants.admin.profile.path').'/'. auth()->guard('admin')->user()->image) }}" alt="profile-image" class="user-image">
                <h5 class="card-title mt-3">{{ auth()->guard('admin')->user()->name }}</h5>
            </div>
            <div class="card-body">
                <p class="clearfix">
                    <span class="float-left">Name</span>
                    <span class="float-right text-muted">{{ auth()->guard('admin')->user()->name }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-left">E-mail</span>
                    <span class="float-right text-muted">{{ auth()->guard('admin')->user()->email }}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9">
        <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="#0" data-target="#edit" data-toggle="pill" class="nav-link active"><i class="fa fa-pencil-square-o"></i> <span class="hidden-xs">Edit</span></a>
                </li>
                <li class="nav-item">
                    <a href="#0" data-target="#changePassword" data-toggle="pill" class="nav-link"><i class="fa fa-key"></i> <span class="hidden-xs">Change Password</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="edit">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ auth()->guard('admin')->user()->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ auth()->guard('admin')->user()->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url({{ get_image(config('constants.admin.profile.path').'/'. auth()->guard('admin')->user()->image) }})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg-primary">Upload Profile Images</label>
                                                <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg</b>. Image will be resized into <b>{{ Config::get('constants.admin.profile.size') }}px</b></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-primary mt-2" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="changePassword">
                    <form action="{{ route('admin.password.update') }}" method="POST">
                        @csrf
                        <div class="form-row justify-content-center">
                            <div class="col-lg-10 col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
    
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                    <input class="form-control" type="password" name="old_password">
    
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="input-group">
    
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                    <input class="form-control" type="password" name="password">
    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm password</label>
                                    <div class="input-group">
    
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                    <input class="form-control" type="password" name="password_confirmation">
    
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block btn-primary mt-2" value="Change Password">
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection