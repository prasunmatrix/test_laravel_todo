<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;
use Auth;
use DataTables;

class SubadminController extends Controller
{
  /**
   * create a new instance of the class
   *
   * @return void
   */
  function __construct()
  {
    //$this->middleware('permission:manage-subadmin,admin', ['only' => ['index','postSettings']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $loginUser = Auth::guard('admin')->user();

    $this->data['page_title'] = 'Admin | Subadmin';
    //$this->data['admin'] = User::where('id', '!=', $loginUser->id)->orderBy('id', 'desc')->paginate(10);
    return view('admin.subadmin.index', $this->data);
  }
  public function userListTable(Request $request)
  {
    //dd('test');
    $loginUser = Auth::guard('admin')->user();
    $data = User::where('id', '!=', $loginUser->id)->orderBy('id', 'desc')->get();
    $finalResponse = Datatables::of($data)
      ->addColumn('status', function ($model) {
        $statuslink = route('admin.reset-user-status', encrypt($model->id));
        if ($model->status == 'A') {
          $status = '<button type="button" class="btn btn-block btn-success btn-xs changeStatus" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '">Active</button> ';
        } else {
          $status = '<button type="button" class="btn btn-block btn-warning btn-xs changeStatus" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '">Inactive</button> ';
        }
        return $status;
      })
      ->addColumn('action', function ($model) {
        $editlink = route('admin.edit-user', encrypt($model->id));
        $deletelink = route('admin.user.delete', $model->id);
        $actions = '<a href=' . $editlink . ' class="btn btn-success">Edit</a> ';
        $actions .= '| <a href="javascript:void(0)" data-redirect-url="' . $deletelink . '" class="btn btn-danger delete-alert-user" id="button">Delete</a>';
        return $actions;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
    return $finalResponse;
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->data['page_title'] = 'Admin | Add User';
    //$this->data['roles'] = Role::pluck('name','name')->all();
    return view('admin.subadmin.create', $this->data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|confirmed',
    ]);

    $input = $request->all();
    //dd($input);

    $input['password'] = Hash::make(trim($request->get('password')));

    $user = User::create($input);
    //$user->assignRole($request->input('roles'));

    return redirect()->route('admin.user')
      ->with('success', 'User created successfully.');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $page_title = 'Admin | User';
    $id = decrypt($id);
    $subadmin = User::find($id);
    // $roles = Role::pluck('name', 'name')->all();
    // $userRole = $subadmin->roles->pluck('name', 'name')->all();    
    return view('admin.subadmin.edit', compact('page_title', 'subadmin'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $input = $request->all();
    $status = $request->status == 'A' ? 'A' : 'I';
    //dd($status);
    //$input=$status;
    // $user = User::find($id);
    // $user->update($input);
    $categoryUpdate = User::where('id', $id)->update([
      'name' => $request->name,
      'email' => $request->email,
      'status' => $status
    ]);
    // DB::table('model_has_roles')
    //     ->where('model_id', $id)
    //     ->delete();

    //$user->assignRole($request->input('roles'));

    return redirect()->route('admin.user')
      ->with('success', 'User updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::find($id)->delete();

    return redirect()->route('admin.user')
      ->with('success', 'User deleted successfully.');
  }
  public function resetuserStatus(Request $request)
  {

    $response['has_error'] = 1;
    $response['msg'] = "Something went wrong.Please try again later.";

    $userId = decrypt($request->encryptCode); // get user-id After Decrypt with salt key.

    $userObj = User::findOrFail($userId);
    $updateStatus = $userObj->status == 'A' ? 'I' : 'A';
    $userObj->status = $updateStatus;
    //$userObj->updated_at = Carbon::now();
    //$userObj->updated_by = Auth::guard('admin')->user()->id;
    $saveResponse = $userObj->save();
    if ($saveResponse) {
      $response['has_error'] = 0;
      $response['msg'] = "Succressfuuly changed status.";
    }
    return $response;
  }
}
