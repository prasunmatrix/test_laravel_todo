@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Edit User</h1>
  <ol class="breadcrumb mb-4">
    <!-- <li class="breadcrumb-item active">Update Subadmin</li> -->
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

        <form method="POST" action="{{ route('admin.update.user',$subadmin->id ) }}" enctype="multipart/form-data" id="userEdit">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" id="full_name" value="{{ $subadmin->name }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('name') }}</span>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" id="email" value="{{ $subadmin->email }}" required class=" form-control" />
            <span style="color:red;">{{ $errors->first('email') }}</span>
          </div>
          <div class="col-md-3 mb-3">
            <label>Status</label>
            <input type="checkbox" name="status" value="A"@if($subadmin->status=='A') checked @endif />
          </div>
          <div class="row">
            <div class="col-md-6">
              <input type="submit" class="btn btn-primary" name="update_subadmin" value="Update" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection