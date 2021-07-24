@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse ($sms_templates as $template)
                            <tr>
                                <td>{{ $template->name }}</td>
                                <td>
                                    <span class="badge badge-dot">
                                        @if($template->sms_status == 1)
                                            <i class="bg-success"></i>
                                            <span class="status">active</span>
                                        @else
                                            <i class="bg-danger"></i>
                                            <span class="status">disabled</span>
                                        @endif
                                    </span>
                                </td>
                                <td><a href="{{ route('admin.sms-template.edit', $template->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
                    {{ $sms_templates->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection