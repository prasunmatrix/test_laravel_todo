@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Pages</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Pages Management</li>
  </ol>

  <div class="card mt-4">
    <div class="card-header">
      Pages
      @if($checkpublished->published=='0') 
      <a href="{{ url('admin/add-pages',$id) }}" class="btn btn-primary btn-sm float-end">
        Add Pages 
      </a>
      @endif
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
      <table class="table table-bordered" id="pages-table">
        <thead>
          <tr>
            <th>Page Number</th>
            <th>Page Add Date</th>
            <th>Page Preview</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
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