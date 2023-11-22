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
    //dd($letestNews->news_date);
    $letestNewsDate = date("D, d M Y", strtotime($letestNews->news_date));
    $letestNewsPageData=Page::where('pages.status','=','1')->where('news_id',$letestNews->id)->orderBy('page_number','ASC')->first();
    // $lastNewsData=News::select('news.news_date','pages.*')->join('pages','news.id','=','pages.news_id')->where('news.news_date','<=',$current_date)->orderBy('news.news_date', 'DESC')->where('news.published','=','1')->where('pages.status','=','1')->get();
    //dd(\DB::getQueryLog());
    //dd($letestNewsPageData);
    $letestNewsPageALLData=Page::where('status','=','1')->where('news_id',$letestNews->id)->orderBy('page_number','ASC')->get();
    //dd($letestNewsPageALLData);
    return view('frontend.home')
    ->with('letestNewsPageData',$letestNewsPageData)
    ->with('letestNewsPageALLData',$letestNewsPageALLData)
    ->with('letestNewsDate',$letestNewsDate);
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
    $newsCount=News::where('news_date',$dateText)->where('published','=','1')->count();
    //dd($newsCount);
    if($newsCount>0)
    {
      $datePickuptNews=News::where('news_date',$dateText)->where('published','=','1')->first();
      //dd($datePickuptNews);
      if(isset($datePickuptNews))
      {
        $datePickuptNewsPageData=Page::where('status','=','1')->where('news_id',$datePickuptNews->id)->orderBy('page_number','ASC')->first();
        $changeDate=date("D, d M Y", strtotime($dateText));
        $datePickuptNewsPageALLData=Page::where('status','=','1')->where('news_id',$datePickuptNews->id)->orderBy('page_number','ASC')->get();  
        if(isset($datePickuptNewsPageData))
        {
          $arr=array('status'=>1,'datePickuptNewsPageData'=>$datePickuptNewsPageData,'datePickuptNewsPageALLData'=>$datePickuptNewsPageALLData,'changeDate'=>$changeDate);
          echo json_encode($arr);  
        }
        else
        {
          $arr=array('status'=>0,'error'=>'No record found!');
          return json_encode($arr);
        }
      }
    }
    else
    {
      $arr=array('status'=>0,'error'=>'No record found!');
      return json_encode($arr);
    }
    // $pageData=Page::where('id',$request->id)->first();
    // $pageData->template;
    // $arr=array('status'=>1,'templateData'=>$pageData->template);
    //dd($arr);
    //echo json_encode($arr);
    //return json_encode($arr);
  }
}
