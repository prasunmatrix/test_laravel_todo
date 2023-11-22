<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/frontend/images/favicon.ico')}}" type="image/x-icon">
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom scrollbar -->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/mCustomScrollbar.min.css')}}">
  <!-- Custom css -->
  <link href="{{asset('assets/frontend/css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/css/responsive.css')}}" rel="stylesheet">
  <!-- Google font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- jquery ui datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- jquery ui datepicker -->
  <!-- toastr -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <!-- toastr -->
  <title>Uttarer Saradin</title>
</head>

<body>

  <div class="main">
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
  </div>

  <!-- JavaScript -->
  <script src="{{asset('assets/frontend/js/jquery-3.7.0.min.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('assets/frontend/js/propper.min.js')}}"></script>
  <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/frontend/js/mCustomScrollbar.min.js')}}"></script>
  <script src="{{asset('assets/frontend/js/custom.js')}}"></script>
  <!-- jquery ui datepicker -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <!-- jquery ui datepicker -->
  <!-- toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <!-- toastr -->
  <script>
    function viewThisPage(id) {
      //alert(id);
      $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        url: "{{ route('showpage') }}",
        data: {
          'id': id
        },
        type: 'GET',
        dataType: 'json',
        success: function(result) {
          //console.log(result);
          if (result.status == '1') {
            $('#template').html(result.templateData);
          }
        }
      });
    }
  </script>
  <script>
    $(function() {
      $('#hiddenDate').datepicker({
        changeYear: 'true',
        changeMonth: 'true',
        //startDate: '07/16/1989',
        firstDay: 1,
        maxDate: 0,
        onSelect: function(dateText, inst) {
          //console.log(dateText);
          $.ajax({
            url: "{{ route('viewparticulardatedata') }}",
            data: {
              'dateText': dateText
            },
            type: 'GET',
            dataType: 'json',
            success: function(result) {
              //console.log(result.error);
              if (result.status == '0') {
                toastr.error(result.error, {
                  timeOut: 5000
                });
                //alert(result.error);
              } else {
                $('#template').html(result.datePickuptNewsPageData.template);
                var datePickuptNewsPageALLData = result.datePickuptNewsPageALLData;
                var optHtml = '';

                for (var i = 0; i < datePickuptNewsPageALLData.length; i++) {
                  optHtml += '<option value="' + datePickuptNewsPageALLData[i].id + '">' + datePickuptNewsPageALLData[i].page_number + '</option>';
                }
                $('#pageNumber').html(optHtml);

                var optHtml1 = '';
                var imageUrl="{{ asset('uploads/page_preview/') }}";
                console.log(imageUrl);
                for (var i = 0; i < datePickuptNewsPageALLData.length; i++) {
                  optHtml1+=`<li class="news-thumb_item"><p class="thumb-text">Page No.${datePickuptNewsPageALLData[i].page_number}</p><div class="thumb-img_block"><a href="javascript:void(0);" onclick="viewThisPage(${datePickuptNewsPageALLData[i].id})"><img src="${imageUrl}/${datePickuptNewsPageALLData[i].page_preview}"  alt="Page image"></a></div></li>`;
                }  
                $('#page_thumb_list').html(optHtml1);
                $('#date_page_title').html(result.changeDate);
                return true;
              }
            }
          });
        }
      });
      $('#pickDate').click(function(e) {
        $('#hiddenDate').datepicker("show");
        e.preventDefault();
      });
    });
  </script>
</body>

</html>