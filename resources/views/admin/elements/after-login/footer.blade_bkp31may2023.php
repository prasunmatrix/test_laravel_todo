<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/admin/js/scripts.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Summernote -->
<script src="{{asset('assets/admin/plugins/summernote/summernote-lite.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/admin/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/admin/demo/chart-bar-demo.js')}}"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{asset('assets/admin/js/datatables-simple-demo.js')}}"></script> -->

<!-- for New dataTable  by PK date:27 jan 2023 -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<!-- for New dataTable by PK date:27 jan 2023 -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{asset('assets/admin/js/development_admin.js')}}"></script>
<!-- jquery ui datepicker by pk date:30 may 2023 -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- jquery ui datepicker by pk date:30 may 2023 -->
<script>
  $(document).ready(function() {
    $('#datatablesSimple').DataTable({
      select: true
    });
  });
</script>
<script>
  $(function() {
    // Summernote
    $('.textarea').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 150,
      // toolbar: [
      //   ['style', ['style']],
      //   ['font', ['bold', 'underline', 'clear']],
      //   ['color', ['color']],
      //   ['para', ['ul', 'ol', 'paragraph']],
      //   ['table', ['table']],
      //   ['insert', ['link', 'picture', 'video']],
      //   ['view', ['fullscreen', 'codeview', 'help']]
      // ]
    });
  })
  $(function() {
    // Summernote
    $('.contentdata').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 250,
    });
  })
  $("#galley_images").change(function() {
    readURL(this);
    //alert('test');
  });

  function readURL(input) {
    let filesArray = input.files;
    //console.log(filesArray);
    if (filesArray && filesArray.length > 0) {
      for (i = 0; i < filesArray.length; i++) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.homeImages').append('<div id="imageDiv20" class="col-sm-3"><img src="' + e.target.result + '" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_image[]" value="Y" ></div></div></div></div></div>');
        }
        reader.readAsDataURL(filesArray[i]);
      }
    }
  }
  $(document).on('click', '.deletemedia', function(e) {
    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "Do you want to delete the media ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((trueResponse) => {
        if (trueResponse) {
          let imageDivId = $(this).attr('data-id');
          if (imageDivId != 0) {

            var fdata = new FormData();
            fdata.append("_token", "{{ csrf_token() }}");
            fdata.append("encryptId", $(this).attr('data-encrypt'));

            $.ajax({
              type: "POST",
              contentType: false,
              processData: false,
              url: "{{ route('admin.gallery_imagedelete') }}",
              data: fdata,
              success: function(response) {
                if (response.has_error == 0) {
                  // $(document).Toasts('create', {
                  //         class: 'bg-info', 
                  //         title: 'Success',
                  //         body: response.msg,
                  //         delay: 3000,
                  //         autohide:true
                  // });
                  toastr.success(response.msg);
                  // alert(imageDivId);
                  $('#imageDiv' + imageDivId + '').remove();
                } else {
                  // $(document).Toasts('create', {
                  //         class: 'bg-danger', 
                  //         title: 'Error',
                  //         body: response.msg,
                  //         delay: 3000,
                  //         autohide:true
                  // });
                  toastr.error(response.msg);
                }
              }
            });
          } else {
            $(this).parent().parent().parent().parent().remove();
            $(document).Toasts('create', {
              class: 'bg-info',
              title: 'Success',
              body: "Successfully Removed.",
              delay: 3000,
              autohide: true
            });
          }

        }
      });
  });
</script>
<script>
  $(document).ready(function() {
    oTable = $('#news-table').DataTable({
      processing: true,
      serverSide: true,
      "order": [
        [2, "desc"]
      ],
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
</script>
<script>
  $(function() {
    $("#news_date").datepicker();
  });
</script>
<script>
  $(document).ready(function() {
    oTable = $('#user-table').DataTable({
      processing: true,
      serverSide: true,
      "order": [
        [2, "desc"]
      ],
      ajax: {
        url: '{!! route("admin.user.list.table") !!}',
        data: function(d) {
          d.type = $('select[name=type]').val();
        }
      },
      columns: [
        // {
        //   data: 'id',
        //   name: 'id'
        // },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'status',
          name: 'status'
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
  $(document).on('click', '.changeStatus', function(e) {
    e.preventDefault();
    let redirectUrl = $(this).data('redirect-url');
    var btnId = $(this).attr('id');
    swal({
        title: "Are you sure?",
        text: "Do you want to change the status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((trueResponse) => {
        if (trueResponse) {
          $.ajax({
            url: redirectUrl,
            cache: false,
            success: function(response) {

              if (response.has_error == 0) {
                // $(document).toastr('create', {
                //   class: 'bg-info',
                //   title: 'Success',
                //   body: response.msg,
                //   delay: 3000,
                //   autohide: true
                // })
                toastr.success('Succressfuuly changed status.', {timeOut: 3000})
                if ($('#' + btnId).hasClass('btn-warning')) {
                  $('#' + btnId).removeClass('btn-warning');
                  $('#' + btnId).addClass('btn-success');
                  $('#' + btnId).html('Active');
                } else {
                  $('#' + btnId).removeClass('btn-success');
                  $('#' + btnId).addClass('btn-warning');
                  $('#' + btnId).html('Inactive');
                }
              } else {
                alert('Something went wrong ');
              }
            }
          });
        }
      });
  })
</script>
</body>

</html>