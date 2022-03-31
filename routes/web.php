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

/*************************** modules Scolarite*********************** */
Route::prefix('scolarity')->namespace('Scolarity')->group(function () {
    Route::resource('inscription', 'InscriptionController');
    Route::get('inscription/payments/{id}', 'InscriptionController@payments_index')->name('inscription_payments.index');
    Route::get('/inscription/print-pdf/{id}', ['as' => 'inscription.printpdf', 'uses' => 'InscriptionController@printPDF']);
    /*********payment */
    Route::resource('payment', 'PaymentController');
    Route::get('/payment/print-pdf/{id}', ['as' => 'payment.printpdf', 'uses' => 'PaymentController@printPDF']);
    /*********end payment */
    /*********student */
    Route::resource('student', 'StudentController');
    Route::put('studentM/{id}', 'StudentController@updateM')->name('inscription_payments.index');
    Route::post('studentPic/{id}', 'StudentController@updatePhoto')->name('student.image');
    Route::post('getStudentByDepartment', 'StudentController@getStudentByDepartment')->name('student.getByDepartment');
    Route::post('getStudentByDiscipline', 'StudentController@getStudentByDiscipline')->name('student.getByDiscipline');
    Route::post('getStudentByLevel', 'StudentController@getStudentByLevel')->name('student.getByLevel');
    /*********end student */
    /*Academic_year */
    Route::resource('academic_year', 'Academic_yearController');
    Route::post('academic_year/session/', 'Academic_yearController@store_session_academic_year')->name('academic_year_session.post');
    Route::get('academic_year/session/{id}', 'Academic_yearController@sessions_index')->name('academic_year_session.index');
    /*Fin académic_year */
    /*Repport */
    Route::resource('report', 'ReportController');
    /*End repport */
    /*Report accounting */
    Route::resource('report_accounting', 'ReportAccountingController');
    Route::post('report_accounting1', 'ReportAccountingController@searchdebtor')->name('report_accounting1');
    Route::post('report_accounting_payment', 'ReportAccountingController@searchpayment')->name('report_payment');
    Route::get('report_accounting1/print-pdf', ['as' => 'report_accounting1.printpdf', 'uses' => 'ReportAccountingController@printPDF']);
    Route::get('report_accounting_payment/print-pdf', ['as' => 'report_accounting_payment.printpdf', 'uses' => 'ReportAccountingController@printPaymentPDF']);
    /*End report accounting */

    /*Session */
    Route::resource('session', 'SessionController');
    Route::get('session/course/{id}', 'SessionController@sessionCourse')->name('session_course.index');
    /*End session */
    /***Slice */
    Route::resource('slice', 'SliceController');
    Route::get('getAmount', 'Class_sliceController@getAmount')->name('Slice.getAmount');
    /**End slice */
    /***Class_slice */
    Route::resource('class_slice', 'Class_sliceController');
    /**End class_slice */
});
/***************************fin du modules scolarite********** */



/**********module de  gestion des notes  */
Route::prefix('mark')->namespace('Mark')->group(function () {
    
    /****start marking */
    Route::get('marks/{id}/{year}','MarkController@index');


    Route::post('mark', 'MarkController@store');

    Route::get('startmark','MarkController@index1');
    /*****start marking */
    /*****rattrapage */
    //Route::resource('report_card', 'Report_cardController');
    Route::get('rattrapage', 'Notes_rattrapageController@index1');
    Route::get('rattrapage/{a_year}', 'Notes_rattrapageController@index2');
    Route::get('rattrapage-notes/{a_year}/{sequence}/{course}', 'Notes_rattrapageController@index');
    Route::post('rattrapage', 'Notes_rattrapageController@store');


    /********end rattrapage */
    /**report card */
    Route::resource('report_card', 'Report_cardController');
    Route::get('reportcard/{id}', 'Report_cardController@reportCard')->name('report_card.reportcard');
    Route::get('getStudentByAcademic_year/{year}','Report_cardController@getStudentByAcademic_year');
    Route::get('getStudentByDiscipline/{discipline}','Report_cardController@getStudentByDiscipline');
    Route::get('getStudentByDepartment/{department}','Report_cardController@getStudentByDepartment');
    Route::get('getStudentByLevel_study/{department}','Report_cardController@getStudentByLevel_study');
    Route::get('getStudentByClassroom/{level}/{discipline}','MarkController@getStudentByClassroom');
    Route::get('/reportCard/print-pdf/{id}', ['as' => 'reportCard.printpdf', 'uses' => 'Report_cardController@printPDF']);

});


