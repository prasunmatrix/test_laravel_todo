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
    function viewThisPage(id, data) {
      //console.log(data);
      $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        url: "{{ route('showpage') }}",
        data: {
          'id': id,
          'data': data
        },
        type: 'GET',
        dataType: 'json',
        success: function(result) {
          //console.log(result);
          if (result.status == '1') {
            //$('#template').html(result.templateData);
            $('#template_prev_next').html(result.templateData);
            var id = result.id;
            var latestNewsPageALLData = result.latestNewsPageALLData;
            var optHtml = '';

            // for (var i = 0; i < latestNewsPageALLData.length; i++) {
            //   optHtml += `<option value="${latestNewsPageALLData[i].id}" if(${latestNewsPageALLData[i].id==result.id}){ selected }>${latestNewsPageALLData[i].page_number}</option>`;
            // }
            //console.log(latestNewsPageALLData.length);
            // for (var i = 0; i < latestNewsPageALLData.length; i++) {
            //   console.log(id);
            //   console.log(latestNewsPageALLData[i].id);
            //   optHtml +='<option value="'+latestNewsPageALLData[i].id+'" if(latestNewsPageALLData[i].id==id) { selected }>'+latestNewsPageALLData[i].page_number+'</option>';
            // }
            for (var i = 0; i < latestNewsPageALLData.length; i++) {
              var selectedTxt = '';
              if (latestNewsPageALLData[i].id == id) {
                selectedTxt = 'selected';
              }
              optHtml += '<option value="' + latestNewsPageALLData[i].id + '" ' + selectedTxt + '>' + latestNewsPageALLData[i].page_number + '</option>';
            }
            $('#pageNumber').html(optHtml);
          }
        }
      });
    }
    // $(document).on("change",'#pageNumber1',function(){
    //   viewThisPagePrevious(this.value,dateText);
    // })
    function viewThisPagePrevious(id, data) {
      //console.log(data);
      $.ajax({
        url: "{{ route('showpageprevious') }}",
        data: {
          'id': id,
          'data': data
        },
        type: 'GET',
        dataType: 'json',
        success: function(result) {
          //console.log(result);
          if (result.status == '1') {
            //$('#template').html(result.templateData);
            $('#template_prev_next').html(result.templateData);
            var id = result.id;
            var latestNewsPageALLData = result.latestNewsPageALLData;
            var optHtml = '';
            optHtml +=`<select class="form-select" id="pageNumber1" aria-label="Default select example" onchange="viewThisPagePrevious(this.value,'${result.dateData}')">`;
            for (var i = 0; i < latestNewsPageALLData.length; i++) {
              var selectedTxt = '';
              if (latestNewsPageALLData[i].id == id) {
                selectedTxt = 'selected';
              }
              optHtml += '<option value="' + latestNewsPageALLData[i].id + '" ' + selectedTxt + '>' + latestNewsPageALLData[i].page_number + '</option>';
            }
             optHtml +='</select>';
            //$('#pageNumber').html(optHtml);
            $('#pageNumber_datewise').html(optHtml);
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
                //$('#template').html(result.datePickuptNewsPageData.template);
                //$('#template').html(result.datePickuptNewsPageData);
                $('#template_prev_next').html(result.datePickuptNewsPageData);
                var datePickuptNewsPageALLData = result.datePickuptNewsPageALLData;
                var optHtml = '';
                optHtml +=`<select class="form-select" id="pageNumber1" aria-label="Default select example" onchange="viewThisPagePrevious(this.value,'${dateText}')">`;  
                for (var i = 0; i < datePickuptNewsPageALLData.length; i++) {
                  var selectedTxt = '';
                  if(datePickuptNewsPageALLData[i].id == result.id) {
                    selectedTxt = 'selected';
                  }
                  optHtml += '<option value="' + datePickuptNewsPageALLData[i].id + '" ' + selectedTxt + '>' + datePickuptNewsPageALLData[i].page_number + '</option>';
                }
                optHtml +='</select>';
                //$('#pageNumber').html(optHtml);
                $('#pageNumber_datewise').html(optHtml);
                var optHtml1 = '';
                var imageUrl = "{{ asset('uploads/page_preview/') }}";
                console.log(imageUrl);
                for (var i = 0; i < datePickuptNewsPageALLData.length; i++) {
                  console.log(dateText);
                  optHtml1 += `<li class="news-thumb_item"><p class="thumb-text">Page No.${datePickuptNewsPageALLData[i].page_number}</p><div class="thumb-img_block"><a href="javascript:void(0);" onclick="viewThisPagePrevious('${datePickuptNewsPageALLData[i].id}','${dateText}')"><img src="${imageUrl}/${datePickuptNewsPageALLData[i].page_preview}"  alt="Page image"></a></div></li>`;
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

    function pageChange(id,prev_next) {
      //alert(0);
      // if (id != '0' && id!='null' && id!='undefined') {
        $.ajax({
          url: "{{ route('pagechange') }}",
          data: {
            'id': id,
            'prev_next': prev_next
          },
          type: 'GET',
          dataType: 'json',
          success: function(result) {
            if(result.status=='1')
            {
              $('#template').html(result.templateData);
              viewThisPage(result.id,result.newsdDate);
            }
            else if(result.status=='2')
            {
              toastr.error(result.error, {
                  timeOut: 5000
                });
            }
            else
            {
              //console.log(result.prev_next);
              var prev_next=result.prev_next;
              if(prev_next=='prev')
              {
                alert('You are on first page.');
              }
              else
              {
                alert('You are on last page.');
              }
            }
          }
        });
      // } else {
      //   toastr.error('No record found!', {
      //     timeOut: 5000
      //   });
      // }
    }
    function pageChangePreviousDate(id,prev_next) {
      //alert(0);
      //alert(prev_next);
      //if (id != '0' && id!='null' && id!='undefined') {
        $.ajax({
          url: "{{ route('pagechangepreviousdate') }}",
          data: {
            'id': id,
            'prev_next': prev_next
          },
          type: 'GET',
          dataType: 'json',
          success: function(result) {
            if(result.status=='1')
            {
              $('#template').html(result.templateData);
              viewThisPagePrevious(result.id,result.newsdDate);
            }
            else if(result.status=='2')
            {
              toastr.error(result.error, {
                  timeOut: 5000
                });
            }
            else
            {
              var prev_next=result.prev_next;
              if(prev_next=='prev')
              {
                alert('You are on first page.');
              }
              else
              {
                alert('You are on last page.');
              }
            }
          }
        });
      // } else {
      //   toastr.error('No record found!', {
      //     timeOut: 5000
      //   });
      // }
    }
  </script>
</body>

</html>