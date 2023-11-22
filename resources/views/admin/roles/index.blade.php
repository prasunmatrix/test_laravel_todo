@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Role</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Role Management</li>
    </ol>

    <div class="card mt-4">
        <div class="card-header">
            Role Listing <a href="{{ url('admin/add-role') }}" class="btn btn-primary btn-sm float-end">
                Add Role </a>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php $i=1; ?>
                    @foreach( $role as $val )
                    
                    <tr>
                        <td> {{ $i }} </td>
                        <td> {{ $val->name }} </td>
                        
                        
                        <td> <a href="{{ url('admin/edit-role/'. $val->id) }}" class="btn btn-success"> Edit </a> | <a href="{{ url('admin/delete-role/'. $val->id) }}" class="btn btn-danger" onclick="return confirm('Are you want to delete this Role ?');"> Delete </a>
                        </td>

                    </tr>
                     <?php $i++ ?>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection