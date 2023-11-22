@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Branch</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Branch Management</li>
    </ol>

    <div class="card mt-4">
        <div class="card-header">
            Branch Listing <a href="{{ url('admin/add-branch') }}" class="btn btn-primary btn-sm float-end">
                Add Branch </a>
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
                        <th>ID</th>
                        <th>District</th>
                        <th>Block</th>
                        <th>Gram Panchayat</th>
                        <th>Name of the Branch</th>
                        <th>IFSC Code</th>
                        <th>Branch Code</th>
                        <th>Latitude</th>
                        <th>Logitude</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @if( count($branchDetails) > 0 )
                    @foreach( $branchDetails as $val )
                    <tr>
                        <td> {{ $val->id }} </td>
                        <td> {{ $val->district_name }} </td>
                        <td>{{ ucfirst($val->block) }}</td>
                        <td>{{ $val->gram_panchayat }}</td>
                        <td>{{ $val->name_of_the_branch }}</td>
                        <td>{{ $val->ifsc_code }}</td>
                        <td>{{ $val->branch_code }}</td>
                        <td>{{ $val->latitude }}</td>
                        <td>{{ $val->longitude }}</td>
                        <td> {{ $val->status ==1 ? 'Show':'Hidden'}} </td>
                        <td> <a href="{{ url('admin/edit-branch/'. $val->id) }}" class="btn btn-success"> Edit </a> | <a href="{{ url('admin/delete-branch/'. $val->id) }}" class="btn btn-danger" onclick="return confirm('Are you want to delete this branch ?');"> Delete </a>
                        </td>

                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection