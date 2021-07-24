@extends(activeTemplate() .'layouts.app')
@section('style')

@stop
@section('content')

    <div class="row">


@php 

$addActiveTab="";
$editActiveTab="";
$addActiveDisplay="";
$editActiveDisplay="";
$nic="";

$businessman="";
$gov_job="";
$private_job="";
$doctors="";
$image="";
$nic_image="";
$remarks="";
$e_pin="";
$editActiveTab="active";
$addActiveDisplay="none";
if($kyc!=null || $kyc!=""){

if($kyc->user_id!=null || $kyc->user_id!=""){
    $remarks=$kyc->remarks;
$e_pin=$kyc->e_pin;
    $image=$kyc->image;
$nic_image=$kyc->nic_image;
    $nic=$kyc->nic;
$editActiveTab="active";
$addActiveDisplay="none";
}else{
    $addActiveTab="active";
    $editActiveDisplay="none";
}


if($kyc->occupation=="businessman"){
$businessman="checked='checked'";
}
else if($kyc->occupation=="gov_job"){
$gov_job="checked='checked'";
}
else if($kyc->occupation=="private_job"){
$private_job="checked='checked'";
}
else if($kyc->occupation=="doctors"){
$doctors="checked='checked'";
}

}
@endphp



        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                        <li class="nav-item open" style="display: {{  $addActiveDisplay }};">
                            <a href="#0" data-target="#edit" data-toggle="pill" class="nav-link {{ $addActiveTab }}"><i
                                    class="fa fa-plus"></i> <span class="hidden-xs">Add KYC</span></a>
                        </li>
                        <li class="nav-item"  style="display: {{  $editActiveDisplay }};">
                            <a href="#0" data-target="#messages" data-toggle="pill" class="nav-link    {{ $editActiveTab }}"><i
                                    class="fa fa-pencil-square-o"></i> <span class="hidden-xs">Edit KYC</span></a>
                        </li>

                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane {{ $addActiveTab }}" id="edit">

                            <form action="{{route('user.kyc.add')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('CNIC Number') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="nic"
                                                       value="{{ auth()->user()->nic }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                              <label>@lang('Occupation') <span class="text-danger">*</span></label>
                                            <div class="form-check" style="margin-top: 10px !important">
                                              
                                           
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio1" value="businessman" checked="checked">
  <label class="form-check-label" for="inlineRadio1">Businessman</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio2" value="gov_job">
  <label class="form-check-label" for="inlineRadio2">Gov Job</label>
</div>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio3" value="private_job" >
  <label class="form-check-label" for="inlineRadio3">Private Job</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio4" value="doctors" >
  <label class="form-check-label" for="inlineRadio4">Doctors</label>
</div>


                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Image') <span class="text-danger">*</span></label>
                                                <input type="file" required="required" name="picture" class="form-control"
                                                       >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('CNIC Picture') <span class="text-danger">*</span></label>
                                    <input type="file"  required="required"  name="nic_image" class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Remarks') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="remarks"
                                                    >
                                            </div>
                                        </div>


  <div class="col-md-6">
                                          <div class="form-group">                                        <label>@lang('E-Pin') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"
                                                name="e_pin"
                                               placeholder="Street">
                                    </div>
                                    </div>
      

        <div class="col-md-12">
        <div class="form-group">      
  <label class="form-check-label" for="flexSwitchCheckChecked">@lang('Terms And Conditions')</label>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required="required" checked>
  <label class="form-check-label" for="flexSwitchCheckChecked">@lang('I Agree with the terms and conditions')</label>
</div>
</div>
</div>

                                       
                                    </div>

                                  

                                  


                                </div>
                                <div class="card-footer">
                                    <div class="form-group row">
                                        <div class="col-lg-12 text-center">
                                            <input type="submit" class="btn btn-block btn-primary mt-2"
                                                   value="@lang('Save')">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane {{ $editActiveTab }}" id="messages">

                            <form action="{{route('user.kyc.update')}}"  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                


<div class="card-body">
    <div class="col-md-12">
                                            <div class="form-group">
 @if($kyc!=null || $kyc!="")                                            <center> 
@if($kyc->status==0)
                                               <label style="color:gray;">Your KYC Status is Pending For Approval </label>
@elseif($kyc->status==1)
                                               <label style="color:green;">Your KYC Status is Approved </label>
@elseif($kyc->status==2)

                                               <label style="color:red;">Your KYC Status is Rejected </label>
@endif
@endif
                                           </center>
                                           
                                            </div>
                                        </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('CNIC Number') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="nic"
                                                       value="{{ $nic }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                              <label>@lang('Occupation') <span class="text-danger">*</span></label>
                                            <div class="form-check" style="margin-top: 10px !important">
                                              
                                           
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="occupation" id="inlineRadio1" value="businessman" {{$businessman}} required="required">
  <label class="form-check-label" for="inlineRadio1">Businessman</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio2" {{$gov_job}} value="gov_job" required="required">
  <label class="form-check-label" for="inlineRadio2">Gov Job</label>
</div>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio3" {{$private_job}} value="private_job" required="required">
  <label class="form-check-label" for="inlineRadio3">Private Job</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="occupation" id="inlineRadio4" {{$doctors}} value="doctors" required="required">
  <label class="form-check-label" for="inlineRadio4">Doctors</label>
</div>


                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Image') <span class="text-danger">*</span>  


<a href="../storage{{  $image }}" target="_blank" >@lang('View Image')</a>

                                                </label>
                                                <input type="file"   name="picture" class="form-control"
                                                       >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('CNIC Picture') <span class="text-danger">*</span>

<a href="../storage{{  $nic_image }}" target="_blank" >@lang('View Image')</a>
                                                </label>
                                    <input type="file"    name="nic_image" class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Remarks') <span class="text-danger">*</span></label>
                                                <input class="form-control"   value="{{ $remarks }}" type="text" name="remarks"
                                                    >
                                            </div>
                                        </div>


  <div class="col-md-6">
                                          <div class="form-group">                                        <label>@lang('E-Pin') <span class="text-danger">*</span></label>
                                        <input class="form-control"   value="{{ $e_pin }}" type="text"
                                                name="e_pin"
                                               placeholder="Street">
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
