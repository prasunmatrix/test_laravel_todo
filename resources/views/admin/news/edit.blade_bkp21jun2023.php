@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Edit Notice</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Edit Notice</li>
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

        <form method="POST" action="{{ route('admin.update.news',$news->id ) }}" enctype="multipart/form-data" id="newsAdd" autocomplete="off">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label>News Date</label>
            <input type="text" name="news_date" id="news_date" value="{{ date('m/d/Y', strtotime($news->news_date)) }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('name') }}</span>
          </div>

          <!-- <div class="mb-3">
            <label>Slot</label>
            <select name="slot" id="slot" class="form-control">
              <option value="">Select Slot</option>
              <option value="M"@if($news->slot=='M') selected @endif>Morning</option>
              <option value="E"@if($news->slot=='E') selected @endif>Evening</option>
            </select>
            <span style="color:red;">{{ $errors->first('file') }}</span>
          </div> -->
          <!-- <h6>Status Mode</h6> -->
          <div class="row">
            <div class="col-md-6">
              <input type="submit" class="btn btn-primary" name="update" value="Update" />
            </div>
          </div>
        </form>

      </div>


    </div>

  </div>
</div>

@endsection