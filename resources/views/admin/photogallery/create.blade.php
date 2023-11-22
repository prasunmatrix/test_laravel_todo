@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Photo Gallery</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add a new photo gallery</li>
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

                <form method="POST" action="{{ route('admin.add-photogallery.post') }}" enctype="multipart/form-data">
                    @csrf
                    
                     <div class="mb-3">
                      <label>Gallery Type/Place</label>
                      <select name="gallery_category_id"   class="form-control">
                        <option value="">Select Type/Place</option>
                        @foreach( $categoryList as $val )
                        <option value="{{ $val->id }}">{{ $val->name}}</option>

                        @endforeach
                        <!--<option value="home_page_banner">Home Page Banner</option>
                        <option value="home_page_sidebar_gallery">Home Page Sidebar Gallery</option> 
                        <option value="home_page_middle_banner">Home Page Middle Banner</option> 
-->
                      </select>
                      <span style="color:red;">{{ $errors->first('category_id') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Image</label>
                      <input type="file" name="galley_images[]" value="" class="form-control" multiple />
                      <span class="system required" style="color: red;">(Recommended Image Size: 800 &times; 600)*</span><br>
                      <span style="color:red;">{{ $errors->first('galley_images') }}</span>
                      <span style="color:red;">{{ $errors->first('galley_images.*') }}</span>
                    </div>
                    

                    <div class="row">
                       
                        <div class="col-md-6">
                          <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                          <input type="submit" class="btn btn-primary" name="save_photogallery" value="Save Photogallery" />
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