@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Role</h1>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Role Management</li> 
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

                <form method="POST" action="{{ route('admin.add-role.post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label>Name</label>
                      <input type="text" name="name" value="{{old('name')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>                                      
                    
                   <div class="row form-group">
                        <div class="col-md-6 ">
                          <input type="submit" class="btn btn-primary" name="" value="Save" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection