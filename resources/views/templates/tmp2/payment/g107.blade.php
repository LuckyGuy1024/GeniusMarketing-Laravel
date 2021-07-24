@extends(activeTemplate() .'layouts.app')



@section('style')

@stop


@section('content')







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
                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Pay amount ') {{$data->currency}} : <span class="badge badge-primary">{{$deposit->final_amo}} {{$deposit->baseCurrency()}}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount'):  <span class="badge badge-success"> {{formatter_money($deposit->amount)}}  {{$general->cur_text}}</span></li>

                </ul>
                <div class="card-body text-center">
                    <button  id="btn-confirm" class="btn btn-primary">@lang('Confirm Now')</button>

                    <form action="{{ route('ipn.g107') }}" method="POST">
                        @csrf
                        <script
                                src="//js.paystack.co/v1/inline.js"
                                data-key="{{ $data->key }}"
                                data-email="{{ $data->email }}"
                                data-amount="{{$data->amount}}"
                                data-currency="{{$data->currency}}"
                                data-ref="{{ $data->ref }}"
                                data-custom-button="btn-confirm"
                        >
                        </script>
                    </form>
                </div>

            </div>
        </div><!-- card end -->

    </div>





@endsection

@push('css')
    <style>
        .list-group-item {
            background-color: transparent;
        }
    </style>
@endpush






