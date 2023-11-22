@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Permission</h1>
    <ol class="breadcrumb mb-4">
        <!-- <li class="breadcrumb-item active">Permission</li> -->
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

                <form method="POST" action="{{ route('admin.update.permission',$permission->id ) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Permission Name</label>
                        <input type="text" name="name" value="{{ $permission->name }}" required class="form-control" />
                        <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>                   
                
                    <div class="row">                                             
                        <div class="col-md-6">                          
                          <input type="submit" class="btn btn-primary" name="update_permission" value="Update" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection