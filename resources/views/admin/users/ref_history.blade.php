@extends('admin.layouts.app')


@section('panel')





    <div class="row">


        <div class="col-lg-12">

            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Username')</th>
                            <th scope="col">@lang('Email')</th>
                            <th scope="col">@lang('Plan')</th>
                            <th scope="col">@lang('Join date')</th>
                        </tr>
                        </thead>


                        <tbody class="list">
                        @forelse($referrals as $data)
                            <tr>
                                <td>{{$data->fullname}}</td>
                                <td>{{$data->username}}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                    @php $plan = \App\Plan::find($data->plan_id); @endphp
                                    @if($plan != NULL)
                                        {{$plan->name}}
                                    @else
                                        @lang('N/A')
                                    @endif
                                </td>

                                <td>{{show_datetime($data->created_at)}}</td>


                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__('NO DATA FOUND')}}</td>
                            </tr>
                        @endforelse
                        </tbody>


                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{$referrals->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>






@endsection

@push('breadcrumb-plugins')
    <form action="{{ route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName())) }}" method="GET" class="form-inline">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="Username or email" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

