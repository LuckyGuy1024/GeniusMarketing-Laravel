@extends(activeTemplate() .'layouts.app')



@section('style')

@stop

@section('content')
    <div class="row">
        @foreach($methods as $data)
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="card text-center">
                    <img src="{{ get_image(config('constants.withdraw.method.path') .'/'. $data->image) }}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">@lang('Withdraw Via') {{__($data->name)}}</h5>
                        <hr>

                        <a href="#" data-toggle="modal"   data-id="{{$data->id}}"
                           data-pcharge="{{ $data->percent_charge }}%"
                           data-fcharge="{{$general->cur_text}} {{formatter_money($data->fixed_charge)}}"
                           data-currency="{{$data->currency}}"
                           data-min_limit="{{formatter_money($data->min_limit , config('constants.currency.'. $data->currency ))}}"
                           data-max_limit="{{formatter_money($data->max_limit , config('constants.currency.'. $data->currency))}} {{$general->cur_text}}"

                           class="btn btn-primary withdraw"
                        >@lang('Withdraw Now')</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content blue-bg ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">@lang('Choose amount')</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('user.withdraw.insert')}}" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" name="id"  value="">
                        <div class="form-group">
                            {{--<p class="charge text-danger"></p>--}}
                        </div>
                        <strong style="color: black;">@lang('Limit')
                            :<span class="min_limit"></span>  -
                            <span class="max_limit"></span> </strong>

                        <div class="form-group text-left">
                            <label>@lang('Amount')</label>
                            <div class="input-group mb-2">

                                <input type="text" class="form-control" name="amount" value="{{old('amount')}}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{{$general->cur_text}}</div>
                                </div>
                            </div>
                        </div>



                        <strong style="color: black;">@lang('Charge')
                            :<span class="fcharge"></span>  -
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





        $('.withdraw').on('click', function () {
            var modal = $('#exampleModal');
            var id = $(this).data('id');
            var currency = $(this).data('currency');
            var fcharge = parseFloat($(this).data('fcharge'));
            var pcharge = parseFloat($(this).data('pcharge'));
            modal.find('.fcharge').text($(this).data('fcharge'));
            modal.find('.pcharge').text($(this).data('pcharge'));
            modal.find('.min_limit').text($(this).data('min_limit'));
            modal.find('.max_limit').text($(this).data('max_limit'));
            modal.modal('show');
            modal.find('input[name=id]').val(id);
            modal.find('input[name=amount]').on('input', function() {
                var amount = parseFloat($(this).val());
                var charge = fcharge;
                if(pcharge != 0) {
                    charge += parseFloat(pcharge * amount / 100);
                }
                $('.charge').text('Charge: '+ charge +' '+ currency);
            });
            modal.modal('show');
        });
    </script>

@endpush
