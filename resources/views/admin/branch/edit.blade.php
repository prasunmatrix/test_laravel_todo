@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Edit Branch</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Edit Branch</li>
  </ol>
  <div class="container-fluid px-4">

    <div class="card mt-4">
      <div class="card-body">

        <!-- @if(count($errors) > 0)
                                            <div class="alert alert-danger alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                @foreach ($errors->all() as $error)
                                                    <span>{{ $error }}</span><br/>
                                                @endforeach
                                            </div>
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

        <form method="POST" action="{{ route('admin.update.branch',$branch->id ) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label>District Name</label>
            <select name="district" id="district" value="" required class="form-control">
              <option value="">Select District</option>
              @if(!empty($districtList))
              @foreach($districtList as $district)
              <option value="{{ $district->id }}" @if($branch->district== $district->id) selected @endif>{{ $district->district_name }}</option>

              @endforeach
              @endif
            </select>
            <span style="color:red;">{{ $errors->first('district') }}</span>
          </div>

          <div class="mb-3">
            <label>Block</label>
            <input type="text" name="block" value="{{ ucfirst($branch->block) }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('block') }}</span>
          </div>

          <div class="mb-3">
            <label>Gram Panchayat</label>
            <input type="text" name="gram_panchayat" value="{{ $branch->gram_panchayat }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('gram_panchayat') }}</span>
          </div>

          <div class="mb-3">
            <label>Name of the Bank</label>
            <input type="text" name="bank_name" id="bank_name" value="{{ $branch->name_of_the_bank }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('bank_name') }}</span>
          </div>
          <div class="mb-3">
            <label>Name of the Branch</label>
            <input type="text" name="branch_name" id="branch_name" value="{{ $branch->name_of_the_branch }}" required class="form-control" />
            <!-- <span style="color:red;">{{ $errors->first('branch_name') }}</span> -->
            <span style="color:red;">{{ @$errors->all()[0] }}</span>

          </div>
          <div class="mb-3">
            <label>IFSC Code</label>
            <input type="text" name="ifsc_code" id="ifsc_code" value="{{ $branch->ifsc_code }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('ifsc_code') }}</span>
          </div>
          <div class="mb-3">
            <label>Branch Code</label>
            <input type="text" name="branch_code" id="branch_code" value="{{ $branch->branch_code }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('branch_code') }}</span>
          </div>
          <div class="mb-3">
            <label>Latitude</label>
            <input type="text" name="latitude" id="latitude" value="{{ $branch->latitude }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('latitude') }}</span>
          </div>
          <div class="mb-3">
            <label>Logitude</label>
            <input type="text" name="logitude" id="logitude" value="{{ $branch->longitude }}" required class="form-control" />
            <span style="color:red;">{{ $errors->first('longitude') }}</span>
          </div>
          <div class="mb-3">
            <label>ATM ID</label>
            <input type="text" name="atmid" id="atmid" value="{{ $branch->atm_id }}" class="form-control" />
          </div>
          <h6>Status Mode</h6>
          <div class="row">
            <div class="col-md-3">
              <label>Status</label>
              <input type="checkbox" name="status" value="1" @if($branch->status==1) checked @endif />
            </div>
            <div class="col-md-3">
              <label>ATM Available</label>
              <input type="checkbox" name="atm_available" value="1" @if($branch->atm_available==1) checked @endif />
            </div>
            <div class="col-md-6">
              <input type="submit" class="btn btn-primary" name="update_branch" value="Update" />
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