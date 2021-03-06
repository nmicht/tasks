<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//Rutas de tareas

//Listar todos los tasks
// Route::get('tasks',[
//     'middleware' => 'auth',
//     'uses' => 'TaskController@index'
// ]);

Route::group([
    'middleware' => 'auth',
    'prefix' => 'tasks'
], function(){
    //Listar todos los tasks
    Route::get('','TaskController@index');

    //Mostrar el formulario de creacion
    Route::get('create','TaskController@create');

    //Crear el task
    Route::post('',[
        'middleware' => 'App\Http\Middleware\Validation',
        'uses' => 'TaskController@store'
    ]);

    //Muestra la vista de edicion
    Route::get('{task}/edit','TaskController@edit');

    //Edita el task
    Route::put('{task}',[
        'middleware' => 'App\Http\Middleware\Validation',
        'uses' => 'TaskController@update'
    ]);

    //Muestra un task
    Route::get('{task}','TaskController@show');

    //Elimina un task
    Route::delete('{task}',[
        'middleware' => 'App\Http\Middleware\Validation',
        'uses' => 'TaskController@destroy'
    ]);
});

//Definiendo el modelo para ligar las rutas con los modelos
Route::model('task', '\App\Models\Task');
Route::model('project', '\App\Models\Project');

//Rutas de tareas
Route::get('projects','ProjectController@index');
Route::get('projects/create','ProjectController@create');
Route::post('projects','ProjectController@store'); //Crear
Route::get('projects/{project}/edit','ProjectController@edit')->where('project','[0-9]+');
Route::put('projects/{project}','ProjectController@update')->where('project','[0-9]+'); //Editar
Route::get('projects/{project}','ProjectController@show')->where('project','[0-9]+');
Route::delete('projects/{project}','ProjectController@destroy')->where('project','[0-9]+'); //Eliminar


// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/*
1. Crear la ruta para ver las cosas del usuario
2. Crear el controlador para las cosas del usuario
3. En el controlador ejecutar los metodos para Obtener
 - tareas del usuario loggeado
 - tareas del colaborador loggeado
4. Crear una vista que muestre las cositas del punto 3
 */

Route::get('',[
    'middleware' => 'auth',
    'uses' => 'DashboardController@index'
]);
