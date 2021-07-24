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
                    <button  id="btn-confirm" class="btn btn-primary">@lang('Confirm Now')</button>

                </div>

            </div>
        </div><!-- card end -->

    </div>

@endsection

@push('js')

    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        closedFunction = function() {

        }
        successFunction = function(transaction_id) {
{{--            var alert =  "{{session()->flash('success','Transaction Successful')}}";--}}
                window.location.href = '{{ route('user.deposit') }}';
        }
        failedFunction=function(transaction_id) {
{{--            var alert =  "{{session()->flash('danger','Transaction Failed')}}";--}}
                window.location.href = '{{ route('user.deposit') }}' ;
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
               v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo:"{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '5af93ca2913fd',
                store_id:"{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed:closedFunction,
                success:successFunction,
                failed:failedFunction
            });
        }

        $(document).ready(function () {
            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        });
    </script>

@endpush
