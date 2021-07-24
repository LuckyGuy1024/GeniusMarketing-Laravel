@extends(activeTemplate() .'layouts.master')

@section('content')

    @include(activeTemplate() .'layouts.breadcrumb')
    <div class="blog-section padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <article>
                        <div class="post-item post-classic post-details">
                            <div class="post-thumb c-thumb">
                                <img src="{{ get_image(config('constants.frontend.blog.post.path') .'/'. $blog->value->image) }}" alt="blog">
                            </div>
                            <div class="post-content">
                                <div class="blog-header">
                                    <h6 class="title">
                                        @lang($blog->value->title)
                                    </h6>
                                </div>
                                <div class="tag-options">
                                        <div class="tags">
                                            <span><i class="flaticon-calendar"></i></span>
                                            {{\Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}
                                        </div>
                                        <div class="share">
                                            <span><i class="fas fa-share-alt"></i></span>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}"><i class="fab fa-facebook-f"></i></a>
                                            <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}"><i class="fab fa-twitter"></i></a>
                                            <a href="#0"><i class="fab fa-pinterest-p"></i></a>
                                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}&amp;title=my share text&amp;summary=dit is de linkedin summary"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                <div class="entry-content">
                                   <p>
                                      @php echo $blog->value->body; @endphp
                                   </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <aside class="b-sidebar">
                        <div class="widget widget-post">
                            <h6 class="title">@lang('recent post')</h6>
                            <ul>
                                @foreach($latestBlogs as $data)
                                    <li>
                                    <div class="c-thumb">
                                        <a href="{{ route('singleBlog', [slug($data->value->title) , $data->id]) }}">
                                            <img src="{{ get_image(config('constants.frontend.blog.post.path') .'/'. $data->value->image) }}" alt="blog">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="sub-title">
                                            <a href="{{ route('singleBlog', [slug($data->value->title) , $data->id]) }}">{{__($data->value->title)}}</a>
                                        </h6>
                                        <div class="meta">
                                            @lang('Post at') : - <a >  {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

@stop
@push('image')
    <script type="text/javascript">
        $('meta[name=og:fbimage]').attr('content','{{ get_image(config('constants.frontend.blog.post.path').'/'.$blog->value->image) }}');
    </script>
@endpush
