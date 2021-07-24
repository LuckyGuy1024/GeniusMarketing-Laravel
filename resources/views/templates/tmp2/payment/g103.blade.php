@extends(activeTemplate() .'layouts.app')




@section('content')




    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-success  mb-3">
                <div class="card-header bg-success">@lang('Stripe payment')</div>
                <br>
                <br>
                <div class="card-wrapper col-md-12"></div>
                <div class="card-body">


                    <form role="form" id="payment-form" method="{{$data->method}}"
                          action="{{$data->url}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$data->track}}" name="track">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">@lang('CARD NAME')</label>
                                <div class="input-group raw">
                                    <input type="text" class="form-control form-control-lg custom-input"
                                           name="name" placeholder="Card Name" autocomplete="off"
                                           autofocus/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="cardNumber">@lang('CARD NUMBER')</label>
                                <div class="input-group raw">
                                    <input type="tel" class="form-control form-control-lg custom-input"
                                           name="cardNumber" placeholder="Valid Card Number"
                                           autocomplete="off" required autofocus/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="cardExpiry">@lang('EXPIRATION DATE')</label>
                                <input type="tel"
                                       class="form-control form-control-lg input-sz custom-input"
                                       name="cardExpiry" placeholder="MM / YYYY" autocomplete="off"
                                       required/>
                            </div>
                            <div class="col-md-6 ">

                                <label for="cardCVC">@lang('CVC CODE')</label>
                                <input type="tel"
                                       class="form-control form-control-lg input-sz custom-input"
                                       name="cardCVC" placeholder="CVC" autocomplete="off" required/>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary custom-sbtn btn-lg btn-block"
                                type="submit"> @lang('PAY NOW')
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>




@endsection

@push('js')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        (function ($) {
            $(document).ready(function () {
                var card = new Card({
                    form: '#payment-form',
                    container: '.card-wrapper',
                    formSelectors: {
                        numberInput: 'input[name="cardNumber"]',
                        expiryInput: 'input[name="cardExpiry"]',
                        cvcInput: 'input[name="cardCVC"]',
                        nameInput: 'input[name="name"]'
                    }
                });
            });
        })(jQuery);
    </script>
@endpush


