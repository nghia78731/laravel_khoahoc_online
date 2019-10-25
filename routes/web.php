<?php

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

Route::get('/testa', function () {
    return view('view.pages.test');
});

Route::get('/testb', function () {
   return view('view.pages.test0');
});

Route::get('/', function () {
    return view('view.pages.content');
})->name('home');

//LOGIN AND REGISTER
Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@store')->name('login.store');
Route::get('/logout', 'LoginController@destroy')->name('login.destroy');
Route::get('/register', 'RegisterController@index')->name('register.index');
Route::post('/register', 'RegisterController@store')->name('register.store');

//CUSTOMER SETTING
Route::group(['prefix' => 'customer_setting'], function () {
    Route::get('/info', 'CustomerSettingController@index')->name('info.index');
    Route::post('/info', 'CustomerSettingController@store')->name('info.store');
    Route::post('/avatar', 'CustomerSettingController@changeAvatar')->name('info.avatar');
    Route::get('/account', 'CustomerSettingController@showAccount')->name('account.show');
    Route::post('/account', 'CustomerSettingController@changePassword')->name('account.change');
    Route::get('/profile/role_id={role_id}-user_id={user_id}', 'CustomerSettingController@showProfile')->name('profile.index');
});

//CLASS SETTING
Route::group(['prefix' => 'class_setting'], function () {
   Route::get('/info', 'ClassSettingController@index')->name('class_room.index');
   Route::post('/info', 'ClassSettingController@store')->name('class_room.store');
   Route::get('/detail', 'ClassSettingController@showClassDetail')->name('class_detail.index');
   Route::get('/detail/list_students/{class_id}', 'ClassSettingController@showListStudents')->name('list_students.index');
   Route::get('/detail/class_management/{class_id}', 'ClassSettingController@showClassManagement')->name('class_management.index');
   Route::post('/detail/class_management', 'ClassSettingController@addChapter')->name('chapter.store');
   Route::get('/detail/lession/{class_id}', 'ClassSettingController@showLession')->name('lession.index');
   Route::post('/detail/lession', 'ClassSettingController@addLession')->name('lession.store');
});

//Notification Course
Route::group(['prefix' => 'notification'], function () {
    Route::get('/send', 'SendNotification@index')->name('send');
   Route::post('/postMessage', 'SendNotification@store')->name('postMessage');
});

//COURSES SETTING
Route::group(['prefix' => 'courses_setting'], function () {
   Route::get('/info', 'CoursesSettingController@index')->name('course.index');
   Route::post('/info', 'coursesSettingController@store')->name('course.store');
   Route::get('/info/cost', 'CoursesSettingController@showCoursesCost')->name('courses_cost.index');
   Route::post('/info/cost', 'CoursesSettingController@addCoursesCost')->name('courses_cost.store');
   Route::get('/group-chat', 'GroupChatController@index')->name('group-chat.index');
   Route::get('/group-chat/room-{id}', 'GroupChatController@showChat')->name('chat.show');
   Route::post('/group-chat/sendMessage', 'GroupChatController@sendChat')->name('chat.send');
   Route::get('join-course/class_id={class_id}','JoinCourseController@index')->name('join_course.index');
   Route::get('join-course/class_id={class_id}/lession={lession_id}', 'JoinCourseController@showLession')->name('join_lession.index');
   Route::get('quiz/class_id={class_id}', 'QuizController@index')->name('quiz.index');
   Route::post('quiz/class_id', 'QuizController@store')->name('quiz.store');
   Route::get('quiz/finish/quiz_id={quiz_id}}', 'QuizController@showQuizFinish')->name('quiz_finish.index');
   Route::get('quiz/clear_quiz={quiz_id}/class_id={class_id}', 'QuizController@clearQuizResult')->name('clear_quiz_result.store');
});


//ADMIN BACKEND
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('/add-class-type', 'AdminClassTypeController@index')->name('class_type.index');
    Route::post('/add-class-type', 'AdminClassTypeController@store')->name('class_type.store');
    Route::get('/show-class-type', 'AdminClassTypeController@listClassType')->name('class_type.list');
    Route::get('/show-class-type/delete/{id}', 'AdminClassTypeController@destroy')->name('class_type.destroy');

    Route::get('/add-class', 'AdminClassController@index')->name('class.index');
    Route::post('/add-class', 'AdminClassController@store')->name('class.store');
    Route::get('/show-class', 'AdminClassController@listClass')->name('class.list');
});

//SOCIALITE LOGIN FACEBOOK
Route::get('/auth/facebook', 'SocialAuthController@redirectToProvider')->name('facebook.index');
Route::get('/auth/facebook/callback', 'SocialAuthController@handleProviderCallback');

//ONLINE PAYMENT
Route::post('/payment/', 'OnlinePaymentController@index')->name('online_payment.index');
Route::post('/payment/he', 'OnlinePaymentController@store')->name('online_payment.store');
Route::get('/payment/return', 'OnlinePaymentController@showReturnRegisterClass')->name('return_payment_class.index');



