@extends(activeTemplate() .'layouts.app')




@section('content')



    <div class="row justify-content-center align-items-center">
        <div class=" col-md-3 col-sm-6">
            <div class="card text-center">
                <img src="{{get_image(config('constants.deposit.gateway.path') .'/'. $data->gateway->image) }}" class="card-img-top" alt="image">
                <hr/>
                <div class="card-body">
                    <h5 class="card-title">@lang('Deposit Via '. $data->gateway->name)</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <form action="{{ route('user.manualDeposit.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">@lang('Preview')</h5>
                    </div>


                    <input type="hidden" name="gateway" value="{{ $data->gateway->id}}"/>
                    <input type="hidden" name="amount" value="{{ $data['amount']}}"/>


                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">@lang('You have requested ') <b>{{ $general->cur_sym . formatter_money($data['amount']) }}</b> @lang(', Please pay ') <b>{{ $general->cur_sym . formatter_money($data['final_amo']) }}</b> @lang(' for successful payment')</li>
                         <li class="list-group-item text-center"><h4>@lang('Please follow the instruction bellow')</h4></li>
                         <li class="list-group-item">@php echo $data->gateway->description; @endphp</li>
                       <li class="list-group-item text-center">{{ __($data->gateway->extra->verify_image) }}
                         <input type="file" class="form-control" name="verify_image" required></li>
                        @foreach(json_decode($data->gateway_currency()->parameter) as $input)
                            <li class="list-group-item text-center">
                                <input type="text" class="form-control" name="ud[{{ \Str::slug($input) }}]" placeholder="{{ $input }}" required>
                            </li>
                        @endforeach


                    </ul>
                    <div class="card-body text-center">
                        <button   class="btn btn-primary d-block w-100">@lang('Submit')</button>
                    </div>

                </div>
            </form>
        </div>

    </div>




@endsection

@push('css')
<style>
.list-group-item {
    background-color: transparent;
}
</style>
@endpush

