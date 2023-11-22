<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{News, Page};
use Illuminate\Support\Facades\File;
use Validator;
use Redirect;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
    view()->composer(['layout.header'], function ($pageparam) {
      $current_date=date('Y-m-d');
      $letestNews=News::where('news_date','<=',$current_date)->orderBy('news_date', 'DESC')->where('published','=','1')->first();
      //dd($letestNews);  
      $letestNewsPageALLData=Page::where('pages.status','=','1')->where('news_id',$letestNews->id)->orderBy('page_number','ASC')->get();
      $pageparam->with('letestNewsPageALLData', $letestNewsPageALLData);
    });
    // view()->composer(['layout.header'], function ($currentDateparam) {
    //   $current_date=date('Y-m-d');
    //   $currentDate = date("D, d M Y", strtotime($current_date));
    //   $currentDateparam->with('currentDate',$currentDate);
    // });  
  }
}
