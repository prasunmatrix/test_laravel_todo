<!-- Header Top image start -->
<section class="header-top">
  <div class="container">
    <div class="img-wrapper text-center">
      <img src="{{asset('assets/frontend/images/Add-top.png')}}" alt="Top Ad Image">
    </div>
  </div>
</section>
<!-- Header Top image end -->

<!-- Header start -->
<header>
  <div class="header-logo_wrapper">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-2 col-3">
          <div class="header-logo_block text-start">
            <a class="logo-link" href="#"><img src="{{asset('assets/frontend/images/logo01.svg')}}" alt="" class="logo-radio"></a>
          </div>
        </div>
        <div class="col-md-8 col-6">
          <div class="header-logo_block text-center">
            <a class="logo-link" href="#"><img src="{{asset('assets/frontend/images/logo02.svg')}}" alt="" class="logo-us"></a>
          </div>
        </div>
        <div class="col-md-2 col-3">
          <div class="header-logo_block text-end">
            <a class="logo-link" href="#"><img src="{{asset('assets/frontend/images/logo03.svg')}}" alt="" class="logo-hn"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-text_block">
    <div class="container">
      <nav class="navbar navbar-expand navbar-light us-nav">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#"> <span class="menu-icon"><img src="{{asset('assets/frontend/images/ic_home.svg')}}" alt="home icon"></span>SUPPLEMENT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">ROBIBASORIYO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">ITYADI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">PATRIKA</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="header-text_bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="date-page_block">
              <div class="date-block">
                <!-- <p class="date-page_title">Thursday, 25 May, 2023</p> -->
                @php
                $current_date=date('Y-m-d');
                //$currentDate = date("D, d M Y", strtotime($current_date));
                @endphp
                <p class="date-page_title" id="date_page_title">{{ $letestNewsDate }}</p>
              </div>
              <div class="page-block">
                <span class="date-page_title">
                  <input id="hiddenDate" type="hidden" />
                  <a href="javascript:void(0)" id="pickDate"><img src="{{asset('assets/frontend/images/ic_archive.svg')}}" alt="Page Icon" class="page-icon"></a>
                  Page No.
                </span>
                @if(isset($letestNewsPageALLData))
                <div id="pageNumber_datewise">
                  <select class="form-select" id="pageNumber" aria-label="Default select example" onchange="viewThisPage(this.value,'{{ $current_date }}')">
                    @foreach($letestNewsPageALLData as $key=>$data)
                    <option value="{{ $data->id }}">{{ $data->page_number}}</option>
                    <!-- <option value="2">2</option>
                    <option value="3">3</option> -->
                    @endforeach
                  </select>
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <ul class="icon-list">
              <li class="icon-item"><a href="#" class="icon-link"><img src="{{asset('assets/frontend/images/ic_crop.svg')}}" alt="crop icon"></a></li>
              <li class="icon-item"><a href="#" class="icon-link"><img src="{{asset('assets/frontend/images/ic_cropped_item.svg')}}" alt="image crop icon"></a></li>
              <li class="icon-item"><a href="#" class="icon-link"><img src="{{asset('assets/frontend/images/ic_zoom.svg')}}" alt="zoom icon"></a></li>
              <li class="icon-item"><a href="#" class="icon-link"><img src="{{asset('assets/frontend/images/ic_sound.svg')}}" alt="sound icon"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

</header>
<!-- Header end -->