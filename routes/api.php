<?php

use App\Patient;
use App\Transformers\PatientTransformer;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/searchNotEnabled', function (Request $request) {
        $query = Patient::where('id', 'LIKE', "%{$request->get('q')}%")->orWhere('name', 'LIKE',
        "%{$request->get('q')}%");
        
        $results = $query->limit(20)->get();

        return fractal()->collection($results, new PatientTransformer());
    });

    Route::get('/search', function (Request $request) {
        $query = Patient::join('followups', 'patients.id_person', '=', 'followups.PersonID')->where(function($query1){

            return $query1->where('followups.disabled', '=', NULL )->orWhere('followups.disabled', '=', 0 );

        })->where(function($query2) use ( $request){

            return $query2->where('patients.id', 'LIKE', "%{$request->get('q')}%")->orWhere('name', 'LIKE',
            "%{$request->get('q')}%")->select('patients.*', 'followups.patient_cpf');

        })->select('patients.*');

        $results = $query->limit(20)->get();

        return fractal()->collection($results, new PatientTransformer());
    });
    Route::resource('followups', 'Api\FollowupsController');
});

Route::middleware(['basicAuth'])->group(function () {
    Route::post('/imagebase', function (Request $request) {
        $id = $request->id;
        $document = $request->document;
        $fullname = $request->fullname;
        $birthday = $request->birthday;
        $uuid = $request->uuid;

        $query = \DB::table('imagebase')->insert(
            ['id' => $id, 'document' => $document, 'fullname' => $fullname, 'birthday' => $birthday, 'uuid' => $uuid]
        );

        if ($query) {
            return response('OK', 200)->header('Content-Type', 'text/plain');
        } else {
            return response('Error', 403);
        }
    });
});


