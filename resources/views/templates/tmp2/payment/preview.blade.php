@extends(activeTemplate() .'layouts.app')


@push('style')
    <style>
        .badge {
            font-size: unset;
        }
    </style>
@endpush

@section('content')

    <div class="row justify-content-center align-items-center">
        <div class="col-xl-2 col-lg-4 col-md-4">
            <div class="card text-center">
                <img src="{{get_image(config('constants.deposit.gateway.path') .'/'. $data->gateway->image) }}"
                     class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title">@lang('Deposit Via '.$data->gateway->name)</h5>
                </div>


            </div>
        </div><!-- card end -->

        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card">

                <div class="card-body bg-success">
                    <h5 class="card-title">@lang('Preview')</h5>

                </div>
                @csrf
                <input type="hidden" name="gateway" value=""/>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>@lang('Amount') : </strong><span
                                class="badge badge-primary">{{formatter_money($data->amount)}} {{$general->cur_text}}</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>@lang('Charge') : </strong><span
                                class="badge badge-danger">{{formatter_money($data->charge)}} {{$general->cur_text}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>@lang('Payable') :</strong><span
                                class="badge badge-success">{{formatter_money($data->amount + $data->charge)}} {{$general->cur_text}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>@lang('Conversion Rate') : </strong> <span
                                class="badge badge-secondary"> 1 {{$general->cur_text}}
                            = {{$data->rate*1}}  {{$data->baseCurrency()}}</span></li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>@lang('Payable') @lang('In') {{$data->baseCurrency()}} :</strong> <span
                                class="badge badge-info">{{formatter_money($data->final_amo)}} {{$data->baseCurrency()}}</span>
                    </li>

                    @if($data->gateway->crypto==1)
                        <li class="list-group-item  justify-content-start "><strong> @lang('Conversion with')
                                <b> {{ $data->method_currency }} </b> @lang(' and final value will Show on next step')
                            </strong></li>
                    @endif
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('user.deposit.confirm')}}" class="btn btn-primary">@lang('Pay Now')</a>
                </div>

            </div>
        </div>

    </div>




@endsection



