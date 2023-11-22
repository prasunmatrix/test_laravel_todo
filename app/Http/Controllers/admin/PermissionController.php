<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
       $this->middleware('permission:manage-permission,admin', ['only' => ['index','store','create', 'edit','update', 'destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['page_title'] = 'Admin | Permission';
        //$this->data['permission'] = Permission::orderBy('id','DESC')->paginate(10);
        $this->data['permission'] = Permission::orderBy('id','DESC')->get();
        return view('admin.permission.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     

        $this->data['page_title'] = 'Admin | Permission';
        return view('admin.permission.create', $this->data);
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
            'name' => 'required|unique:permissions,name',
        ]);
    
        Permission::create(['name' => $request->input('name')]);
    
        return redirect()->route('admin.permissionlist')
            ->with('success', 'Permission created successfully.');
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['page_title'] = 'Admin | Permission';
        $this->data['permission'] = Permission::find($id);
        return view('admin.permission.edit', $this->data);
       
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
            'name' => 'required'
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
        
         return redirect()->route('admin.permissionlist')
            ->with('success', 'Permission created successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Permission::find($id)->delete();        
        return redirect()->route('admin.permissionlist')
            ->with('success', 'Permission deleted successfully.');
    }
}