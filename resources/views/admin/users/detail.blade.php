@extends('admin.layouts.app')

@section('panel')

@php 

$nic="";
$remarks="";
$e_pin="";
$image="";
$nic_image="";
if($kyc){
$nic=$kyc->nic;
$remarks=$kyc->remarks;
$e_pin=$kyc->e_pin;
$image=$kyc->image;
$nic_image=$kyc->nic_image;

}
@endphp
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body text-center border-bottom">
                <img src="{{ get_image(config('constants.user.profile.path') .'/'. $user->image) }}" alt="profile-image" class="user-image">
                <h5 class="card-title mt-3">{{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <p class="clearfix">
                    <span class="float-left">Username</span>
                    <span class="float-right font-weight-bold"><a href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a></span>
                </p>
                <p class="clearfix">
                    <span class="float-left">E-mail</span>
                    <span class="float-right text-muted">{{ $user->email }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-left">Phone</span>
                    <span class="float-right text-muted">{{ $user->mobile ?: 'Not available'}}</span>
                </p>

                <p class="clearfix">
                    <span class="float-left">Balance</span>
                    <span class="float-right text-muted">{{ $general->cur_sym }}{{ formatter_money($user->balance) }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-left">Refer By</span>
                    <span class="float-right text-muted">{{isset($refer->username) ? $refer->username : "None"}}</span>
                </p>
                <p class="clearfix">
                    <span class="float-left">Subscribe Plans</span>
                    <span class="float-right text-muted">{!! isset($planText) ? $planText : "<b>None</b>" !!}</span>
                </p>
                <p class="clearfix">
                    <span class="float-left">Joined</span>
                    <span class="float-right text-muted">{{show_datetime($user->created_at)}}</span>
                </p>

                <p class="clearfix">
                    <span class="float-left">Status</span>
                    <span class="float-right text-muted">
                        @switch($user->status)
                            @case(1)
                                <span class="badge badge-pill badge-success">Active</span>
                                @break
                            @case(2)
                                <span class="badge badge-pill badge-danger">Banned</span>
                                @break                                                        
                        @endswitch
                    </span>
                </p>
<br>
                <!-- kyc  -->
                 <p class="clearfix">
                   <center> <span class="float-left"><b>KYC Info</b></span></center>
                   <!-- <br> -->
                </p>
<br>
                 <p class="clearfix">
                    <span class="float-left">CNIC</span>
                    <span class="float-right text-muted">{{ $nic }}</span>
                </p>


                <p class="clearfix">
                    <span class="float-left">Occupation</span>
                    @php
$occupation="";

if($kyc){

if($kyc->occupation=="private_job"){
$occupation="Private Job";
}

else if($kyc->occupation=="gov_job"){
$occupation="Gov Job";
}
else if($kyc->occupation=="doctors"){
$occupation="Doctors";
}
else if($kyc->occupation=="businessman"){
$occupation="Businessman";
}

}
                    @endphp
                    <span class="float-right text-muted">{{$occupation}}</span>
                </p>
                



                <p class="clearfix">
                    <span class="float-left">Remarks</span>
                    <br>
                    <span class="float-right text-muted">{{ $remarks }}</span>
                </p>


                <p class="clearfix">
                    <span class="float-left">E-Pin</span>
                    <br>
                    <span class="float-right text-muted">{{ $e_pin }}</span>
                </p>


                  <p class="clearfix">
                    <span class="float-left">Image</span>
                    <span class="float-right text-muted"><a href="../../../storage{{  $image }}" target="_blank" >@lang('View Image')</a></span>
                </p>

                  <p class="clearfix">
                    <span class="float-left">CNIC Image</span>
                    <span class="float-right text-muted"><a href="../../../storage{{  $nic_image }}" target="_blank" >@lang('View Image')</a></span>
                </p>

                

            </div>

           
           
        </div>

    </div>
    <div class="col-lg-9">       
        <div class="card">

            <div class="row p-4">
                <div class="col-lg-4">
                    <div class="card outline-success">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-success">{{ $general->cur_text}} {{ formatter_money($withdrawals->total) }}</h4>
                                <span class="text-success">Total Withdrawals</span>
                            </div>
                            <div class="align-self-center icon-lg">
                                <i class="fa fa-money text-success"></i>
                            </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.withdrawals', $user->id) }}" class="text-white text-center">
                            <div class="card-footer btn btn-block btn-success">View All</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card outline-dark">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-dark">{{ $general->cur_text}} {{ formatter_money($deposits->total) }}</h4>
                                <span class="text-dark">Total Deposits</span>
                            </div>
                            <div class="align-self-center icon-lg">
                                <i class="fa fa-money text-dark"></i>
                            </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.deposits', $user->id) }}" class="text-white text-center">
                            <div class="card-footer btn btn-block btn-dark">View All</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card outline-primary">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-primary">{{ $transactions }}</h4>
                                <span class="text-primary">Total Transactions</span>
                            </div>
                            <div class="align-self-center icon-lg">
                                <i class="fa fa-exchange text-primary"></i>
                            </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.transactions', $user->id) }}" class="text-white text-center">
                            <div class="card-footer btn-block btn btn-primary">View All</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a class="text-white text-center btn-block" data-toggle="modal" href="#addSubModal">
                        <div class="card outline-primary">
                            <div class="card-body bg-primary">Add/Subtract Balance</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('admin.users.login.history.single', $user->id) }}" class="text-white text-center btn-block">
                        <div class="card outline-success bg-success">
                            <div class="card-body">Login Logs</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('admin.users.email.single', $user->id) }}" class="text-white text-center btn-block">
                        <div class="card outline-orange bg-orange">
                            <div class="card-body">Send Email</div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="{{ route('admin.users.ref.single', $user->id) }}" class="text-white text-center btn-block">
                        <div class="card outline-info bg-info">
                            <div class="card-body">Referrals</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{route('admin.users.matrix.single',['lv_no' => 1, $user->id])}}" class="text-white text-center btn-block">
                        <div class="card outline-primary bg-primary">
                            <div class="card-body">Matrix Level</div>
                        </div>
                    </a>
                </div>
            </div>
           
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="firstname" value="{{ $user->firstname }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lastname" value="{{ $user->lastname }}" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input class="form-control" type="text" name="mobile" value="{{ $user->mobile }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">

                        <label>Address</label>
                        <br>
                        <small>Street</small>
                        <input class="form-control" type="text" value="{{ $user->address->address }}" name="address" placeholder="Street">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <small>City</small>
                            <input class="form-control" type="text" value="{{ $user->address->city }}" name="city" placeholder="City">
                        </div>
                        <div class="form-group col-lg-3">
                            <small>State</small>
                            <input class="form-control" type="text" value="{{ $user->address->state }}" name="state" placeholder="State">
                        </div>
                        <div class="form-group col-lg-3">
                            <small>Zip/Postal</small>
                            <input class="form-control" type="text" value="{{ $user->address->zip }}" name="zip" placeholder="Zip/Postal">
                        </div>
                        <div class="form-group col-lg-3">
                            <small>Country</small>
                            <select name="country" class="form-control"> @include('partials.country') </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <p class="text-muted">Status</p>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-onstyle="success"    data-offstyle="danger" data-on="Active" data-off="Banned"  data-width="100%" name="status" @if($user->status) checked @endif>
                        </div>
                        
                        <div class="form-group col-lg-4">
                            <p class="text-muted">Email Verification</p>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="ev" @if($user->ev) checked @endif>
                        </div>

                        <div class="form-group col-lg-4">
                            <p class="text-muted">SMS Verification</p>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="sv" @if($user->sv) checked @endif>
                        </div>

                        <div class="form-group col-lg-6">
                            <p class="text-muted">2FA Status</p>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" name="ts" @if($user->ts) checked @endif>
                        </div>

                        <div class="form-group col-lg-6">
                            <p class="text-muted">2FA Verification</p>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="tv" @if($user->tv) checked @endif>
                        </div>


