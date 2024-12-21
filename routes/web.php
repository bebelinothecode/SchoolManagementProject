<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentController2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function () 
{
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');
    Route::get('/librarybooks', [BookController::class, 'displayBooks'])->name('librarybooks');
    Route::get('/editbook/{id}', [BookController::class, 'edit'])->name('editbook');
    Route::put('/updatebook/{book}', [BookController::class, 'updateBook'])->name('updatebook');
    Route::delete('/delete', [BookController::class, 'deleteBook'])->name('deletebook');
    Route::get('/createbook', [BookController::class, 'showCreateBook']);
    Route::get('/students/{id}/print', [StudentController::class, 'printAdmissionLetter'])->name('student.print');
    Route::get("/showfees", [FeesController::class, 'show'])->name('fees.show');
    Route::post('/setfees', [FeesController::class, 'create'])->name('fees.set');
    Route::get("/collectfees", [FeesController::class, 'showcollectfees'])->name("fees.collect");
    Route::post('/feescollected',[FeesController::class, 'collectfees'])->name('fees.collected');
    Route::get('/fees/get-student-name', [FeesController::class, 'getStudentName'])->name('fees.get-student-name');
    Route::get('fees/defaulters', [FeesController::class, 'selectdefaulters'])->name('fees.defaulters');
    Route::post('/fees/defaulters', [FeesController::class, 'getdefaulters'])->name('defaulters.show');
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings.set');
    Route::post('/settings', [SettingsController::class, 'savesettings'])->name('settings.save');
    Route::post('/uploadbook',[BookController::class, 'uploadBook'])->name('upload.book');
    Route::get('/books/{book}/download', [BookController::class, 'download'])->name('books.download');
    // Route::post('/student/create',[StudentController2::class, 'store'])->name('student.create.new');
    // Route::post('/student/create/bro', [StudentController::class, 'store'])->name('student.save');
    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('parents', 'ParentsController');
    Route::resource('student', 'StudentController');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');

});

Route::group(['middleware' => ['auth','role:Teacher']], function () 
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
});

Route::group(['middleware' => ['auth','role:Parent']], function () 
{
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');
});

Route::group(['middleware' => ['auth','role:Student']], function () {

});

Route::get('/test',[FeesController::class,'test']);
