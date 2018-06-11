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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome',function(){
	return view('welcome');
})->name('welcome');

Route::get('/user/verify/{token}','Auth\RegisterController@verifyUser');

Route::get('/aboutUs','HomeController@aboutUs')->name('aboutUs');

Route::get('/contactUs','HomeController@contactUs')->name('contactUs');

Route::get('/photo','HomeController@photo')->name('photo');
Auth::routes();
/*
Route for submiting the user login details and authentication
*/
Route::post('/userlogin','LoginController@userLogin')->name('userLogin');

Route::get('/home', 'HomeController@index')->name('home');

/*
Route for default page
*/
Route::get('/default','HomeController@defaultPage')->name('default');

/*
Group Middleware using Auth middelware
*/
Route::group(['middleware'=>'auth'],function(){

		
	/*
	*mailing routes
	*/
	Route::get('/inbox','MailController@index')->name('inbox');

	Route::post('/getMailData','MailController@getData')->name('getMailData');

	Route::post('/deleteMailData','MailController@deleteData')->name('deleteMailData');

	Route::get('/sentBox','MailController@sentMails')->name('sentMail');

	Route::post('/sentMailData','MailController@sentData')->name('sentMailData');

	Route::get('/compose','MailController@composeMail')->name('composeMail');

	Route::post('/sendMail','MailController@create')->name('sendMail');
	

	/*
	*Change Password
	*/
	Route::get('/changePassword','HomeController@displayChangePassword')->name('displayChangePassword');
	
	Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

	/*
	*CRUD operation for Student
	*/
	Route::get('/student','StudentController@index')->name('student');

	/*
	*My Profile
	*/
	Route::get('/myProfile','HomeController@myProfile')->name('myProfile');

	Route::post('/change/image','HomeController@changeImage')->name('changeImage');

	/*
	*Routes to display student marks
	*/
	Route::get('/myMarks','StudentController@myMarks')->name('myMarks');

	Route::post('/getSemesterData','StudentController@getSemesterData');

	Route::post('/getResult','MarkController@getResult')->name('getResult');

	Route::get('/noMarks','StudentController@noMarks')->name('noMarks');
	
	Route::get('/getExamData','ExamController@getExam');	


	
});

Route::group(['middleware'=>['admin','auth']],function(){
	/*
	*CRUD operations for Course
	*/
	Route::get('/course','CourseController@index')->name('course');

	Route::post('/editCourse','CourseController@edit')->name('editCourse');

	Route::post('/addCourse','CourseController@store')->name('addCourse');

	Route::post('/deleteCourse','CourseController@destroy')->name('deleteCourse');


	/*
	*CRUD operations for Department
	*/
	Route::get('/department','DepartmentController@index')->name('department');

	Route::post('/editDepartment','DepartmentController@edit')->name('editDepartment');

	Route::post('/addDepartment','DepartmentController@store')->name('addDepartment');

	Route::post('/deleteDepartment','DepartmentController@destroy')->name('deleteDepartment');
	
	/*
	*Route for performing CRUD operation on city
	*/
	Route::get('/displayCity','CityController@index')->name('city');

	Route::post('/editCity','CityController@update')->name('editCity');

	Route::post('/addCity','CityController@store')->name('addCity');

	Route::post('/deleteCity','CityController@destroy')->name('deleteCity');

	Route::get('/getState','CityController@getStateData');

	/*
	*Route for performing CRUD operation on states
	*/

	Route::get('/displayStates','StateController@index')->name('state');

	Route::post('/editState','StateController@update')->name('editState');

	Route::post('/addState','StateController@store')->name('addState');

	Route::post('/deleteState','StateController@destroy')->name('deleteState');	


	/*
	*Route for adding Student Info Manually
	*/
	Route::get('/addStudent','StudentController@index')->name('addStudent');

	Route::post('/addStudentInfo','StudentController@store')->name('addStudentInfo');

	Route::get('/getState','StudentController@getState')->name('getState');

	Route::post('/getCity','StudentController@getCity')->name('getCity');

	Route::get('/getUserDetails','StudentController@getUser')->name('getUserDetails');

	Route::get('/getCourse','StudentController@getCourseData')->name('getCourse');

	/*
	*Display Student and CRUD operation by Admin
	*/
	Route::get('/smsStudent','StudentController@getStudent')->name('smsStudent');

	Route::post('/getUserInfo','UserController@getUserInfo');

	Route::get('/editStudent/{id}','StudentController@edit');

	Route::post('/updateStudent','StudentController@update')->name('updateStudent');

	Route::post('/deleteUserInfo','UserController@deleteUserInfo');

	/*
	*Displaying Faculty and CRUD operation by Admin
	*/

	Route::get('/smsFaculty','FacultyController@getFaculty')->name('smsFaculty');

	Route::get('/editFaculty/{id}','FacultyController@edit');

	Route::post('/updateFaculty','FacultyController@update')->name('updateFaculty');

	Route::get('/getDepartment','DepartmentController@getDepartment');

	/*
	*Displaying Admin Details
	*/
	Route::get('/smsAdmin','UserController@getAdmin')->name('smsAdmin');

	Route::get('/editAdmin/{id}','UserController@editAdmin');

	Route::post('/updateAdmin','UserController@updateAdmin')->name('updateAdmin');

	/*
	*CRUD operations on semester
	*/
	Route::get('/semester','SemesterController@create')->name('semester');

	Route::get('/getCourseForSemester','CourseController@getNotUsedCourse')->name('getCourseForSemester');

	Route::post('/addSemester','SemesterController@store')->name('addSemester');
	
	Route::get('/getDeleteCourseForSemester','CourseController@getUsedCourse')->name('getDeleteCourseForSemester');

	Route::post('/deleteSemester','SemesterController@destroy')->name('deleteSemester');

		/*
	*CRUD operations for subjects by Admin
	*/
	Route::get('/subject','SubjectController@index')->name('subject');

	Route::post('/addSubject','SubjectController@store')->name('addSubject');

	Route::post('/getSubjectForCourse','SubjectController@getSubject');

	Route::post('/getSemester','SemesterController@getSemester');

	Route::post('/deleteSubject','SubjectController@destroy');

	Route::post('/editSubject','SubjectController@update');



	/*
	*CRUD operations for marks by Admin
	*/
	Route::get('/marks','MarkController@index')->name('marks');

	Route::get('/getStudent','StudentController@getStudentForMarks');

	Route::post('/getStudentCourse','StudentController@getStudentCourse');

	Route::post('/getCourseSemesterSubject','SubjectController@getSubject');
	
	Route::post('/addMarks','MarkController@store');
	
	Route::post('/editMarks','MarkController@update');

	Route::post('/deleteMarks','MarkController@destroy');

		/*
	*CRUD operations for Exams
	*/
	Route::get('/exams','ExamController@create')->name('exams');

	Route::post('/addExam','ExamController@store')->name('addExam');

	Route::post('/deleteExam','ExamController@destroy');

	// Route::get('/editExam/{id}','ExamController@edit');
	Route::post('/editExam','ExamController@edit');

	Route::post('/update','ExamController@update')->name('updateExam');

	Route::get('/getExam','ExamController@getExam');

});