@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Add News</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Add News</li>
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

        <form method="POST" action="{{ route('admin.add-news.post') }}" enctype="multipart/form-data" id="newsAdd" autocomplete="off">
          @csrf
          <div class="mb-3">
            <label>News Date</label>
            <input type="text" name="news_date" id="news_date" value="{{old('news_date')}}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('name') }}</span>
          </div>

          <!-- <div class="mb-3">
            <label>Slot</label>
            <select name="slot" id="slot" class="form-control">
              <option value="">Select Slot</option>
            <option value="M">Morning</option>
            <option value="E">Evening</option>  
            </select>            
            <span style="color:red;">{{ $errors->first('file') }}</span>
          </div> -->
          <!-- <h6>Status Mode</h6> -->
          <div class="row">
            <!-- <div class="col-md-3 mb-3">
              <label>Status</label>
              <input type="checkbox" name="status" value="1" />
            </div> -->
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