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



    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Author</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Quote</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($testimonials as $testi)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="{{ route('admin.frontend.testimonial.edit', $testi->id) }}" class="avatar avatar-sm rounded-circle mr-3">
                                        <img src="{{ get_image(config('constants.frontend.testimonial.path') .'/'. $testi->value->image) }}" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ route('admin.frontend.testimonial.edit', $testi->id) }}"><span class="name mb-0">{{ $testi->value->author }}</span></a>
                                    </div>

                                </div>
                            </td>
                            <td>{{ $testi->value->designation }}</td>
                            <td>{{ description_shortener($testi->value->quote) }}</td>
                            <td>
                                <a href="{{ route('admin.frontend.testimonial.edit', $testi->id) }}" class="btn btn-rounded btn-primary text-white"><i class="fa fa-fw fa-pencil"></i></a>
                                <button class="btn btn-danger removeBtn" data-id="{{ $testi->id }}"><i class="fa fa-trash"></i></button>
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
                    {{ $testimonials->links() }}
                </nav>
            </div>
            
        </div>
    </div>
</div>

{{-- REMOVE METHOD MODAL --}}
<div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Testimonial Removal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.frontend.remove') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to remove this post?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Remove</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.frontend.testimonial.new') }}" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add New</a>
@endpush

@push('script')

<script>
    $('.removeBtn').on('click', function() {
        var modal = $('#removeModal');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });
</script>
    
@endpush