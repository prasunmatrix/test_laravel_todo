<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\{News, Page};
use Illuminate\Support\Facades\File;
use Validator;
use Auth;
use Redirect;
use DataTables;
use Image;

class NewsController extends Controller
{
  /**
   * create a new instance of the class
   *
   * @return void
   */
  function __construct()
  {
    //$this->middleware('permission:manage-notice,admin', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $this->data['page_title'] = 'Admin | News';
    //$this->data['list'] = News::orderBy('news_date', 'desc')->paginate(10);
    return view('admin.news.index', $this->data);
  }
  public function newsListTable(Request $request)
  {
    //dd('test');
    $data = News::orderBy('news_date', 'desc')->get();
    $finalResponse = Datatables::of($data)
      ->addColumn('slot', function ($model) {
        if ($model->slot == 'M') {
          $slot = '<a href="javascript:void(0)" class="btn btn-success">Morning</a> ';
        } else {
          $slot = '<a href="javascript:void(0)" class="btn btn-success">Evening</a> ';
        }
        return $slot;
      })
      ->addColumn('action', function ($model) {
        $publishedlink = route('admin.news.published', encrypt($model->id));
        $editlink = route('admin.edit-news', encrypt($model->id));
        $deletelink = route('admin.news.delete', $model->id);
        $pages = route('admin.news.pages', encrypt($model->id));
        if ($model->published == '0') {
          $actions = '<a href=' . $publishedlink . ' class="btn btn-warning">Unpublished</a> ';
        } else {
          $actions = '<a href="javascript:void(0)" class="btn btn-success" style="pointer-events: none;cursor: default;">Published</a> ';
        }
        if ($model->published == '0') {
          $actions .= '| <a href=' . $editlink . ' class="btn btn-success">Edit</a> ';
          $actions .= '| <a href="javascript:void(0)" data-redirect-url="' . $deletelink . '" class="btn btn-danger delete-alert" id="button">Delete</a>';
        }
        $actions .= '| <a href=' . $pages . ' class="btn btn-success">Pages</a> ';
        return $actions;
      })
      ->rawColumns(['action', 'slot'])
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
    $this->data['page_title'] = 'Admin | News';
    return view('admin.news.create', $this->data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'news_date'     => 'required',
        //'slot' => 'required',
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
      $news_date = $request->news_date;
      $news_date = date("Y-m-d", strtotime($news_date));
      //$slot = $request->slot;
      $slot = 'M';
      //$count = News::where('news_date', $news_date)->where('slot', $slot)->count();
      $count = News::where('news_date', $news_date)->count();
      if ($count > 0) {
        //$errMsg = 'Same date with same slot already exists';
        //$request->session()->flash('error', 'Same date with same slot already exists');
        $request->session()->flash('error', 'Same date already exists');
        return Redirect::back();
      }
      $created_by = Auth::guard('admin')->user()->id;

      $news = News::create([
        'news_date' => $news_date,
        'slot' => $slot,
        'created_by' => $created_by
      ]);
      $lastId = $news->id;
      //dd($lastId);
      if ($news != null) {

        $successMsg = 'News Added Successfully,Please Create Your Pages';
        //return Redirect('admin/news')
          return Redirect('admin/pages/'.encrypt($lastId))
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

  public function edit($id)
  {
    $id = decrypt($id);
    $this->data['page_title'] = 'Admin | Edit News';
    $news = News::find($id);
    $this->data['news'] = $news;
    return view('admin.news.edit', $this->data);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'news_date' => 'required',
        //'slot' => "required",
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
      $news_date = $request->news_date;
      $news_date = date("Y-m-d", strtotime($news_date));
      //$slot = $request->slot;
      $slot = 'M';
      //$count = News::where('news_date', $news_date)->where('slot', $slot)->where('id', '!=', $id)->count();
      $count = News::where('news_date', $news_date)->where('id', '!=', $id)->count();
      if ($count > 0) {
        //$errMsg = 'Same date with same slot already exists';
        //$request->session()->flash('error', 'Same date with same slot already exists');
        $request->session()->flash('error', 'Same date already exists');
        return Redirect::back();
      }

      $updated_by = Auth::guard('admin')->user()->id;

      $news = News::where('id', $id)->update([
        'news_date' => $news_date,
        'slot' => $slot,
        'created_by' => $updated_by
      ]);
      if ($news != null) {

        $successMsg = 'News Update Successfully';
        return Redirect('admin/news')
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

  public function destroy($id)
  {
    News::find($id)->delete();
    $successMsg = "News deleted successfully!";
    return Redirect::back()
      ->withSuccess($successMsg);
  }
  public function pages(Request $request)
  {
    $this->data['page_title'] = 'Admin | Pages';
    $id = $request->id;
    $newsId = decrypt($id);
    $checkpublished = News::where('id', $newsId)->first();
    $this->data['id'] = $id;
    $this->data['checkpublished'] = $checkpublished;
    return view('admin.news.pages', $this->data);
  }
  public function pagesListTable(Request $request, $encryptCode)
  {
    $id = decrypt($encryptCode);
    //dd($id);
    $data = Page::where('news_id', $id)->orderBy('page_number', 'asc')->get();
    $data1 = News::where('id', $id)->first();
    $finalResponse = Datatables::of($data, $data1)
      ->addColumn('status', function ($model) use ($data1) {
        $statuslink = route('admin.reset-pages-status', encrypt($model->id));
        if ($data1->published == '1') {
          if ($model->status == '1') {
            $status = '<button type="button" class="btn btn-block btn-success btn-xs changeStatusPages" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '" style="pointer-events: none;cursor: default;">Active</button> ';
          } else {
            $status = '<button type="button" class="btn btn-block btn-warning btn-xs changeStatusPages" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '" style="pointer-events: none;cursor: default;">Inactive</button> ';
          }
        } else {
          if ($model->status == '1') {
            $status = '<button type="button" class="btn btn-block btn-success btn-xs changeStatusPages" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '">Active</button> ';
          } else {
            $status = '<button type="button" class="btn btn-block btn-warning btn-xs changeStatusPages" data-redirect-url=' . $statuslink . ' id="status' . $model->id . '">Inactive</button> ';
          }
        }
        return $status;
      })
      ->addColumn('action', function ($model) use ($data1) {
        $editlink = route('admin.news.edit-pages', encrypt($model->id));
        $deletelink = route('admin.news.delete-pages', ['id' => $model->id]);
        $pagepreview = route('admin.news.pages-preview', ['encryptCode' => encrypt($model->id)]);
        if ($data1->published == '0') {
          $actions = ' <a href=' . $editlink . ' class="btn btn-success">Edit</a> ';
          $actions .= '| <a href="javascript:void(0)" data-redirect-url="' . $deletelink . '" class="btn btn-danger delete-alert-page" id="button">Delete</a>';
        }
        if ($data1->published == '0') {
          $actions .= '| <a href=' . $pagepreview . '  class="btn btn-success" target="_blank">Page Preview</a>';
        } else {
          $actions = '<a href=' . $pagepreview . '  class="btn btn-success" target="_blank">Page Preview</a>';
        }
        return $actions;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
    return $finalResponse;
  }
  public function addPages(Request $request)
  {
    $this->data['page_title'] = 'Admin | Add Pages';
    $id = $request->id;
    $this->data['id'] = $id;
    return view('admin.news.addpages', $this->data);
  }
  // public function editorUpload(Request $request)
  // {
  //   if ($request->hasFile('upload')) {
  //     $originName = $request->file('upload')->getClientOriginalName();
  //     $fileName = pathinfo($originName, PATHINFO_FILENAME);
  //     // $extension = $request->file('upload')->getClientOriginalExtension();
  //     $extension = 'webp';
  //     $fileName = $fileName . '_' . time() . '.' . $extension;

  //     Image::make($request->file('upload'))->encode('webp', 90)->save(public_path('front/fromfront/'  .  $fileName));

  //     // $request->file('upload')->move(public_path('front/fromfront'), $fileName);

  //     $CKEditorFuncNum = $request->input('CKEditorFuncNum');
  //     $url = asset('front/fromfront/' . $fileName);
  //     $msg = 'Image uploaded successfully';
  //     // $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";


  //     // @header('Content-type: text/html; charset=utf-8'); 
  //     // echo $response;
  //     echo $url;
  //   }
  // }
  public function editorUpload(Request $request)
  {
    if ($request->hasFile('upload')) {
      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      // $extension = $request->file('upload')->getClientOriginalExtension();
      if ($request->file('upload')->getClientOriginalExtension() == 'jpg' || $request->file('upload')->getClientOriginalExtension() == 'jpeg' || $request->file('upload')->getClientOriginalExtension() == 'png' || $request->file('upload')->getClientOriginalExtension() == 'gif' || $request->file('upload')->getClientOriginalExtension() == 'tif' || $request->file('upload')->getClientOriginalExtension() == 'bmp' || $request->file('upload')->getClientOriginalExtension() == 'webp' || $request->file('upload')->getClientOriginalExtension() == 'ico' || $request->file('upload')->getClientOriginalExtension() == 'psd') {
        $extension = 'webp';
        // $extension = $request->file('upload')->getClientOriginalExtension();
      } else {
        $extension = $request->file('upload')->getClientOriginalExtension();
      }

      $fileName = $fileName . '_' . time() . '.' . $extension;

      if ($request->file('upload')->getClientOriginalExtension() == 'jpg' || $request->file('upload')->getClientOriginalExtension() == 'jpeg' || $request->file('upload')->getClientOriginalExtension() == 'png' || $request->file('upload')->getClientOriginalExtension() == 'gif' || $request->file('upload')->getClientOriginalExtension() == 'tif' || $request->file('upload')->getClientOriginalExtension() == 'bmp' || $request->file('upload')->getClientOriginalExtension() == 'webp' || $request->file('upload')->getClientOriginalExtension() == 'ico' || $request->file('upload')->getClientOriginalExtension() == 'psd') {

        Image::make($request->file('upload'))->encode('webp', 90)->save(public_path('front/fromfront/'  .  $fileName));
        // $request->file('upload')->move(public_path('front/fromfront'), $fileName);

        $msg = 'Image uploaded successfully';
      } else {
        $request->file('upload')->move(public_path('front/fromfront'), $fileName);
        $msg = 'File uploaded successfully';
      }


      $url = asset('front/fromfront/' . $fileName);


      echo $url;
    }
  }
  public function addPagesPost(Request $request, $encryptCode)
  {

    $validator = Validator::make(
      $request->all(),
      [
        'page_number'     => 'required|integer',
        'template' => 'required',
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
      $id = decrypt($encryptCode);
      //dd($id);
      //\DB::enableQueryLog();
      $count = page::where('news_id', $id)->where('page_number', $request->page_number)->count();
      //dd(\DB::getQueryLog());
      if ($count > 0) {
        //$errMsg = 'Same date with same slot already exists';
        $request->session()->flash('error', 'Same news page number already exists');
        return Redirect::back();
      }
      $page_number = $request->page_number;
      $template = $request->template;
      $page_add_date = date('Y-m-d');
      $created_by = Auth::guard('admin')->user()->id;

      $page = Page::create([
        'news_id' => $id,
        'page_number' => $page_number,
        'page_add_date' => $page_add_date,
        'template' => $template,
        'created_by' => $created_by
      ]);
      if ($page != null) {

        $successMsg = 'Page Added Successfully';
        return Redirect('admin/pages/' . $encryptCode)
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
  public function resetPagesStatus(Request $request)
  {
    $response['has_error'] = 1;
    $response['msg'] = "Something went wrong.Please try again later.";

    $pageId = decrypt($request->encryptCode); // get user-id After Decrypt with salt key.
    $pageObj = Page::findOrFail($pageId);
    $updateStatus = $pageObj->status == '1' ? '0' : '1';
    $pageObj->status = $updateStatus;
    //$userObj->updated_at = Carbon::now();
    //$userObj->updated_by = Auth::guard('admin')->user()->id;
    $saveResponse = $pageObj->save();
    if ($saveResponse) {
      $response['has_error'] = 0;
      $response['msg'] = "Succressfuuly changed status.";
    }
    return $response;
  }
  public function destroyPage($id)
  {
    Page::find($id)->delete();
    $successMsg = "Page deleted successfully!";
    return Redirect::back()
      ->withSuccess($successMsg);
  }
  public function editPage($encryptCode)
  {
    $this->data['page_title'] = 'Admin | Edit Page';
    $id = decrypt($encryptCode);
    //dd($id);
    $page = Page::find($id);
    $this->data['page'] = $page;
    return view('admin.news.editpages', $this->data);
  }
  public function updatePage(Request $request, $encryptCode)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'page_number' => 'required|integer',
        'template' => "required",
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

      $id = decrypt($encryptCode);
      $pagefind = Page::find($id);
      //\DB::enableQueryLog();
      $count = Page::where('news_id', $pagefind->news_id)->where('page_number', $request->page_number)->where('id', '!=', $id)->count();
      //dd(\DB::getQueryLog());
      //dd($count);
      if ($count > 0) {
        //$errMsg = 'Same date with same slot already exists';
        $request->session()->flash('error', 'Same news page number already exists');
        return Redirect::back();
      }
      $page_number = $request->page_number;
      $template = $request->template;

      $updated_by = Auth::guard('admin')->user()->id;

      $page = Page::where('id', $id)->update([
        'page_number' => $page_number,
        'template' => $template,
        'created_by' => $updated_by
      ]);
      if ($page != null) {

        $successMsg = 'Page Update Successfully';
        return Redirect('admin/pages/' . encrypt($pagefind->news_id))
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
  public function pagesPreview(Request $request, $encryptCode)
  {
    $this->data['page_title'] = 'Admin | Page Preview';
    $id = decrypt($encryptCode);
    $page = Page::find($id);
    $this->data['page'] = $page;
    return view('admin.news.pagepreview', $this->data);
  }
  public function published(Request $request, $encryptCode)
  {
    $id = decrypt($encryptCode);
    //dd($id);
    $newspublished = News::where('id', $id)->update([
      'published' => 1
    ]);
    $successMsg = "News successfully published!";
    return Redirect::back()
      ->withSuccess($successMsg);
  }
}