@php 

$addActiveTab="";
$editActiveTab="";
$addActiveDisplay="";
$editActiveDisplay="";

$pending="";
$accepted="";
$rejected="";
$doctors="";

if($kyc){
if($kyc->user_id!=null || $kyc->user_id!=""){
$editActiveTab="active";
$addActiveDisplay="none";
}else{
    $addActiveTab="active";
    $editActiveDisplay="none";
}


if($kyc->status=="0"){
$pending="checked='checked'";
}
else if($kyc->status=="1"){
$accepted="checked='checked'";
}
else if($kyc->rejected=="2"){
$rejected="checked='checked'";
}

}
@endphp

 <div class="col-md-12">
                                              <label>@lang('Status') <span class="text-danger">*</span></label>
                                            <div class="form-check" style="margin-top: 10px !important">
                                              
                                           
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{$pending}}>
  <label class="form-check-label" for="inlineRadio1">Pending</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" {{$accepted}} value="1">
  <label class="form-check-label" for="inlineRadio2">Accepted</label>
</div>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="status" id="inlineRadio3" {{$rejected}} value="2" >
  <label class="form-check-label" for="inlineRadio3">Rejected</label>
</div>



                                            </div>
                                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-lg-12 text-center">
                            <input type="submit" class="btn btn-block btn-primary mt-2" value="Save Changes">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Sub Balance MODAL --}}
<div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add / Subtract Balance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.addSubBalance', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Add Balance" data-off="Subtract Balance" name="act" checked>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Amount<span class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <input type="text" name="amount" class="form-control" placeholder="Please provide positive amount">
                                <div class="input-group-append"><div class="input-group-text">{{ $general->cur_sym }}</div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Send Email MODAL --}}
<div id="sendEmailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.email.single', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Subject<span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control" placeholder="Email Subject">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Message<span class="text-danger">*</span></label>
                            <textarea rows="5" name="message" class="form-control nicEdit" placeholder="Your Message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
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
@endpush

@push('script')
<script>
$("select[name=country]").val("{{ $user->address->country }}");
</script>
@endpush