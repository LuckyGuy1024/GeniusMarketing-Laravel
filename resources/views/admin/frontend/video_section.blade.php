@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ get_image(config('constants.frontend.'. $video->key .'.path') .'/'. $video->value->image) }})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image_input" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg-primary">Choose Image</label>
                                                <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg</b>. Image will be resized into <b>{{ config('constants.frontend.'. $video->key .'.size') }}px</b></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$video->value->title}}" >
                                </div>

                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input type="text" name="link" class="form-control" value="{{$video->value->link}}"  >
                                </div>


                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea rows="10" class="form-control" name="detail" >{{$video->value->detail}}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection