@extends(activeTemplate() .'layouts.app')

@push('style')
    <style>
        #code {
            font-size: 40px;
            font-weight: 900;
            text-align: center;
            height: 100% !important;
            width: 100% !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('user.pin.recharge.post') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <input class="form-control input-lg" id="code" value=""  pat tern=".{35,35}" name="pin" maxlength="35" autocomplete="off" type="tel" Placeholder='@lang('ENTER PIN')' required />
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary mr-2">@lang('RECHARGE NOW')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>









    <div class="row">

        <div class="col-lg-12">
            <h3 style="padding-left:20px" class="card-header">
                @lang('My created E-Pin')
                <a href="#createEpinModal" data-toggle="modal" class="btn btn-success  float-right">@lang('Create New E-Pin')</a>
            </h3>


<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="{{route('user.pin.recharge.date')}}" style="width:100% !important;">
     @csrf
                         <div class="form-group">
                            <div class="row">
                          <div class="col-md-6"></div>
                          
                    <div class="col-md-4" >
                               
                                    <strong style="color:white;">Select Date:</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg plan-price'"  id="current_date" name="current_date" required="required" class="form-control" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Date</span>
                                        </div>
                                    </div>

                                </div>
                           
<div class=" col-md-2" style="margin-top:15px !important;" >


<input type="submit" value="View Report" class="btn btn-block btn-primary mt-2">
    </div>
    </div>
    </div>

</form>
    </div>

<!-- report ends here -->



            
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Pin')</th>
                            <th scope="col">@lang('Status')</th>
                        </tr>
                        </thead>
                        @php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            @endphp
                    

            

                        <tbody class="list">
                        @forelse($epin as $data)

                                    @php
$totalAmount=$totalAmount+formatter_money($data->amount);

                        @endphp
                            <tr>
                                <td>{{$general->cur_sym}}{{ $data->amount }}</td>
                                <td>{{ $data->pin }}</td>
                                <td>@if($data->status == 1) <span class="badge badge-success">@lang('Not Used')</span> @else <span class="badge badge-warning">@lang('Used')</span> @endif</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__('NO DATA FOUND')}}</td>
                            </tr>
                        @endforelse
                        </tbody>

                             <tfoot><thead >
                            
                            <th colspan="6">
                                <center>

                                @php
echo "<h7>"." Total Amount  <b>: ".$totalAmount."  </b>"."</h7>"."<br>";
                                @endphp
</center>
                            </th>
                        </thead></tfoot>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{$epin->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createEpinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> @lang('Create New Pin')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form  method="post" action="{{route('user.pin.generate')}}">
                    @csrf
                    <div class="modal-body text-center">

                        <strong class="text-center">@lang('Amount')</strong>
                        <div class="input-group">
                            <input type="text" class="form-control input-lg" name="amount">
                            <div class="input-group-append">
                            <span class="input-group-text">
                                {{__($general->cur_sym)}}
                            </span>
                            </div>

                        </div>
                        <small class="text-center text-danger">@lang('This amount will subtract from your wallet and generate new pin.')</small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary bold uppercase"><i class="fa fa-send"></i> @lang('Generate')</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> @lang('Close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $('#code').on('keypress change', function () {
            var xx = document.getElementById('code').value;
            // if (xx.length < 32) {
            if (xx.length < 10) {
                $(this).val(function (index, value) {
                    return value.replace(/\W/gi, '').replace(/(.{8})/g, '$1-');
                });
            }
        });
    </script>
@endpush
