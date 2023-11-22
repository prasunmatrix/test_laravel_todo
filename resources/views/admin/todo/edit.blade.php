@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Edit TODO</h1>
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

        <form method="POST" action="{{ route('admin.update.todo',$todo->id ) }}" enctype="multipart/form-data" id="todoAdd">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label>Task Name</label>
            <input type="text" name="task_name" id="task_name" value="{{$todo->task_name}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('task_name') }}</span>
          </div>
          <div class="mb-3">
            <label>Task Description</label>
            <textarea name="task_description" id="task_description" required class="form-control">{{$todo->task_description}}</textarea>
            <span style="color:red;">{{ $errors->first('task_description') }}</span>
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