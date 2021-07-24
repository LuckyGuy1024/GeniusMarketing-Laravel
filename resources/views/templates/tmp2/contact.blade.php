@extends(activeTemplate() .'layouts.master')

@section('content')
    @include(activeTemplate() .'layouts.breadcrumb')



    <section class="contact-section padding-bottom padding-top">
        <div class="container">
            <div class="contact-wrapper padding-bottom padding-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info bg_img" >
                            <h4 class="title">@lang('Contact Info')</h4>
                            <div class="item-info">
                                <div class="icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title">@lang('address')</h6>
                                    <ul>
                                        <li>{{$general->contact_address}}</li>

                                    </ul>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="icon">
                                    <i class="flaticon-mail"></i>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title">@lang('email address')</h6>
                                    <ul>

                                        <li>
                                            <a href="{{$general->contact_email}}">{{$general->contact_email}}</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="icon">
                                    <i class="flaticon-telephone"></i>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title">@lang('phone number')</h6>
                                    <ul>
                                        <li>
                                            <a href="Tel:{{$general->contact_phone}}">{{$general->contact_phone}}</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-area">
                            <h2 class="title">@lang('Get In Touch')</h2>

                                <form class="contact-form-dynamic" action="{{route('send.mail.contact')}}" method="post">
                                    @csrf


                                <div class="form-group">
                                    <input type="text" placeholder="@lang('Your Name')" value="{{old('name')}}" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="@lang('Your Email')" value="{{old('email')}}" name="email" id="email" required>
                                </div>



                                <div class="form-group">
                                    <textarea placeholder="@lang('Type Message')" name="message"  id="message" required>{{old('message')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="@lang('send message')">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





@stop