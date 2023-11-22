<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\SubadminController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\TodoController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**----------------------------Frontend Routes ----------------------------------- */
//  Route::get('/', [HomeController::class, 'index'])->name('home');
//  Route::get('/showpage', [HomeController::class, 'showPage'])->name('showpage');
//  Route::get('/viewparticulardatedata', [HomeController::class, 'viewParticularDateData'])->name('viewparticulardatedata');
//  Route::get('/pagechange', [HomeController::class, 'pageChange'])->name('pagechange');
//  Route::get('/pagechangepreviousdate', [HomeController::class, 'pageChangePreviousDate'])->name('pagechangepreviousdate');
//  Route::get('/showpageprevious', [HomeController::class, 'showPagePrevious'])->name('showpageprevious');
//  Route::get('/pdfview', [HomeController::class, 'pdfView'])->name('pdfview');
//  Route::get('/pdfpreview', [HomeController::class, 'pdfPreview'])->name('pdfpreview');

/*-----------------------Admin Routes----------------------------------------------- */
Route::group(["prefix" => "admin", "namespace" => "admin", 'as' => 'admin.'], function () {
  Route::get('/', [AdminController::class, 'index'])->name('login');
  Route::post('/verifylogin', [AdminController::class, 'verifyLogin'])->name('verifylogin');
  Route::get('/forget-password', [AdminController::class, 'forgetPassword'])->name('forget-password');
  Route::post('/forget-password', [AdminController::class, 'postForgetPassword'])->name('post-forget-password');
  Route::get('/password-reset/{token}',[AdminController::class, 'getResetPassword'])->name('form-reset-password');
  Route::post('/password-reset',[AdminController::class, 'postResetPassword'])->name('reset-password');
  Route::get('/register', [AdminController::class, 'register'])->name('register');
  Route::post('/register', [AdminController::class, 'postRegister'])->name('register.post');
  Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboardView'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('changePassword');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('changePassword');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add-category.post');
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::put('/update-category/{category_id}', [CategoryController::class, 'update'])->name('update.put');
    Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete'])->name('delete');
    Route::get('/cms', [CmsManageController::class, 'index'])->name('cmslist');
    Route::get('/add-cms', [CmsManageController::class, 'create'])->name('add-cms');
    Route::post('/add-cms', [CmsManageController::class, 'store'])->name('add-cms.post');
    Route::get('/edit-cms/{cms_id}', [CmsManageController::class, 'edit'])->name('edit-cms');
    Route::put('/update-cms/{cms_id}', [CmsManageController::class, 'update'])->name('update.cms');
    Route::get('/delete-cms/{cms_id}', [CmsManageController::class, 'delete'])->name('delete');
    Route::get('/photogallery', [PhotoGalleryController::class, 'index'])->name('photogallerylist');
    Route::get('/add-photogallery', [PhotoGalleryController::class, 'create'])->name('add-photogallery');
    Route::post('/add-photogallery', [PhotoGalleryController::class, 'store'])->name('add-photogallery.post');
    Route::get('/edit-photogallery/{photogallery_id}', [PhotoGalleryController::class, 'edit'])->name('edit-photogallery');
    Route::put('/update-photogallery/{photogallery_id}', [PhotoGalleryController::class, 'update'])->name('update.photogallery');
    Route::post('/gallery-image-delete', [PhotoGalleryController::class, 'galleryImageDelete'])->name('gallery_image_delete');
    Route::get('/delete-photogallery/{photogallery_id}', [PhotoGalleryController::class, 'delete'])->name('delete');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'postSettings'])->name('post-settings');
    Route::post('/settings-social', [SettingsController::class, 'postSettingsSocial'])->name('post-settings-social');

    //Permission Route
    Route::get('/permission', [PermissionController::class, 'index'])->name('permissionlist');
    Route::get('/add-permission', [PermissionController::class, 'create'])->name('add-permission');
    Route::post('/add-permission', [PermissionController::class, 'store'])->name('add-permission.post');
    Route::get('/edit-permission/{permission_id}', [PermissionController::class, 'edit'])->name('edit-permission');
    Route::put('/update-permission/{permission_id}', [PermissionController::class, 'update'])->name('update.permission');
    Route::get('/delete-permission/{permission_id}', [PermissionController::class, 'destroy'])->name('delete');

    //Role Route
    // Route::get('/role', [RoleController::class, 'index'])->name('rolelist');
    // Route::get('/add-role', [RoleController::class, 'create'])->name('add-role');
    // Route::post('/add-role', [RoleController::class, 'store'])->name('add-role.post');
    // Route::get('/edit-role/{role_id}', [RoleController::class, 'edit'])->name('edit-role');
    // Route::put('/update-role/{role_id}', [RoleController::class, 'update'])->name('update.role');
    // Route::get('/delete-role/{role_id}', [RoleController::class, 'destroy'])->name('delete');

    //User
    Route::get('/user', [SubadminController::class, 'index'])->name('user');
    Route::get('/user-list-table', [SubadminController::class, 'userListTable'])->name('user.list.table');
    Route::get('/add-user', [SubadminController::class, 'create'])->name('add-user');
    Route::post('/add-user', [SubadminController::class, 'store'])->name('add-user.post');
    Route::get('/edit-user/{subadmin_id}', [SubadminController::class, 'edit'])->name('edit-user');
    Route::put('/update-user/{subadmin_id}', [SubadminController::class, 'update'])->name('update.user');
    Route::get('/delete-user/{subadmin_id}', [SubadminController::class, 'destroy'])->name('user.delete');
    Route::get('/reset-user-status/{encryptCode}', [SubadminController::class, 'resetuserStatus'])->name('reset-user-status');

    //TODO

    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::get('/todo-list-table', [TodoController::class, 'todoListTable'])->name('todo.list.table');
    Route::get('/add-todo', [TodoController::class, 'create'])->name('add-todo');
    Route::post('/add-todo', [TodoController::class, 'store'])->name('add-todo.post');
    Route::get('/edit-todo/{edit_id}', [TodoController::class, 'edit'])->name('edit-todo');
    Route::put('/update-todo/{edit_id}', [TodoController::class, 'update'])->name('update.todo');
    Route::get('/delete-todo/{delete_id}', [TodoController::class, 'destroy'])->name('todo.delete');
    Route::get('/reset-todo-status/{encryptCode}', [TodoController::class, 'resettodoStatus'])->name('reset-todo-status');

    //Branch
    // Route::get('/branch', [BranchController::class, 'index'])->name('branchlist');
    // Route::get('/add-branch', [BranchController::class, 'create'])->name('add-branch');
    // Route::post('/add-branch', [BranchController::class, 'store'])->name('add-branch.post');
    // Route::get('/edit-branch/{branch_id}', [BranchController::class, 'edit'])->name('edit-branch');
    // Route::put('/update-branch/{branch_id}', [BranchController::class, 'update'])->name('update.branch');
    // Route::get('/delete-branch/{branch_id}', [BranchController::class, 'destroy'])->name('delete');


    // //Knowledge corner
    // Route::get('/knowledge-corner', [KnowledgeController::class, 'index'])->name('knowledge-corner');
    // Route::get('/add-knowledge-corner', [KnowledgeController::class, 'create'])->name('add-knowledge-corner');
    // Route::post('/add-knowledge-corner', [KnowledgeController::class, 'store'])->name('add-knowledge-corner.post');
    // Route::get('/edit-knowledge-corner/{id}', [KnowledgeController::class, 'edit'])->name('edit-knowledge-corner');
    // Route::put('/update-knowledge-corner/{id}', [KnowledgeController::class, 'update'])->name('update.knowledge-corner');
    // Route::get('/delete-knowledge-corner/{id}', [KnowledgeController::class, 'destroy'])->name('delete');

    // //Notice
    // Route::get('/notice', [NoticeController::class, 'index'])->name('notice');
    // Route::get('/add-notice', [NoticeController::class, 'create'])->name('add-notice');
    // Route::post('/add-notice', [NoticeController::class, 'store'])->name('add-notice.post');
    // Route::get('/edit-notice/{id}', [NoticeController::class, 'edit'])->name('edit-notice');
    // Route::put('/update-notice/{id}', [NoticeController::class, 'update'])->name('update.notice');
    // Route::get('/delete-notice/{id}', [NoticeController::class, 'destroy'])->name('delete');

    //News
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news-list-table', [NewsController::class, 'newsListTable'])->name('news.list.table');
    Route::get('/published/{id}', [NewsController::class, 'published'])->name('news.published');
    Route::get('/add-news', [NewsController::class, 'create'])->name('add-news');
    Route::post('/add-news', [NewsController::class, 'store'])->name('add-news.post');
    Route::get('/edit-news/{id}', [NewsController::class, 'edit'])->name('edit-news');
    Route::put('/update-news/{id}', [NewsController::class, 'update'])->name('update.news');
    Route::get('/delete-news/{id}', [NewsController::class, 'destroy'])->name('news.delete');
    //Pages
    Route::get('/pages/{id}',[NewsController::class, 'pages'])->name('news.pages');
    Route::get('/pages-list-table/{id}',[NewsController::class, 'pagesListTable'])->name('news.pages-list-table');
    Route::get('/add-pages/{id}',[NewsController::class, 'addPages'])->name('news.add-pages');
    Route::post('/editor-upload',[NewsController::class, 'editorUpload'])->name('editor-upload');
    Route::post('/add-pages/{encryptCode}',[NewsController::class, 'addPagesPost'])->name('news.add-pages-post');
    Route::get('/reset-pages-status/{encryptCode}', [NewsController::class, 'resetPagesStatus'])->name('reset-pages-status');
    Route::get('/edit-page/{encryptCode}', [NewsController::class, 'editPage'])->name('news.edit-pages');
    Route::put('/update-page/{encryptCode}', [NewsController::class, 'updatePage'])->name('news.update-page');
    Route::get('/delete-page/{id}', [NewsController::class, 'destroyPage'])->name('news.delete-pages');
    Route::get('/pages-preview/{encryptCode}',[NewsController::class, 'pagesPreview'])->name('news.pages-preview');
    Route::get('/print-preview/{encryptCode}',[NewsController::class, 'printPreview'])->name('news.print-preview');
    Route::post('/imagepdf',[NewsController::class, 'imagePdf'])->name('news.imagepdf');
    Route::get('pdf/{filename}', [NewsController::class, 'getPdf'])->name('news.pdf');

    //Event Calendar
    // Route::get('/event-calendar', [EventCalendarController::class, 'index'])->name('eventcalendar');
    // Route::post('/event-calendar', [EventCalendarController::class, 'postEventCalendar'])->name('post-eventcalendar');

    // //Organisation chart
    // Route::get('/organisation-chart', [OrganisationController::class, 'index'])->name('organisation-chart');
    // Route::get('/add-organisation-chart', [OrganisationController::class, 'create'])->name('add-organisation-chart');
    // Route::post('/add-organisation-chart', [OrganisationController::class, 'store'])->name('add-organisation-chart.post');
    // Route::get('/edit-organisation-chart/{id}', [OrganisationController::class, 'edit'])->name('edit-organisation-chart');
    // Route::put('/update-organisation-chart/{id}', [OrganisationController::class, 'update'])->name('update.organisation-chart');
    // Route::get('/delete-organisation-chart/{id}', [OrganisationController::class, 'destroy'])->name('delete');

    // //Tender
    // Route::get('/tender', [TenderController::class, 'index'])->name('tender');
    // Route::get('/add-tender', [TenderController::class, 'create'])->name('add-tender');
    // Route::post('/add-tender', [TenderController::class, 'store'])->name('add-tender.post');
    // Route::get('/edit-tender/{id}', [TenderController::class, 'edit'])->name('edit-tender');
    // Route::put('/update-tender/{id}', [TenderController::class, 'update'])->name('update.tender');
    // Route::get('/delete-tender/{id}', [TenderController::class, 'destroy'])->name('delete');

    // //Employee
    // Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    // Route::get('/add-employee-leave', [EmployeeController::class, 'createEmployeeLeave'])->name('add-employee-leave');
    // Route::post('/import-employee-leave', [EmployeeController::class, 'importEmployeeLeave'])->name('import-employee-leave');

    //Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallerylist');
    Route::get('/add-gallery', [GalleryController::class, 'create'])->name('add-gallery');
    Route::post('/add-gallery', [GalleryController::class, 'store'])->name('add-gallery.post');
    Route::get('/edit-gallery/{gallery_id}', [GalleryController::class, 'edit'])->name('edit-gallery');
    Route::put('/update-gallery/{gallery_id}', [GalleryController::class, 'update'])->name('update.gallery');
    Route::post('/gallery-imagedelete', [GalleryController::class, 'galleryImageDelete'])->name('gallery_imagedelete');
    Route::get('/delete-gallery/{gallery_id}', [GalleryController::class, 'delete'])->name('delete');

  });
}); 

Route::get('/', function () {
    return view('welcome');
});


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
