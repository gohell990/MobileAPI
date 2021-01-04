<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        // Route::prefix('api')
        //      ->middleware('api')
        //      ->namespace($this->namespace)
        //      ->group(base_path('routes/api.php'));
        Route::group([
            'middleware' => ['api', 'cors'],
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
             //Add you routes here, for example:
                Route::middleware('api')->namespace('Auth')->prefix('auth')->group(function() {
                    Route::post('login', 'AuthController@login');
                    Route::post('logout', 'AuthController@logout');
                    // Route::post('refresh', 'AuthController@refresh');
                    Route::post('me', 'AuthController@me');
                    Route::get("return", "AuthController@returnMessage");
                    
                });

                Route::middleware('jwt.auth')->group(function() {
                    //Route::apiResource('users', 'UserController');
                    Route::get('users/{userType}', 'UserController@index'); //Show users data by admin/user/redemptionManager
                    Route::post('users/{userType}', 'UserController@store'); //Create admin/redemptionManager
                    Route::post('users/update/{id}', 'UserController@update'); //Update selected ID for admin/user/redemptionManager by userType=?
                    Route::post('users/delete/{id}', 'UserController@destroy'); //Delete selected ID for admin/user/redemptionManager by userType=?
                    
                    // Route::post("users/zero_order", )
                    // Route::post("singleUser", "UserController@getUserByID"); //Get single user data admin/user/redemptionManager by id
                    Route::post("userSpent", "UserController@searching"); //Get 1 or all user spent in 1 event or all
                    
                    
                    Route::get("redemption", "RedemptionController@index");
                    Route::post("redemption", "RedemptionController@store");
                    Route::post("redemption/update/{id}", "RedemptionController@update");
                    Route::post("redemption/delete/{id}", "RedemptionController@destroy");
                    // Route::post("redemption/{id}", "RedemptionController@show");
                    
                    
                    Route::get("txn", "TransactionController@getAllTxn");
                    Route::post("txn", "TransactionController@store");
                    Route::post("txn/update/{id}", "TransactionController@update");
                    Route::post("txn/delete/{id}", "TransactionController@destroy");
                    Route::post("txnAll", "TransactionController@index");
                    
                    Route::get("image", "ImageController@index");
                    Route::post("image", "ImageController@store");


                    Route::get('event', 'EventController@index');
                    Route::post('event', 'EventController@store');
                    Route::post('event/update/{id}', 'EventController@update');
                    Route::post('event/delete/{id}', 'EventController@destroy');
                    Route::post("eventDetails", "EventController@getEventDetails");
                    

                    Route::get("company", "CompanyController@getCompanyDetails"); //search all 
                    Route::post("company", "CompanyController@store");
                    Route::post("company/update/{id}", "CompanyController@update");
                    Route::post("company/delete/{id}", "CompanyController@destroy");
                    Route::post("companySales", "CompanyController@companySales"); /*company_id, company_name, username, code, regNo, office_no, */
                    Route::post("company/reset/{id}", "CompanyController@resetCompanyPassword"); //pass company_id to reset password
                    Route::post("companyEventSales", "CompanyController@getEventSales");
                    
                });
                
                
        });
        
        
    }
}
