<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{News, Page};
use Illuminate\Support\Facades\File;
use Validator;
use Redirect;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  // public function index()
  // {
  //   return view('home');
  // }
  public function index()
  {
    $current_date=date('Y-m-d');
    //dd($current_date);
    //\DB::enableQueryLog();
    $letestNews=News::where('news_date','<=',$current_date)->orderBy('news_date', 'DESC')->where('published','=','1')->first();
    //dd($lastNews->id);
    $letestNewsPageData=Page::where('pages.status','=','1')->where('news_id',$letestNews->id)->orderBy('page_number','ASC')->first();
    // $lastNewsData=News::select('news.news_date','pages.*')->join('pages','news.id','=','pages.news_id')->where('news.news_date','<=',$current_date)->orderBy('news.news_date', 'DESC')->where('news.published','=','1')->where('pages.status','=','1')->get();
    //dd(\DB::getQueryLog());
    //dd($letestNewsPageData);
    $letestNewsPageALLData=Page::where('pages.status','=','1')->where('news_id',$letestNews->id)->orderBy('page_number','ASC')->get();
    //dd($letestNewsPageALLData);
    return view('frontend.home')
    ->with('letestNewsPageData',$letestNewsPageData)
    ->with('letestNewsPageALLData',$letestNewsPageALLData);
  }
  public function showPage(Request $request)
  {
    //dd($request->id);
    $pageData=Page::where('id',$request->id)->first();
    $pageData->template;
    $arr=array('status'=>1,'templateData'=>$pageData->template);
    //dd($arr);
    //echo json_encode($arr);
    return json_encode($arr);
  } 
  public function viewParticularDateData(Request $request)
  {
    //dd($request->dateText);
    $dateText=date("Y-m-d",strtotime($request->dateText));
    $newsCount=News::where('news_date',$dateText)->count();
    //dd($newsCount);
    if($newsCount>0)
    {

    }
    else
    {
      $arr=array('status'=>0,'error'=>'No record found!');
    }
    // $pageData=Page::where('id',$request->id)->first();
    // $pageData->template;
    // $arr=array('status'=>1,'templateData'=>$pageData->template);
    //dd($arr);
    //echo json_encode($arr);
    return json_encode($arr);
  }
}
