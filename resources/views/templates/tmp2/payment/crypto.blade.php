@extends(activeTemplate() .'layouts.app')



@section('style')

@stop

@section('content')

    <div class="row page-bar-btn">
        <div class="col-md-12">

            <div class="card panel-primary">
                <div class="card-header">
                    <h3 class="panel-title text-center">@lang('Payment Confirm')</h3>
                </div>

                <div class="card-body text-center">

                    <div  class="col-md-12 text-center">
                        <h3 class="text-color"> @lang('PLEASE SEND') <br> <span style="color:red"> @lang('EXACTLY') <span style="color: green"> {{ $data->amount }}</span> {{$data->currency}}</span></h3><br>
                        <h4 class="text-color">@lang('TO') <b style="color: green"> {{ $data->sendto }}</b></h4>
                        <img src="{{$data->img}}" alt="">
                        <h3 class="text-color" style="font-weight:bold;">@lang('SCAN TO SEND')</h3>

                        <br><hr><br>
                        <h3 style="font-weight:bold; color:red;">@lang('You Have to Send Exact Amount of  ') {{$data->currency}}.</h3>
                        <h5 class="text-color" style="font-weight:bold;">@lang('Your Account will be credited automatically after 3 network confirmations. ')</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

