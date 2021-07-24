@extends(activeTemplate() .'layouts.master')

@section('content')
    @include(activeTemplate() .'layouts.breadcrumb')
    <section class="faq-section padding-bottom padding-top">
        <div class="container">
            <div class="faq-wrapper-two">
                @foreach($faqs as $data)
                <div class="faq-item-two">
                    <div class="icon">
                        <i class="flaticon-discuss-issue"></i>
                    </div>
                    <div class="faq-content">
                        <h6 class="title">@lang($data->value->title)</h6>
                        <p>
                            @php echo $data->value->body; @endphp
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
