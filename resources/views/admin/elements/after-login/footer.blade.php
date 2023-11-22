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
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/admin/js/development_admin.js')}}"></script>
<!-- jquery ui datepicker by pk date:30 may 2023 -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- jquery ui datepicker by pk date:30 may 2023 -->
<!-- js for editor date:31 may 2023 -->
<script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
<link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
<!-- js for editor date:31 may 2023 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="{{asset('assets/admin/js/html2canvas.js')}}"></script>
<script src="{{asset('assets/admin/js/canvas2image.js')}}"></script>
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
        [1, "desc"]
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
        // {
        //   data: 'slot',
        //   name: 'slot'
        // },
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
    //$("#news_date").datepicker();
    $("#news_date").datepicker({
      dateFormat: 'dd/mm/yy'
    });
  });
</script>
<script>
  $(document).ready(function() {
    var i = 1;
    oTable = $('#user-table').DataTable({
      processing: true,
      serverSide: true,
      "order": [
        [0, "desc"]
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
          "render": function() {
            return i++;
          }
        },
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
                toastr.success('Succressfuuly changed status.', {
                  timeOut: 3000
                })
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
  $(document).on('click', '.delete-alert-user', function(e) {
    e.preventDefault();
    var redirectUrl = $(this).data('redirect-url');
    // alert(redirectUrl)
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
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
  $(document).ready(function() {
    var i = 1;
    oTable = $('#todo-table').DataTable({
      processing: true,
      serverSide: true,
      "order": [
        [0, "desc"]
      ],
      ajax: {
        url: '{!! route("admin.todo.list.table") !!}',
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
          "render": function() {
            return i++;
          }
        },
        {
          data: 'task_name',
          name: 'task_name'
        },
        {
          data: 'task_description',
          name: 'task_description'
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
  $(document).on('click', '.changeStatusTodo', function(e) {
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
                toastr.success('Succressfuuly changed status.', {
                  timeOut: 3000
                })
                if ($('#' + btnId).hasClass('btn-warning')) {
                  $('#' + btnId).removeClass('btn-warning');
                  $('#' + btnId).addClass('btn-success');
                  $('#' + btnId).html('Complete');
                } else {
                  $('#' + btnId).removeClass('btn-success');
                  $('#' + btnId).addClass('btn-warning');
                  $('#' + btnId).html('Incomplete');
                }
              } else {
                alert('Something went wrong ');
              }
            }
          });
        }
      });
  })
  $(document).on('click', '.delete-alert-todo', function(e) {
    e.preventDefault();
    var redirectUrl = $(this).data('redirect-url');
    // alert(redirectUrl)
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this task!",
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
  $(document).ready(function() {
    // $('.block-editor__sidebar').hide();
    // $('.block-editor__header .is-pressed').hide();
  })
  Laraberg.init('template', {
    mediaUpload: mediaUploaded,
    minHeight: '100vh',
  });


  function mediaUploaded({
    filesList,
    onFileChange
  }) {
    setTimeout(async () => {

      let formD = new FormData;
      Array.from(filesList).map(file => {
        formD.append('upload', file);
      });

      const uploadedResponse = await $.ajax({
        method: "POST",
        url: "{!! route('admin.editor-upload', ['_token' => csrf_token() ]) !!}",
        data: formD,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log({
            response
          })
          // return response;
          const uploadedFiles = Array.from(filesList).map(file => {

            return {
              id: new Date().getTime(),
              name: file.name,
              url: response
            }
          })

          onFileChange(uploadedFiles)

        },
        error: function(savePostErr) {
          console.log({
            savePostErr
          })
        }
      })


    }, 1000)
  }
  // pages datatable according to news
  $(document).ready(function() {
    oTable = $('#pages-table').DataTable({
      processing: true,
      serverSide: true,
      "order": [
        [2, "asc"]
      ],
      ajax: {
        url: '{!! route("admin.news.pages-list-table",$id ?? '
        ') !!}',
        data: function(d) {
          d.type = $('select[name=type]').val();
        }
      },
      columns: [{
          data: 'page_number',
          name: 'page_number'
        },
        {
          data: 'page_add_date',
          name: 'page_add_date'
        },
        {
          data: 'page_preview',
          name: 'page_preview'
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
  // pages change status
  $(document).on('click', '.changeStatusPages', function(e) {
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
                toastr.success('Succressfuuly changed status.', {
                  timeOut: 3000
                })
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
  $(document).on('click', '.delete-alert-page', function(e) {
    e.preventDefault();
    var redirectUrl = $(this).data('redirect-url');
    // alert(redirectUrl)
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this page!",
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
    $("#btnSavePdf").click(function() {
      //console.log('test');
      html2canvas($("#template"), {
        onrendered: function(canvas) {
          theCanvas = canvas;
          //document.body.appendChild(canvas);

          // Convert and download as image 
          //Canvas2Image.saveAsPNG(canvas);
          //$("#img-out").append(canvas);
          // Clean up 
          //document.body.removeChild(canvas);
          var img = canvas.toDataURL("image/png");
          $.ajax({
            url: "{!! route('admin.news.imagepdf',['_token' => csrf_token() ]) !!}",
            data: {
              'img': img
            },
            type: 'POST',
            //dataType: 'json',
            // xhrFields: {
            //   responseType: 'blob'
            // },
            success: function(result) {              
              // var blob = new Blob([result]);
              // var link = document.createElement('a');
              // link.href = window.URL.createObjectURL(blob);
              // link.download = "download.pdf";
              // link.click();
              var url='http://127.0.0.1:8000/admin/pdf/';
              window.open(url+result, '_blank');
            }
            // error: function(blob) {
            //   console.log(blob);
            // }
          });
        }
      });
    });
  });
  $(function() {
    $("#btnSave").click(function() {
      //console.log('test');
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
  // var doc = new jsPDF();
  // var specialElementHandlers = {
  //   '#editor': function(element, renderer) {
  //     return true;
  //   }
  // };

  // $('#btnSavePdf').click(function() {
  //   doc.fromHTML($('#template').html(), 15, 15, {
  //     'width': 170,
  //     'elementHandlers': specialElementHandlers
  //   });
  //   doc.save('sample-file.pdf');
  // });
</script>
</body>

</html>