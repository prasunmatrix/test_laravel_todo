@extends('admin.layouts.after-login-layout')
@section('unique-content')
<style>
  .wp-block-image.size-full img{
    width: 100% !important;
  }
</style>
<div class="container-fluid px-4">
  <h1 class="mt-4">Page Preview</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Page Preview Management</li>
  </ol>

  <div class="card mt-4">
    <div class="card-header">
      <input type="button" id="btnSave" class="btn btn-primary btn-sm float-end" value="Save Image" />
      <input type="button" id="btnSavePdf" class="btn btn-primary btn-sm float-end" style="margin-right: 10px;" value="Save Pdf" />
    </div>
    <div class="card-body">
      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissable __web-inspector-hide-shortcut__">
        <span style="color:green;">{{ Session::get('success') }}</span>
      </div>
      @endif
      @if(Session::has('error'))
      <div class="alert alert-danger alert-dismissable">
        <span style="color:red;">{{ Session::get('error') }}</span>
      </div>
      @endif
      <span id="template">{!! $page->template !!}</span>
      <div id="editor"></div>
    </div>
  </div>
</div>

@endsection
@push('custom-scripts')

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
@endpush