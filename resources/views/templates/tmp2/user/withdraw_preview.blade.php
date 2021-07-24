@extends(activeTemplate() .'layouts.app')
@push('style')

    <style>
        .badge {
            font-size: unset;
        }

        .list-group-item {
            background-color: transparent;
        }
    </style>

@endpush

@section('content')

    <div class="row justify-content-center align-items-center">
        <div class="col-md-3">
            <div class="card text-center">
                <img src="{{get_image(config('constants.withdraw.method.path') .'/'. $data->method->image) }}"
                     class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title">{{__($data->method->name)}}</h5>
                </div>


            </div>
        </div><!-- card end -->

        <div class="col-xl-6 col-lg-6 col-md-6">
            <form method="POST" action="{{route('user.withdraw')}}" enctype="multipart/form-data">
                @csrf
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">@lang('Preview')</h5>

                    </div>
                    @csrf
                    <input type="hidden" name="gateway" value=""/>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Amount') :
                            <span
                                class="badge badge-primary">{{formatter_money($data['amount'])}} {{$general->cur_text}}</span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Charge') :
                            <span
                                class="badge badge-danger">{{formatter_money($data['charge'])}} {{$general->cur_text}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('You will receive')
                            :
                            <span
                                class="badge badge-info"> {{formatter_money($data['amount'] - $data['charge'])}} {{$general->cur_text}} </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Conversion Rate')
                            : <span class="badge badge-secondary"> 1 {{$general->cur_text}}
                                = {{round($data->rate, 8)}} {{$data->currency}} </span></li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('In '. $data->currency)
                            :
                            <span class="badge badge-success">{{formatter_money($data['final_amo'])}} </span></li>



                        @if($data->method->user_data)
                            <li class="list-group-item ">@lang('Please Provide your information')</li>
                            @foreach($data->method->user_data as $input)


                                <li class="list-group-item text-center">
                                    <input type="text" class="form-control" name="ud[{{ \Str::slug($input) }}]"
                                           placeholder="{{ $input }}" required>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="card-body text-center">
                        <button class="btn btn-primary">@lang('Confirm Withdraw')</button>
                    </div>

                </div>
            </form>
        </div><!-- card end -->

    </div>

@endsection

