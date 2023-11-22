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
    </div>
  </div>
</div>

@endsection
@push('custom-scripts')

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- DataTables -->
<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script> -->
<!-- Sweet alert -->
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<!-- <script>
  $(document).ready(function() {
    oTable = $('#news-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{!! route("admin.news.list.table") !!}',
        data: function(d) {
          d.type = $('select[name=type]').val();
        }
      },
      columns: [{
          data: 'news_date',
          name: 'news_date'
        },
        {
          data: 'slot',
          name: 'slot'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ],
      drawCallback: function() {
        
      }
    });
    $('select[name="type"]').on("change", function(event) {
      oTable.draw();
      event.preventDefault();
    });
  });
  $(document).on('click', '.delete-alert', function(e) {
    e.preventDefault();
    var redirectUrl = $(this).data('redirect-url');
    // alert(redirectUrl)
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this news!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = redirectUrl;
        }
      });
  });
</script> -->
@endpush