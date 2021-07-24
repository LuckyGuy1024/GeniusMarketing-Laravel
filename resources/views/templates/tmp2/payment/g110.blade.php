@extends(activeTemplate() .'layouts.app')



@section('style')

@stop

@section('content')

<style>
    .razorpay-payment-button {

        color: #fff;
        border-color: #5e72e4;
        background-color: #5e72e4;
        box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);
        font-size: .875rem;
        font-weight: 600;
        line-height: 1.5;
        display: inline-block;
        padding: .625rem 1.25rem;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        text-align: center;
        vertical-align: middle;

        border: none !important;
    }
</style>



<div class="row justify-content-center align-items-center">
    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
        <div class="card text-center">
            <img src="{{get_image(config('constants.deposit.gateway.path') .'/'. $deposit->gateway->image) }}" class="card-img-top" alt="image">
            <div class="card-body">
                <h5 class="card-title">@lang('Deposit Via '.$deposit->gateway->name)</h5>
            </div>


        </div>
    </div><!-- card end -->

    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
        <div class="card">

            <div class="card-body">
                <h5 class="card-title">@lang('Final Step')</h5>

            </div>
            @csrf
            <input type="hidden" name="gateway" value=""/>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount '): <span class="badge badge-primary">{{$deposit->final_amo}} {{$deposit->baseCurrency()}}</span></li>
                <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount'):  <span class="badge badge-success"> {{formatter_money($deposit->amount)}}  {{$general->cur_text}}</span></li>

            </ul>
            <div class="card-body text-center">

                <form action="{{$data->url}}" method="{{$data->method}}">
                    <script src="{{$data->checkout_js}}"
                            @foreach($data->val as $key=>$value)
                            data-{{$key}}="{{$value}}"
                            @endforeach >

                    </script>

                    <input type="hidden"  class="btn btn-primary" custom="{{$data->custom}}" name="hidden">

                </form>



            </div>

        </div>
    </div><!-- card end -->

</div>

@endsection

@section('js')

@stop
