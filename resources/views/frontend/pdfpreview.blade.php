<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uttarer Saradin</title>
</head>
<style>
  .wp-block-image.size-full img {
    width: 100% !important;
  }
</style>
<body>
  <div class="main">
    <!-- Content area start -->
    <section class="news-paper_section">
      <div class="container">
        <div class="news-top_block">
          <div class="row">
            <div class="col-md-12">
              <div class="news-middle_block">
                <span id="template1">{!! $pageData->template !!}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Content area end -->
  </div>
  <!-- js for editor date:21 jun 2023 -->
  <script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
  <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
  <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
  <!-- js for editor date:21 jun 2023 -->
</body>
</html>  