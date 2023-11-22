<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\{User,Todo};
use Hash;
use Auth;
use DataTables;
use Validator;

class TodoController extends Controller
{


  public function index(Request $request)
  {
    $loginUser = Auth::guard('admin')->user();

    $this->data['page_title'] = 'Admin | Todo';
    //$this->data['admin'] = User::where('id', '!=', $loginUser->id)->orderBy('id', 'desc')->paginate(10);
    return view('admin.todo.index', $this->data);
  }
  public function todoListTable(Request $request)
  {
    //dd('test');
    $loginUserId = Auth::guard('admin')->user()->id;
    $data = Todo::where('user_id', '=', $loginUserId)->orderBy('id', 'desc')->get();
    //dd($data);
    $finalResponse = Datatables::of($data)
      ->addColumn('status', function ($model) {
        $statuslink = route('admin.reset-todo-status', encrypt($model->id));
        if ($model->complete	 == '1') {
          $status = '<button type="button" class="btn btn-block btn-success btn-xs changeStatusTodo" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '">Complete</button> ';
        } else {
          $status = '<button type="button" class="btn btn-block btn-warning btn-xs changeStatusTodo" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '">Incomplete</button> ';
        }
        return $status;
      })
      ->addColumn('action', function ($model) {
        $editlink = route('admin.edit-todo', encrypt($model->id));
        $deletelink = route('admin.todo.delete', $model->id);
        $actions = '<a href=' . $editlink . ' class="btn btn-success">Edit</a> ';
        $actions .= '| <a href="javascript:void(0)" data-redirect-url="' . $deletelink . '" class="btn btn-danger delete-alert-todo" id="button">Delete</a>';
        return $actions;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
    return $finalResponse;
  }
  public function create()
  {
    $this->data['page_title'] = 'Admin | Add TODO';
    return view('admin.todo.create', $this->data);
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'task_name' => 'required',
      'task_description' => 'required',
    ]);

    $task_name = trim($request->post('task_name'));
    $task_description = trim($request->post('task_description'));
    //dd($task_description);
    $loginUserId = Auth::guard('admin')->user()->id;
    //dd($loginUserId);
    $todo = Todo::create([
      'user_id'=> $loginUserId,
      'task_name' => $task_name,
      'task_description' => $task_description,
    ]);    
    if ($todo != null) {

      $successMsg = 'Todo Added Successfully';
      return Redirect('admin/todo')
        ->withSuccess($successMsg);
    } else {
      $errMsg = array();
      $errMsg['error'] = 'Something went wrong, please try again';
      return Redirect::back()
        ->withErrors($errMsg)
        ->withInput();
    }
  }
  public function resettodoStatus(Request $request)
  {
    $response['has_error'] = 1;
    $response['msg'] = "Something went wrong.Please try again later.";

    $todoId = decrypt($request->encryptCode); // get user-id After Decrypt with salt key.
    $todoObj = Todo::findOrFail($todoId);
    $updateStatus = $todoObj->complete == '1' ? '0' : '1';
    $todoObj->complete = $updateStatus;
    //$userObj->updated_at = Carbon::now();
    //$userObj->updated_by = Auth::guard('admin')->user()->id;
    $saveResponse = $todoObj->save();
    if ($saveResponse) {
      $response['has_error'] = 0;
      $response['msg'] = "Succressfuuly changed status.";
    }
    return $response;
  }
  public function destroy($id)
  {
    Todo::find($id)->delete();

    return redirect()->route('admin.todo')
      ->with('success', 'Task deleted successfully.');
  }
  public function edit($id)
  {
    $page_title = 'Admin | Todo';
    $id = decrypt($id);
    $todo = Todo::find($id);
    // $roles = Role::pluck('name', 'name')->all();
    // $userRole = $subadmin->roles->pluck('name', 'name')->all();    
    return view('admin.todo.edit', compact('page_title', 'todo'));
  }
  public function update(Request $request, $id)
  {
    //dd($id);
    $validator = Validator::make(
      $request->all(),
      [
        'task_name' => 'required',
        'task_description' => "required",
      ],
      [
        'required' => 'The :attribute field is required',
        //'name.max' => 'name can be maximum :max chars long',
      ]
    );
    if ($validator->fails()) {
      return Redirect::back()
        ->withErrors($validator)
        ->withInput();
    } else {
      $task_name = $request->task_name;
      $task_description = $request->task_description;
      

      $todo = Todo::where('id', $id)->update([
        'task_name' => $task_name,
        'task_description' => $task_description
      ]);
      if ($todo != null) {

        $successMsg = 'Task Update Successfully';
        return Redirect('admin/todo')
          ->withSuccess($successMsg);
      } else {
        $errMsg = array();
        $errMsg['error'] = 'Something went wrong, please try again';
        return Redirect::back()
          ->withErrors($errMsg)
          ->withInput();
      }
    }
  }

}
