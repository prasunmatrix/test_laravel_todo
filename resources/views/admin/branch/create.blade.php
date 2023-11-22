@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Branch</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add a new Branch</li>
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

                <form method="POST" action="{{ route('admin.add-branch.post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label>District Name</label>
                      <select name="district" id="district" value="" required class="form-control">
                        <option value="">Select District</option>
                        @if(!empty($districtList))
                          @foreach($districtList as $district)
                          <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                          @endforeach
                        @endif  
                      </select>
                      <span style="color:red;">{{ $errors->first('district') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Block</label>
                      <input type="text" name="block" value="{{old('block')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('block') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Gram Panchayat</label>
                      <input type="text" name="gram_panchayat" id="gram_panchayat" value="{{old('gram_panchayat')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('gram_panchayat') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Name of the Bank</label>
                      <input type="text" name="bank_name" id="bank_name" value="{{old('bank_name')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('bank_name') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Name of the Branch</label>
                      <input type="text" name="branch_name" id="branch_name" value="{{old('branch_name')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('branch_name') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>IFSC Code</label>
                      <input type="text" name="ifsc_code" id="ifsc_code" value="{{old('ifsc_code')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('ifsc_code') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Branch Code</label>
                      <input type="text" name="branch_code" id="branch_code" value="{{old('branch_code')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('branch_code') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Latitude</label>
                      <input type="text" name="latitude" id="latitude" value="{{old('latitude')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('latitude') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Logitude</label>
                      <input type="text" name="logitude" id="logitude" value="{{old('logitude')}}" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('logitude') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>ATM ID</label>
                      <input type="text" name="atmid" id="atmid" value="{{old('atmid')}}"   class="form-control" />
                    </div>
                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1" />
                        </div>
                        <div class="col-md-3">
                            <label>ATM Available</label>
                            <input type="checkbox" name="atm_available" value="1" />
                        </div>
                        <div class="col-md-6 mb-6">
                          <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                          <input type="submit" class="btn btn-primary" name="save_branch" value="Save Branch" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection