@extends(activeTemplate() .'layouts.app')

@section('content')
    <div id="app">


        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-normal">@lang('Balance Transfer')</h4>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="alert alert-danger" role="alert">
                            <strong>@lang('Balance Transfer Charge') {{__($general->bal_trans_fixed_charge)}} {{__($general->cur_text)}} @lang('Fixed and')  {{__($general->bal_trans_per_charge)}}
                                % @lang('of your total amount to transfer balance.')</strong>
                            <p style="color: red" v-if="newdata.amount !== ''">@{{parseInt(newdata.amount) +
                                amount}} {{__($general->cur_text)}} @lang('will be subtracted from your') @lang('@{{wallet_name}}') </p>
                        </div>
                    </div>
                    <form class="contact-form" id="balanceTransfer" method="POST"
                          action="{{route('user.balance.transfer.post')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label>@lang('Username / Email To Send Amount') <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" id="InputMailUser" @keyup="submitSearch"
                                           v-model="newdata.username" name="username" placeholder="@lang('Username/Email')"
                                           required autocomplete="off">

                                </div>

                                 <div class="form-group col-md-12">

                                     <label for="InputMail">@lang('Transfer Amount from') <span
                                                 v-if="wallet_name"> @lang('@{{wallet_name}}') </span> <span class="requred">*</span></label>
                                     <input type="text" class="form-control" id="InputMail" v-model="newdata.amount"
                                            name="amount" placeholder="@lang('Amount') {{__($general->cur_text)}}" required>
                                     <small v-if="parseInt(balance) < parseInt(newdata.amount)"
                                            style="color: red">@lang('Insufficient Balance!')</small>

                                    </div>

                            </div>
                        </div>


                        <div class="card-footer " id="bal" v-if="parseInt(balance) >= parseInt(newdata.amount) + amount && hasmsg.success == true">
                            <div class="form-group col-md-12 text-center">
                                @if(Auth::user()->tauth == 1)
                                    <button type="button" style="width: 100%;" data-toggle="modal"
                                            data-target="#openmodal"
                                            class="btn btn-block btn-primary mr-2"> @lang('Transfer Balance')</button>
                                @else
                                    <button type="submit" style="width: 100%;"
                                            class=" btn btn-block btn-primary mr-2"> @lang('Transfer Balance')</button>
                                @endif
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('js')

    <script src="{{asset(activeTemplate(true) .'users/vue/axios.js')}}"></script>
    <script src="{{asset(activeTemplate(true) .'users/vue/vue.js')}}"></script>
    <script src="{{asset(activeTemplate(true) .'users/vue/vue-handle-error.js')}}"></script>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                showData: {},
                newdata: {
                    amount: '',
                    wallet_type: '',
                    username: '',
                },
                codeData: {
                    code: ''
                },
                balance: '{{Auth::user()->balance}}',
                hasmsg: '',
                wallet_name: 'Balance',
                errors: ''
            },
            computed: {
                amount() {
                    return {{intval($general->bal_trans_fixed_charge)}}+(parseInt(this.newdata.amount) * parseInt({{ intval($general->bal_trans_per_charge) }})) / 100
                }
            },
            methods: {
                submitSearch() {
                    var input = this.newdata;
                    axios.post('{{route('user.search.user')}}', input).then(function (e) {
                        app.hasmsg = e.data;
                        if (e.data.success == true) {
                            $('#InputMailUser').css('box-shadow', '1px 1px 0px #039f08, 0 0 4px #039f08, 0 0 4px #039f08');
                            $('#bal').css('display', 'block');
                        } else {
                            $('#InputMailUser').css('box-shadow', '1px 1px 0px #de0015, 0 0 4px #de0015, 0 0 4px #de0015');
                            $('#bal').css('display', 'none');
                        }
                    });
                },
                submitCode() {
                    var input = this.codeData;
                    axios.post('', input).then(function (e) {

                        if (e.data.success == true) {
                            $("#balanceTransfer").submit();
                        } else {
                            iziToast.error({
                                title: '{{__('Opps!')}}',
                                message: e.data.message,
                                position: 'topRight',
                            });
                        }

                    }).catch(function (error) {
                        app.errors = error.response.data.errors.code;
                    })
                }
            }
        });
    </script>

@endpush
