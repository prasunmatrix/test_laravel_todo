@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Employee</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Employee Management</li>
  </ol>

  <div class="card mt-4">
    <div class="card-header">
      Employee Listing <a href="{{ url('admin/add-employee-leave') }}" class="btn btn-primary btn-sm float-end">
        Add Employee Leave </a>
    </div>
    <div class="card-body">
      <!-- @if( session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif -->
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
            <th>Sl No.</th>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Grade</th>
            <th>Phone</th>
            <th>Branch</th>
            <th>Post</th>
            <th>Role</th>
            <th>Employee Type</th>
            <th>Status</th>
                        <!--<th>Latitude</th>
                        <th>Logitude</th>
                        <th>Status</th>
                        <th>Action</th> -->

          </tr>
        </thead>
        <tbody>
          @php $count=1; @endphp
          @if( count($employee) > 0 )
          @foreach( $employee as $val )
          <tr>
            <td> {{ $count }} </td>
            <td> {{ $val->emp_id }} </td>
            <td>{{ ucfirst($val->name) }}</td>
            <td>{{ $val->grade }}</td>
            <td>{{ $val->phone }}</td>
            <td>{{ $val->branch	}}</td>
            <td>{{ $val->post }}</td>
            <td>{{ $val->role }}</td>
            <td>{{ $val->employee_type }}</td>
            <td> {{ $val->status ==1 ? 'Show':'Hidden'}} </td>
            <!-- <td> <a href="{{-- url('admin/edit-branch/'. $val->id) --}}" class="btn btn-success"> Edit </a> | <a href="{{-- url('admin/delete-branch/'. $val->id) --}}" class="btn btn-danger" onclick="return confirm('Are you want to delete this branch ?');"> Delete </a>
            </td> -->
          </tr>
          @php $count++; @endphp
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection