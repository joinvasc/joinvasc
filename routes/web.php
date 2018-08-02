<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

    Route::get('/followupsApi/{followup}', 'FollowupsController@getQrCodePatientData');
    
    Route::get('/research', 'ResearchController@index');

    Route::any('/researchRegister', 'ResearchController@register');

    Route::get('/signup', 'PendingRegistrationController@index');

    Route::any('/register', 'PendingRegistrationController@register');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@index');

        Route::get('/followups/novo',
            ['as' => 'followups.create', 'uses' => 'FollowupsController@create']);

        Route::get('/followups/{followup}',
            ['as' => 'followups.edit', 'uses' => 'FollowupsController@edit']);
        
        Route::get('/exportCenter', 'ExportController@index');

        Route::post('/saveProfile', 'ExportController@saveProfile');

        Route::get('/getAllExportOptions', 'ExportController@getAllExportOptions');

        Route::post('/getExportFile', 'ExportController@getExportFile');

            Route::post('/followups/export/xls',
            ['as' => 'followups.export', 'uses' => 'FollowupsController@export']);

        Route::get('/sec/blockbyip', 'BlockbyipController@index');
            
        Route::post('/sec/ip', 'BlockbyipController@returnIP');

        Route::get('/qrcode', 'QRCodeController@index');

        Route::get('/callReport', 'CallReportController@index');

        Route::resource('patients', 'PatientsController');

        Route::post('/followups/verifyAmbulatoryCareData', 'FollowupsController@verifyAmbulatoryCareData');

        Route::post('/followups/isEnable', 'FollowupsController@isEnable');

        Route::post('/getAllPatients', 'CallReportController@getAllPatients');

        Route::post('/followups/createControl', 'FollowupsController@createControl');
        
        Route::post('/followups/getLastEvents', 'FollowupsController@getLastEvents');

        Route::post('/getAllPatientsDashboard', 'FollowupsController@getAllPatientsDashboard');

        Route::post('/deletePatient', 'FollowupsController@deletePatient');
});



