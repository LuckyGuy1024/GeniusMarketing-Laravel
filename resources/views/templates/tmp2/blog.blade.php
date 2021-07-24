@extends(activeTemplate() .'layouts.master')

@section('content')

    @include(activeTemplate() .'layouts.breadcrumb')
    <section class="blog-section padding-bottom padding-top">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                @foreach($blogs as $blog)
                    <div class="col-md-6 col-xl-4 col-sm-10">
                        <div class="post-item  wow slideInUp">
                            <div class="post-thumb c-thumb">
                                <a href="{{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}">
                                    <img
                                        src="{{ get_image(config('constants.frontend.blog.post.path') .'/'. $blog->value->image) }}"
                                        alt="blog">
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="blog-header">
                                    <h6 class="title">
                                        <a href="{{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}">{{__($blog->value->title)}}</a>
                                    </h6>
                                </div>
                                <div class="meta-post">
                                    <div class="date">
                                        <a>
                                            <i class="flaticon-calendar"></i>
                                            {{\Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}
                                        </a>
                                    </div>

                                </div>
                                <div class="entry-content">
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->value->body), 160, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center d-block">
                <div class="col-md-12">
                    {{$blogs->links()}}
                </div>
            </div>
        </div>
    </section>
@stop
