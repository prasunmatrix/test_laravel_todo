<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - SB Admin</title>
  <link href="{{asset('assets/admin/css/styles.css')}}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                  <!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
                  @foreach ($errors->all() as $error)
                  <span>{{ $error }}</span><br />
                  @endforeach
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable __web-inspector-hide-shortcut__" style="text-align: center;">
                  <!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
                  {{ Session::get('success') }}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                  <!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
                  {{ Session::get('error') }}
                </div>
                @endif
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Recover Password</h3>
                </div>
                <div class="card-body">
                  <form action="{{ route('admin.reset-password') }}" method="post" id="login_table">
                    @csrf
                    <input type="hidden" name="tok3n" value="{{ $tok3n }}">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="password" type="password" name="password" placeholder="New Password" required />
                      <label for="inputEmail">New Password</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-type New Password" required />
                      <label for="inputEmail">Re-type New Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <a class="small" href="{{ route('admin.login') }}">Back To Login</a>
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                  </form>
                </div>
                <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{-- route('admin.register') --}}">Need an account? Sign up!</a></div>
                                    </div> -->
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website {{ date('Y') }}</div>
            <div>
              <!-- <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a> -->
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>