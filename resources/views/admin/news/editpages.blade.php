@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Edit Page</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Edit Page</li>
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

        <form method="POST" action="{{ route('admin.news.update-page',encrypt($page->id) ) }}" enctype="multipart/form-data" id="pageEdit" autocomplete="off">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="" />
          <div class="mb-3">
            <label>Page Number</label>
            <input type="text" name="page_number" id="page_number" value="{{$page->page_number}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('name') }}</span>
          </div>
          <div class="mb-3">
            <img src="{{ asset('uploads/page_preview/'.$page->page_preview) }}" alt="{{ ('page_preview') }}" width="100"
                                height="100"> </img><br/>
            <label>Page Preview</label>
            <input type="file" name="page_preview" id="page_preview" value="{{old('page_preview')}}"  class="form-control" />
            <input type="hidden" name="page_preview_old_image" id="page_preview_old_image" value="{{ $page->page_preview }}">
            <span style="color:red;">{{ $errors->first('page_preview') }}</span>
          </div>
          <div class="mb-3">
            <label>Template</label>
            <input type="text" name="template" id="template" value="{{$page->template}}" required class="form-control" />
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