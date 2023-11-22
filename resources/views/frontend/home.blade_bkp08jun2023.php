@extends('layouts.app')

@section('content')
<!-- Content area start -->
<section class="news-paper_section">
  <div class="container">
    <div class="news-top_block">
      <div class="row">
        <div class="col-md-2">
          <div class="news-left_block" id="news-scroll">
            <ul class="news-thumb_list">
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
            </ul>
          </div>
        </div>
        <div class="col-md-7">
          <div class="news-middle_block">
            <img src="{{asset('assets/frontend/images/Page.jpg')}}" alt="News page image">
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