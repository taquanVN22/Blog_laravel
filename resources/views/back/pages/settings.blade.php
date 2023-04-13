@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Cài đặt chung')
@section('content')
  <div class="row align-items-center">
    <div class="col">
      <div class="page-title">
        Thiết lập
      </div>
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="#tabs-home-14" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Cài đặt chung</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-profile-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Logo & Favicon</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-activity-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Mạng xã hội</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="tabs-home-14" role="tabpanel">
          <div>
            @livewire('author-general-settings')
          </div>
        </div>
        <div class="tab-pane fade" id="tabs-profile-14" role="tabpanel">
          <div>
            <div class="row">
              <div class="col-md-6">
                <h3>Blog logo</h3>
              <div class="mb-2" style="max-width: 200px;">
                <img src="" alt="" class="img-thumbnail" id="logo-image-preview" data-ijabo-default-img="{{ \App\Models\Setting::find(1)->blog_logo }}">
              </div>
              <form action="{{ route('author.change-blog-logo') }}" method="post" id='changeBlogLogoForm'>
                @csrf
                <div class="mb-2">
                  <input type="file" name="blog_logo" class="form-control">
                </div>
                <button class="btn btn-primary">Thay đổi Logo</button>
              </form>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <h3>Blog favicon</h3>
              <div class="mb-2" style="max-width: 100px;">
                <img src="" alt="" class="img-thumbnail" id="favicon-image-preview" data-ijabo-default-img="{{ \App\Models\Setting::find(1)->blog_favicon }}">
              </div>
              <form action="{{ route('author.change-blog-favicon') }}" method="post" id='changeBlogFaviconForm'>
                @csrf
                <div class="mb-2">
                  <input type="file" name="blog_favicon" class="form-control">
                </div>
                <button class="btn btn-primary">Thay đổi favicon</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tabs-activity-14" role="tabpanel">
          <div>
            @livewire('author-blog-social-media-form')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')

  <Script>
    // logo
    $('input[name="blog_logo"]').ijaboViewer({
        preview : '#logo-image-preview', //xác định vị trí hiển thị ảnh trước khi cắt
        imageShape:'rectangular', //xác định tỷ lệ khung hình cho công cụ cắt ảnh (1:1)
        allowedExtensions: ['jpg', 'jpeg','png'],
        onErrorShape:function(message, element){
          toastr.error('Hình ảnh phải có hình dạng hình chữ nhật');
        },
        onInvalidType:function(message, element){
          toastr.error('Loại tệp không hợp lệ');
        }
      });

      // favicon
      $('input[name="blog_favicon"]').ijaboViewer({
        preview : '#favicon-image-preview', //xác định vị trí hiển thị ảnh trước khi cắt
        imageShape:'square', //xác định tỷ lệ khung hình cho công cụ cắt ảnh (1:1)
        allowedExtensions: ['ico','png'],
        onErrorShape:function(message, element){
          toastr.error(message);
        },
        onInvalidType:function(message, element){
          toastr.error('Loại tệp không hợp lệ');
        }
      });

      // logo
      $('#changeBlogLogoForm').submit(function(e){
        e.preventDefault();
        var form = this;
        $.ajax({  
          url:$(form).attr('action'),
          method:$(form).attr('method'),
          data:new FormData(form),
          processData:false,
          dataType:'json',
          contentType:false,
          beforeSend:function(){},
          success:function(data){
            toastr.remove();
            if(data.status == 1){
              toastr.success(data.msg);
              $(form)[0].reset();
              livewire.emit('updateTopHeader');
            }else{
              toastr.error(data.msg);
            }
          }
        });
      });

      // favicon
      $('#changeBlogFaviconForm').submit(function(e){
        e.preventDefault();
        var form = this;
        $.ajax({  
          url:$(form).attr('action'),
          method:$(form).attr('method'),
          data:new FormData(form),
          processData:false,
          dataType:'json',
          contentType:false,
          beforeSend:function(){},
          success:function(data){
            toastr.remove();
            if(data.status == 1){
              toastr.success(data.msg);
              $(form)[0].reset();
              livewire.emit('updateTopHeader');
            }else{
              toastr.error(data.msg);
            }
          }
        });
      });
  </Script>

@endpush