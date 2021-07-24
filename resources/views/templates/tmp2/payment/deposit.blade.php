@extends(activeTemplate() .'layouts.app')



@section('style')

@stop

@section('content')



    <div class="row">
        @foreach($gatewayCurrency as $data)
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <img src="{{ $data->methodImage() }}" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title">{{__($data->name)}}</h5>
                   <hr>

                    <a href="#" data-toggle="modal" data-currency="{{$data->currency}}"
                       data-min_amount="{{formatter_money($data->min_amount)}} "
                       data-max_amount=" {{formatter_money($data->max_amount)}} "
                       data-fcharge=" {{formatter_money($data->fixed_charge)}}"
                       data-pcharge="{{formatter_money($data->percent_charge)}} %"
                       data-method_code="{{$data->method_code}}"
                       class="btn btn-primary  deposit"
                       >@lang('Deposit Now')</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>






    <!-- Modal -->
    <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content blue-bg ">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel" style="color: black">@lang('Choose amount')</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.deposit.insert') }}" method="POST">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" name="currency" class="edit-currency" value="">
                        <input type="hidden" name="method_code" class="edit-method-code" value="">




                        <strong style="color: black">@lang('Limit')
                            :<span class="min_amount"></span>  -
                            <span class="max_amount"></span> {{$general->cur_text}} </strong>

                        <div class="form-group text-left">
                            <label >@lang('Amount')</label>


                            <div class="input-group mb-2">

                                <input type="text" class="form-control" name="amount" value="{{old('amount')}}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{{$general->cur_text}}</div>
                                </div>
                            </div>

                        </div>

                        <strong style="color: black;"> @lang('Charge')  :{{$general->cur_text}} <span class="fcharge"></span>  -
                            <span class="pcharge"></span> </strong>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@push('js')
    <script>

        $('.deposit').on('click', function () {
            var modal = $('#depositModal');
            $('.edit-currency').val($(this).data('currency'));
            $('.currency').text($(this).data('currency'));
            $('.edit-method-code').val($(this).data('method_code'));
            modal.find('.fcharge').text($(this).data('fcharge'));
            modal.find('.pcharge').text($(this).data('pcharge'));
            modal.find('.min_amount').text($(this).data('min_amount'));
            modal.find('.max_amount').text($(this).data('max_amount'));
            modal.modal('show');
        });

    </script>

@endpush
