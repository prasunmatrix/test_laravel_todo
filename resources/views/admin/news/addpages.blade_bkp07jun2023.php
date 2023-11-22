@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Add Pages</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Add Pages</li>
  </ol>
  <div class="container-fluid px-4">

    <div class="card mt-4">
      <div class="card-body">
        @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
          <!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
          @foreach ($errors->all() as $error)
          <span>{{ $error }}</span><br />
          @endforeach
        </div>
        @endif
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

        <form method="POST" action="{{ route('admin.news.add-pages-post',$id) }}" enctype="multipart/form-data" id="pageAdd" autocomplete="off">
          @csrf
          <input type="hidden" name="id" value="{{ $id }}" />
          <div class="mb-3">
            <label>Page Number</label>
            <input type="text" name="page_number" id="page_number" value="{{old('page_number')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('name') }}</span>
          </div>

          <div class="mb-3">
            <label>Template</label>
            <input type="text" name="template" id="template" value="{{old('template')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('file') }}</span>
          </div>
          <!-- <h6>Status Mode</h6> -->
          <div class="row">
            <div class="col-md-6">
              <input type="submit" class="btn btn-primary" name="save" value="Save" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('custom-scripts')


@endpush