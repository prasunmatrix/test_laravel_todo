@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">User</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">User Management</li>
  </ol>

  <div class="card mt-4">
    <div class="card-header">
      User Listing <a href="{{ url('admin/add-user') }}" class="btn btn-primary btn-sm float-end">
        Add User </a>
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
      <table class="table table-bordered" id="datatablesSimple">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          @foreach( $admin as $val )

          <tr>
            <td> {{ $i }} </td>
            <td> {{ $val->name }} </td>
            <td> {{ $val->email }} </td>
            <td> {{ $val->status =='A' ? 'Active':'Inactive'}} </td>
            <td> <a href="{{ url('admin/edit-user/'. $val->id) }}" class="btn btn-success"> Edit </a> | <a href="{{ url('admin/delete-user/'. $val->id) }}" class="btn btn-danger" onclick="return confirm('Are you want to delete this user ?');"> Delete </a>
          </tr>
          <?php $i++ ?>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection