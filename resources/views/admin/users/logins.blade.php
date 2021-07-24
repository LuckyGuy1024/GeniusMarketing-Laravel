@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Username</th>
                            <th scope="col">IP</th>
                            <th scope="col">Location</th>
                            <th scope="col">Browser</th>
                            <th scope="col">OS</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($login_logs as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                            <td><a href="{{ route('admin.users.detail', $log->user->id) }}"> {{ $log->user->username }}</a></td>
                            <td>{{ $log->user_ip }}</td>
                            <td>{{ $log->location }}</td>
                            <td>{{ $log->browser }}</td>
                            <td>{{ $log->os }}</td>
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
                    {{ $login_logs->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<form action="{{ route('admin.users.login.history') }}" method="GET" class="form-inline">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Username" value="{{ $search ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@endpush