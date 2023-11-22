@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Update Photo Gallery</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Update Photo Gallery</li>
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

                <form method="POST" action="{{ route('admin.update.photogallery',$photogallery->id ) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $photogallery->title }}" class="form-control" />
                        <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Short Description</label>
                      <textarea name="short_desc" rows="5"  class="form-control textarea">{{ $photogallery->short_desc }}</textarea>
                      <span style="color:red;">{{ $errors->first('short_desc') }}</span>
                    </div>

                    <div class="mb-3">
                      <label>Long Description</label>
                      <textarea name="long_description" rows="5"  class="form-control textarea">{{ $photogallery->long_description }}</textarea>
                      <span style="color:red;">{{ $errors->first('long_description') }}</span>
                    </div>
                    
                    <div class="mb-3">
                      <label>Gallery Type/Place</label>
                      <select name="gallery_category_id" id="gallery_category_id"  class="form-control">
                        <option value="">Select Type/Place</option>
                        @foreach( $categoryList as $val )
                        <option value="{{ $val->id }}" @if($photogallery->gallery_category_id== $val->id) selected @endif>{{ $val->name}}</option>

                        @endforeach

                        
                      </select>
                      <span style="color:red;">{{ $errors->first('banner_place') }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <img src="{{ asset('uploads/gallery/'.$photogallery->image) }}" alt="{{ $photogallery->name }}" width="100"
                                height="100"> </img><br/>
                        <label>photogallery Image</label>
                        <input type="file" name="image" class="form-control" />
                        <input type="hidden" name="gallery_old_image" id="gallery_old_image" value="{{ $photogallery->image }}">
                        <span class="system required" style="color: red;">(Recommended Image Size: 800 &times; 600)*</span><br>
                    </div>
                     
                    
                    <div class="mb-3">
                      
                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1"@if($photogallery->status==1) checked @endif />
                        </div>
                        <div class="col-md-6">
                          
                          <input type="submit" class="btn btn-primary" name="update_gallery" value="Update" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
// $("#image").change(function() {
//     //readURL(this);
//     alert('galley_images');
//   });
</script>  
@endpush