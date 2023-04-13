@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Welcome to larablog')
@section('meta_tags')
    <meta name="title" content="{{ Str::ucfirst($post->post_title) }}" />
    <meta name="robots" content="index, follow, max-snippet:-1,max-image-preview:large, max-video-preview:-1" />
    <meta name="description" content="{{ Str::ucfirst(words($post->post_content, 120)) }}" />
    <meta name="author" content="{{ $post->author->username }}" />
    <link rel="canonical" href="{{ route('read_post', $post->post_slug) }}">
    <meta property="og:title" content="{{ Str::ucfirst($post->post_title) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ Str::ucfirst(words($post->post_content, 120)) }}" />
    <meta property="og:url" content="{{ route('read_post', $post->post_slug) }}" />
    <meta property="og:image" content="asset(/storage/images/post_images/thumbnails/resized_{{ $post->featured_image }})" />
    <meta property="twitter:domain" content="{{ Request::getHost() }}" />
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:title" content="{{ Str::ucfirst($post->post_title) }}" />
    <meta property="twitter:description" content="{{ Str::ucfirst(words($post->post_content, 120)) }}" />
    <meta property="twitter:image" content="/storage/images/post_images/thumbnails/resized_{{ $post->featured_image }}" />

@endsection
@section('content')

<div class="row">
  <div class="col-lg-8 mb-5 mb-lg-0">
      <article>
          <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/resized_{{ $post->featured_image }}" alt="Post Thumbnail" class="w-100">
          <ul class="post-meta mb-2 mt-4">
              <li>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                      <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
                      <path
                          d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z">
                      </path>
                      <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z">
                      </path>
                  </svg> <span>{{ $post->created_at->format('d/m/Y') }}</span>
              </li>
          </ul>
          <h1 class="my-3">{{ $post->post_title }}</h1>
          <ul class="post-meta mb-4">
              <li> <a href="{{ route('category_posts', $post->subcategory->slug) }}">{{ $post->subcategory->subcategory_name }}</a>
              </li>
          </ul>
          <div class="content text-left">
              <p>{!! $post->post_content !!}</p>    
          </div>
      </article>
      @if(count($related_posts) > 0)
      <div class="mt-5">
        <h2 class="section-title mb-3">Bài viết liên quan</h2>
        <div class="widget-body">   
          <div class="widget-list">         
            {{-- 4 random --}}
            @foreach($related_posts as $item)
            <a class="media align-items-center" href="{{ route('read_post', $item->post_slug) }}">
              <img loading="lazy" decoding="async" src="/storage/images/post_images/{{ $item->featured_image }}" alt="Post Thumbnail" class="w-100">
              <div class="media-body ml-3">
                <h3 style="margin-top:-5px">{{ $item->post_title }}</h3>
                <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content, 7)) !!}</p>
              </div>
            </a>
            @endforeach
        
          </div>
        </div>
      </div>
      @endif
  </div>
  <div class="col-lg-4">
      <div class="widget-blocks">
          <div class="row">
              <div class="col-lg-12">
                  <div class="widget">
                      <div class="widget-body">
                          <img loading="lazy" decoding="async" src="/front/images/author.jpg" alt="About Me"
                              class="w-100 author-thumb-sm d-block">
                          <h2 class="widget-title my-3">Hootan Safiyari</h2>
                          <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter, Developer and Story
                              teller. Working as a Content writter at CoolTech Agency. Quam nihil …</p> <a
                              href="about.html" class="btn btn-sm btn-outline-primary">Know
                              More</a>
                      </div>
                  </div>
              </div>
              <div class="col-lg-12 col-md-6">
                  <div class="widget">
                      <h2 class="section-title mb-3">Đề xuất</h2>
                      @include('front.layouts.inc.recommended_list') 
                  </div>
              </div>

                {{-- hiển thị các post xem nhiều --}}
              @if (topview_sidebar_posts())
              <div class="col-lg-12 col-md-6">
                <div class="widget">
                  <h2 class="section-title mb-3">Xem Nhiều</h2>
                  @include('front.layouts.inc.topview_list')
                </div>
              </div>
              @endif
              
              <div class="col-lg-12 col-md-6">
                  <div class="widget">
                      <h2 class="section-title mb-3">Danh mục</h2>
                      <div class="widget-body">
                        @include('front.layouts.inc.categories_list')
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
@push('stylesheets')
    <link rel="stylesheet" href="/share_post/jquery.floating-social-share.min.css">
@endpush
@push('scripts')
    <script src="/share_post/jquery.floating-social-share.min.js"></script>
    <script>
        $("body").floatingSocialShare({
            buttons: [
                "facebook", "linkedin", "telegram", "twitter"
            ],
            text: "Share with: ",
            url: "{{ route('read_post', $post->post_slug) }}"
        });
    </script>
@endpush