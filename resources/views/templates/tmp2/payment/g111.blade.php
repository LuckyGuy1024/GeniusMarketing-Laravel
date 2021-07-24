
@extends(activeTemplate() .'layouts.app')

@section('style')

    <script src="https://js.stripe.com/v3/"></script>
@stop


@section('content')

    <style>
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>

    <!--breadcrumb area-->


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
                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount ') : <span class="badge badge-primary">{{$deposit->final_amo}} {{$deposit->baseCurrency()}}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount'):  <span class="badge badge-success"> {{formatter_money($deposit->amount)}}  {{$general->cur_text}}</span></li>

                </ul>
                <div class="card-body text-center">
                    <form action="{{$data->url}}" method="{{$data->method}}">
                        <script
                                src="{{$data->src}}"
                                class="stripe-button"
                                @foreach($data->val as $key=> $value)
                                data-{{$key}}="{{$value}}"
                                @endforeach
                        >
                        </script>
                    </form>
                </div>

            </div>
        </div>

    </div>

@endsection

@section('js')

@stop


