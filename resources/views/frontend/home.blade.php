@extends('layouts.app')
<style>
  .wp-block-image.size-full img{
    width: 100% !important;
  }
</style>
@section('content')
<!-- Content area start -->
<section class="news-paper_section">
  <div class="container">
    <div class="news-top_block">
      <div class="row">
        <div class="col-md-2">
          <div class="news-left_block" id="news-scroll">
            <!-- <ul class="news-thumb_list">
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 1</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 2</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 3</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 4</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 5</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 6</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 7</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
              <li class="news-thumb_item">
                <p class="thumb-text">Page No. 8</p>
                <div class="thumb-img_block">
                  <img src="{{asset('assets/frontend/images/page01.png')}}" alt="Page image">
                </div>
              </li>
            </ul> -->
            <ul class="news-thumb_list" id="page_thumb_list">
              @if(isset($letestNewsPageALLData))
              @foreach($letestNewsPageALLData as $key=>$data)
              <li class="news-thumb_item">
                <p class="thumb-text">Page No.{{ $data->page_number}}</p>
                <div class="thumb-img_block">
                  <a href="javascript:void(0);" onclick="viewThisPage('{{ $data->id }}','{{$current_date}}')"><img src="{{asset('uploads/page_preview/'.$data->page_preview)}}"  alt="Page image"></a>
                </div>
              </li>
              @endforeach
              @endif
            </ul>  
          </div>
        </div>
        <div class="col-md-7">
          <div class="news-middle_block" id="template_prev_next">
            <!-- <img src="{{asset('assets/frontend/images/Page.jpg')}}" alt="News page image"> -->
            <a href="javascript:void(0);" class="prev-arrow"  onclick="pageChange('{{$previous_page_id}}','prev')"><img src="{{asset('assets/frontend/images/arrow_left.svg')}}" alt="Prev Arrow image"></a>
              <span id="template">{!! $letestNewsPageData->template !!}</span>
             <a href="javascript:void(0);" class="next-arrow"  onclick="pageChange('{{$next_page_id}}','next')"><img src="{{asset('assets/frontend/images/arrow_right.svg')}}" alt="Next Arrow image"></a>  
          </div>
        </div>
        <div class="col-md-3">
          <div class="news-right_block">
            <img src="{{asset('assets/frontend/images/Ad-right.jpg')}}" alt="News page image">
          </div>
        </div>
      </div>
    </div>
    <div class="news-bottom_block">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="news-bottom_ad"><img src="{{asset('assets/frontend/images/Ad-footer.jpg')}}" alt="news ad"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Content area end -->
@endsection