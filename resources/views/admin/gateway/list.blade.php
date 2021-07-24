@extends('admin.layouts.app')

@section('panel')
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Gateway</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                    @forelse($gateways as $gateway)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="{{ route('admin.deposit.gateway.edit', $gateway->code) }}" class="avatar avatar-sm rounded-circle mr-3">
                                        <img src="{{ get_image(config('constants.deposit.gateway.path') .'/'. $gateway->image) }}" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <span class="name mb-0">{{ $gateway->name }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge badge-dot">
                                    @if($gateway->status == 1)
                                        <i class="bg-success"></i>
                                        <span class="status">active</span>
                                    @else
                                        <i class="bg-danger"></i>
                                        <span class="status">disabled</span>
                                    @endif
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.deposit.gateway.edit', $gateway->code) }}" class="btn btn-info btn-icon editGatewayBtn"><i class="fa fa-fw fa-pencil"></i></a>
                                @if($gateway->status == 0)
                                    <button class="btn btn-success activateBtn" data-code="{{ $gateway->code }}" data-name="{{ $gateway->name }}" data-toggle="modal" data-target="#activateModal"><i class="fa fa-fw fa-eye"></i></button>
                                @else
                                    <button class="btn btn-danger deactivateBtn" data-code="{{ $gateway->code }}" data-name="{{ $gateway->name }}" data-toggle="modal" data-target="#deactivateModal"><i class="fa fa-fw fa-eye-slash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        {{ $gateways->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Method Activation Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.gateway.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p>Are you sure to activate <span class="font-weight-bold method-name"></span> method?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Activate</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATE METHOD MODAL --}}
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Method Disable Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.gateway.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p>Are you sure to disable <span class="font-weight-bold method-name"></span> method?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Disable</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
<script>
    $('.activateBtn').on('click', function() {
        var modal = $('#activateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });

    $('.deactivateBtn').on('click', function() {
        var modal = $('#deactivateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });
</script>
@endpush