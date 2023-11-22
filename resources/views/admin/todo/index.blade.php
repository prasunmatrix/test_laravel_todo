@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">TODO</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">TODO Management</li>
  </ol>

  <div class="card mt-4">
    <div class="card-header">
      TODO Listing <a href="{{ url('admin/add-todo') }}" class="btn btn-primary btn-sm float-end">
        Add TODO </a>
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
      <table class="table table-bordered" id="todo-table">
        <thead>
          <tr>
            <th>Sl.No.</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Mark As Complete</th>
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