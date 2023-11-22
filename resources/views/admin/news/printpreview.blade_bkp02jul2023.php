{{--@extends('admin.layouts.after-login-layout') --}}

<link href="{{asset('assets/admin/css/styles.css')}}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
<link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
<script src="{{asset('assets/admin/js/html2canvas.js')}}"></script>
<script src="{{asset('assets/admin/js/canvas2image.js')}}"></script>

{{--@section('unique-content')--}}
<style>
  .wp-block-image.size-full img {
    width: 100% !important;
  }
</style>
<div class="container-fluid px-4">
  <!-- <h1 class="mt-4">Page Preview</h1> -->

  <!-- <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Page Preview Management</li>
  </ol> -->

  <div class="card mt-4">
    <div class="card-header">
      <input type="button" id="btnSave" onclick="printDiv('img-out')" class="btn btn-primary btn-sm float-end" value="Print" />
    </div>
    <div class="card-body">
      <span id="print_template">{!! $page->template !!}</span>
      <div id="img-out"></div>
      <!-- <input type="button" id="btnSave" onclick="printDiv('print_template')" class="btn btn-primary btn-sm float-end" value="Print" /> -->
    </div>
  </div>
</div>

{{--@endsection--}}
{{--@push('custom-scripts') --}}


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('assets/admin/js/html2canvas.js')}}"></script>
<script src="{{asset('assets/admin/js/canvas2image.js')}}"></script>
<script>
  $(function() {
    $("#btnSave").click(function() {
      console.log('test');
      html2canvas($("#template"), {
        onrendered: function(canvas) {
          theCanvas = canvas;
          //document.body.appendChild(canvas);

          // Convert and download as image 
          Canvas2Image.saveAsPNG(canvas);
          //$("#img-out").append(canvas);
          // Clean up 
          //document.body.removeChild(canvas);
        }
      });
    });
  });
</script> -->
<script>
  function printDiv(elem) {
    console.log(elem);
    html2canvas($("#print_template"), {
      onrendered: function(canvas) {
        theCanvas = canvas;
        //document.body.appendChild(canvas);

        // Convert and download as image 
        //Canvas2Image.saveAsPNG(canvas);
        //$("#img-out").append(canvas);
        $("#img-out").html(canvas);
        // Clean up 
        //document.body.removeChild(canvas);
      }
    });


    var mywindow = window.open();
    var content = document.getElementById(elem).innerHTML;
    var realContent = document.body.innerHTML;
    mywindow.document.write(content);
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
    mywindow.print();
    document.body.innerHTML = realContent;
    mywindow.close();
    return true;
  }
</script>
{{--@endpush--}}