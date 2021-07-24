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
                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount '): <span class="badge badge-primary">{{$deposit->final_amo}} {{$deposit->baseCurrency()}}</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount'):  <span class="badge badge-success"> {{formatter_money($deposit->amount)}}  {{$general->cur_text}}</span></li>

                </ul>
                <div class="card-body text-center">
                    <button  id="btn-confirm" class="btn btn-primary" onClick="payWithRave()">@lang('Confirm Now')</button>
                </div>

            </div>
        </div><!-- card end -->

    </div>
@endsection

@push('js')
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script>
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "{{$data->API_publicKey}}";
        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{$data->customer_email}}",
                amount: "{{$data->amount }}",
                customer_phone: "{{$data->customer_phone}}",
                currency: "{{$data->currency}}",
                txref: "{{$data->txref}}",
                onclose: function() {},
                callback: function(response) {
                    var txref = response.tx.txRef;
                    var status = response.tx.status;
                    var chargeResponse = response.tx.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        window.location = '{{ url('ipn/g109') }}/' + txref +'/'+status;
                    } else {
                        window.location = '{{ url('ipn/g109') }}/' + txref+'/'+status;
                    }
                    // x.close(); // use this to close the modal immediately after payment.
                }
            });
        }
    </script>
@endpush
