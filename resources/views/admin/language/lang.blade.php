@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">

                    <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Code</th>

                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($languages as $item)
                        <tr>
                            <td><img src="{{get_image(config('constants.language.path') .'/'. $item->icon) }}"></td>
                            <td>{{$item->name}}</td>
                            <td style="font-size: 22px;">{{ $item->code }}</td>

                            <td>
                                <span class="badge badge-dot">
                                    @if($item->is_default == 1)
                                        <i class="bg-success"></i>
                                        <span class="status">Default</span>
                                    @else
                                        <span>---</span>
                                    @endif
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.setting.language-key', $item->id)}}"><i class="fa fa-fw fa-code"></i></a>
                                <button type="button" class="btn btn-primary editBtn" data-url="{{ route('admin.setting.language-manage-update', $item->id)}}" data-lang="{{ json_encode($item->only('name', 'icon', 'text_align', 'is_default')) }}"><i class="fa fa-fw fa-edit"></i></button>
                                <button type="button" class="btn btn-danger bold uppercase deleteBtn" data-url="{{ route('admin.setting.language-manage-del', $item->id) }}"> <i class='fa fa-fw fa-trash'></i></button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{ $languages->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- NEW MODAL --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Add New Language</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form class="form-horizontal" method="post" action="{{ route('admin.setting.language-manage-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-row">

                        <label class="col-sm-12 ">Flag Icon </label>
                        <div class="col-sm-12 custom-file">
                            <input type="file" id="customFile1" name="icon" />
                            <label class="custom-file-label" for="customFile1">Choose file</label>
                        </div>
                        <small class="my-2 text-facebook">Supported files: <b>png</b>. Image will be resized into <b>{{ Config::get('constants.language.size') }}px</b></small>
                    </div>
                    <div class="form-row">
                        <label class="col-sm-12 ">Language Name <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control has-error bold " id="code" name="name" placeholder="e.g. Japaneese, Portuguese" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="col-sm-12">Language Code <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control has-error bold " id="link" name="code" placeholder="e.g. jp, pt-br" required>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="inputName" class="col-sm-12 ">Default Language <span class="text-danger">*</span></label>
                            <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="SET" data-off="UNSET" name="is_default">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bold uppercase" id="btn-save" value="add">Save</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-fw fa-share-square"></i>Edit Language</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col-sm-6">
                            <img class="mx-auto language-icon" width="80px">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-12 ">Default Language <span class="text-danger">*</span></label>
                            <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="SET" data-off="UNSET" name="is_default">
                        </div>

                        <label for="inputName" class="col-sm-12 ">Flag Icon </label>
                        <div class="col-sm-12 custom-file">
                            <input type="file" id="customFile2" class="has-error bold " name="icon" >
                            <label class="custom-file-label" for="customFile2">Choose file</label>
                        </div>
                        <small class="my-2 text-facebook">Supported files: <b>png</b>. Image will be resized into <b>{{ Config::get('constants.language.size') }}px</b></small>
                    </div>
                    <div class="form-row">
                        <label for="inputName" class="col-sm-12 ">Language Name <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control has-error bold " id="code" name="name" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bold uppercase" id="btn-save" value="add">Update</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Remove Language</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="post" action="" class="form-inline">
                @csrf
                {{method_field('delete')}}
                <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
            <div class="modal-body">
                <p class="text-muted">Are you sure you want to Delete ?</p>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger deleteButton">Delete</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<button data-toggle="modal" data-target="#myModal" class="btn btn-success bold pull-right"><i class="fa fa-plus"></i> Add New Language</button>
@endpush

@push('script')
<script>
    $('.editBtn').on('click', function() {
        var modal = $('#editModal');
        var url = $(this).data('url');
        var path = '{{ asset(config('constants.language.path')) }}';
        var lang = $(this).data('lang');

        modal.find('form').attr('action', url);
        modal.find('.language-icon').attr('src', path +'/'+ lang.icon);
        modal.find('input[name=name]').val(lang.name);
        if(lang.is_default == 1) {
            modal.find('input[name=is_default]').bootstrapToggle('on');
        }else{
            modal.find('input[name=is_default]').bootstrapToggle('off');
        }
        modal.modal('show');
    });

    $('.deleteBtn').on('click', function() {
        var modal = $('#deleteModal');
        var url = $(this).data('url');

        modal.find('form').attr('action', url);
        modal.modal('show');
    });
</script>
@endpush
