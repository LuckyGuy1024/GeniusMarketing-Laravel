@extends(activeTemplate() .'layouts.app')
@section('style')

@stop
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body text-center border-bottom">
                    <img src="{{ get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}"
                         alt="profile-image" class="user-image">
                    <h5 class="card-title mt-3">{{ Auth::user()->name }}</h5>
                </div>
                <div class="card-body">
                    <p class="clearfix">
                        <span class="float-left">@lang('Username')</span>
                        <span class="float-right font-weight-bold"><a
                                href="{{ route('admin.users.detail', Auth::user()->id) }}">{{ Auth::user()->username }}</a></span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">@lang('E-mail')</span>
                        <span class="float-right text-muted">{{ Auth::user()->email }}</span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">@lang('NIC')</span>
                        <span class="float-right text-muted">{{ Auth::user()->nic }}</span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">@lang('Phone')</span>
                        <span class="float-right text-muted">{{ Auth::user()->mobile ?: 'Not available'}}</span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">@lang('Balance')</span>
                        <span
                            class="float-right text-muted">{{ $general->cur_sym }}{{ formatter_money(Auth::user()->balance) }}</span>
                    </p>


                    @if(auth()->user()->ref_id != 0)
                        <p class="clearfix">
                            <span class="float-left">@lang('Referred By')</span>
                            <span class="float-right text-muted">

                            <span
                                class="badge badge-pill badge-info">{{ \App\User::find(auth()->user()->ref_id)->fullname }}</span>
                    </span>
                        </p>
                    @endif

                    @if(auth()->user()->position_id != 0)
                        <p class="clearfix">
                            <span class="float-left">@lang('Position Under')</span>
                            <span class="float-right text-muted">

                                <span
                                    class="badge badge-pill badge-info">{{ \App\User::find(auth()->user()->position_id)->fullname }}</span>


                    </span>
                        </p>
                    @endif

                    <p class="clearfix">
                        <span class="float-left">@lang('Status')</span>
                        <span class="float-right text-muted">
                        @switch(Auth::user()->status)
                                @case(1)
                                <span class="badge badge-pill badge-success">@lang('Active')</span>
                                @break
                                @case(2)
                                <span class="badge badge-pill badge-danger">@lang('Banned')</span>
                                @break
                            @endswitch
                    </span>
                    </p>

                </div>
            </div>

        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                        <li class="nav-item open">
                            <a href="#0" data-target="#edit" data-toggle="pill" class="nav-link active"><i
                                    class="fa fa-pencil-square-o"></i> <span class="hidden-xs">Edit</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#0" data-target="#messages" data-toggle="pill" class="nav-link"><i
                                    class="fa fa-key"></i> <span class="hidden-xs">Change Password</span></a>
                        </li>

                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="edit">

                            <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('First Name') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="firstname"
                                                       value="{{ auth()->user()->firstname }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Last Name') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="lastname"
                                                       value="{{ auth()->user()->lastname }}" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Email') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="email"
                                                       value="{{ auth()->user()->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Phone') </label>
                                                <input class="form-control" type="text" name="mobile"
                                                       value="{{ auth()->user()->mobile }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>@lang('NIC') </label>
                                                <input class="form-control" type="text" name="nic"
                                                       value="{{ auth()->user()->nic }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>@lang('Avatar') </label>
                                                <input class="form-control" type="file" name="image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label>@lang('Address')</label>
                                        <br>
                                        <small>@lang('Street')</small>
                                        <input class="form-control" type="text"
                                               value="{{ auth()->user()->address->address }}" name="address"
                                               placeholder="Street">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-3">
                                            <small>@lang('City')</small>
                                            <input class="form-control" type="text"
                                                   value="{{ auth()->user()->address->city }}" name="city"
                                                   placeholder="City">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <small>@lang('State')</small>
                                            <input class="form-control" type="text"
                                                   value="{{ auth()->user()->address->state }}" name="state"
                                                   placeholder="State">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <small>@lang('Zip/Postal')</small>
                                            <input class="form-control" type="text"
                                                   value="{{ auth()->user()->address->zip }}" name="zip"
                                                   placeholder="Zip/Postal">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <small>@lang('Country')</small>
                                            <select name="country"
                                                    class="form-control"> @include('partials.country') </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer">
                                    <div class="form-group row">
                                        <div class="col-lg-12 text-center">
                                            <input type="submit" class="btn btn-block btn-primary mt-2"
                                                   value="@lang('Save Changes')">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane" id="messages">

                            <form action="{{route('user.password.update')}}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group row">
                                    <label
                                        class="col-lg-3 col-form-label form-control-label">@lang('Current Password')</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="current" type="password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-3 col-form-label form-control-label">@lang('New Password')</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="password" type="password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-lg-3 col-form-label form-control-label">@lang('Confirm Password')</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="password_confirmation" type="password"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="@lang('Cancel')">
                                        <input type="submit" class="btn btn-primary" value="@lang('Save Changes')">
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


@push('style')
    <style>
        .user-image {
            width: 200px;
            height: 200px;
        }
    </style>

    <script>
        $("select[name=country]").val("{{ Auth::user()->address->country }}");
    </script>

@endpush