/***************************module configuration***********/
Route::prefix('configuration')->namespace('Configuration')->group(function () {
    /********institution controller */
    Route::resource('institution', 'InstitutionController');
    Route::post('institutionPic/{id}', 'InstitutionController@updatePhoto')->name('institution.image');

        /**department */
            Route::resource('department','DepartmentController');
            Route::get('department/discipline/{id}', 'DepartmentController@disciplines_index')->name('departement_discipline.index');
        /**end departemnt */
        /*****discipline***** **************/
            Route::resource('discipline','DisciplineController');
            Route::resource('user', 'UserController');
            Route::get('discipline/level/{id}', 'DisciplineController@level_index')->name('discipline_level.index');
        /*****end discipline */
        /***User */
            Route::get('User/profile', 'UserController@profile')->name('profile.index');
            Route::post('profilePic', 'UserController@update_avatar')->name('profile.image');
            Route::put('changePassword', 'UserController@changePassword')->name('profile.password');
        /**End user */
        /****enseignant */
            Route::resource('enseignant','TeacherController');
        /***end enseignant */
        /*****classroom or discipline_level_study if you prefer */
            Route::resource('classroom','Discipline_level_studyController');
            Route::get('dClassroom/{id}','Discipline_level_studyController@discipline');
            Route::get('amount/{id}','Discipline_level_studyController@indexAmount')->name('class_slice.indexAmount');
        /*****end classroom */
        /**********level study */
            Route::resource('level_study','Level_studyController');
        /**********end level study */
        /**********Module */
            Route::resource('module','ModuleController');
            Route::get('school-module/index', 'ModuleController@moduleIndex')->name('module.custom.index');
            Route::post('moduleSave/saving', 'ModuleController@save')->name('module.saveModule');
            Route::put('updateModule/{id}', 'ModuleController@updateModule')->name('module.updateModule');
        /**********end Module */
        Route::get('/course/view-pdf', [ 'as' => 'course.viewpdf', 'uses' => 'CourseController@viewPDF']);
        Route::get('/course/print-pdf/{id}', [ 'as' => 'course.printpdf', 'uses' => 'CourseController@printPDF']);
        Route::get('/course/print-pdf/', [ 'as' => 'course.printpdf', 'uses' => 'CourseController@kprintPDF']);
        /**Course */
            Route::resource('course','CourseController');
            Route::get('course/course_sequence/{id}', 'CourseController@course_sequence')->name('course.course_sequence');
            Route::post('course/course_sequence', 'CourseController@postcourse_sequence')->name('course.course_sequences');

            Route::get('disciplineLevel', 'CourseController@disciplineLevel')->name('course.levels');
            Route::get('levelModule', 'CourseController@levelModule')->name('course.moduleLevel');
            Route::get('departmentDiscipline', 'CourseController@departmentDiscipline')->name('course.departmentDiscipline');
        /**********end course */
    /*****sequence */
    Route::resource('sequence','SequenceController');
    Route::post('sequence/rattrapage','SequenceController@rattrapage');

 });
/***************************fin module configuration***********/

Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
/******end authentification  */
/*****language configuration*********** */
Route::name('language')->get('language/{lang}', 'HomeController@language');
/***********end of langage configurations********* */


Route::get('/test-error404', function () {
    return view('errors.404');
});