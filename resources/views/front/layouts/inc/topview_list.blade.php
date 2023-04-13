<div class="widget-body">
  <div class="widget-list">
    {{-- recommended_one_posts --}}
    {{-- @if (topview_sidebar_posts())
      <article class="card mb-4">
        <div class="card-image">
          <div class="post-info"> <span class="text-uppercase">{{ readDuration(topview_sidebar_posts()->post_title, topview_sidebar_posts()->post_content) }}
            @choice('min|mins', readDuration(topview_sidebar_posts()->post_title, topview_sidebar_posts()->post_content)) đọc</span>
          </div>
          <img loading="lazy" decoding="async" src="/storage/images/post_images/{{ topview_sidebar_posts()->featured_image }}" alt="Post Thumbnail" class="w-100">
        </div>
        <div class="card-body px-0 pb-1">
          <h3><a class="post-title post-title-sm"
              href="{{ route('read_post', topview_sidebar_posts()->post_slug) }}"> {{ topview_sidebar_posts()->post_title }} </a></h3>
          <p class="card-text"> {!! Str::ucfirst(words(topview_sidebar_posts()->post_content, 25)) !!} </p>
          <div class="content"> <a class="read-more-btn" href="{{ route('read_post', topview_sidebar_posts()->post_slug) }}">Xem thêm</a>
          </div>
        </div>
      </article>
    @endif --}}
    
    {{-- 4 random --}}
    @foreach(topview_sidebar_posts() as $item)
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