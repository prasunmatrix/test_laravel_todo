@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Add User</h1>
  <ol class="breadcrumb mb-4">
    <!--  <li class="breadcrumb-item active">New Permission</li> -->
  </ol>
  <div class="container-fluid px-4">

    <div class="card mt-4">
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

        <form method="POST" action="{{ route('admin.add-user.post') }}" enctype="multipart/form-data" id="userAdd" autocomplete="off">
          @csrf
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" id="full_name" value="{{old('name')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('name') }}</span>
          </div>


          <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" id="email" value="{{old('email')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('email') }}</span>
          </div>


          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" id="password" value="{{old('password')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('password') }}</span>
          </div>

          <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('password_confirmation') }}</span>
          </div>

          <div class="row">
            <div class="col-md-6">
              <input type="submit" class="btn btn-primary" name="save_user" value="Save" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection