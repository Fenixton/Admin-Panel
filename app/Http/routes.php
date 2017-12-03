<?php

//dev@aspres.ru
//123456

Route::get('/login', "Auth\AuthController@getLogin");

Route::post('/login', "Auth\AuthController@postLogin");

Route::get('/password/reset', "Auth\PasswordController@getReset");

Route::post('/password/reset', "Auth\PasswordController@postReset");

Route::get('/logout', 'Auth\AuthController@logout');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', "DashboardController@index");

    Route::group(['prefix' => 'restaurant/{id}', 'middleware' => 'permissions'], function() {

        Route::get('/', "RestaurantController@get"); //Страница заведения
        
        Route::get('/edit', "RestaurantController@getEdit");
        
        Route::post('/edit', "RestaurantController@postEdit");

        Route::get('/menu', "MenuController@get"); //Меню заведения

        Route::get('/menu/add', "MenuController@getAdd"); //Добавление новой позиции в меню

        Route::post('/menu/add', "MenuController@postAdd");
        
        Route::get('/menu/edit/{item_id}', "MenuController@getEdit"); //Редактирование позиции в меню

        Route::post('/menu/edit/{item_id}', "MenuController@postEdit");

        Route::get('/menu/delete/{item_id}', "MenuController@getDelete"); //Удалении позиции в меню

        Route::get('/schedule', "ScheduleController@get"); //Страница с графиком работы заведения

        Route::get('/schedule/edit/{weekday_id}', "ScheduleController@getEdit"); //Редактирование/добавление графика работы заведения в определенный день недели
    
        Route::post('/schedule/edit/{weekday_id}', "ScheduleController@postEdit");
        
        Route::get('/schedule/delete/{weekday_id}', "ScheduleController@getDelete");

        Route::get('/schedule/add_holiday', "ScheduleController@getAddHoliday"); //Добавление "особого" графика работы (например, в праздничные дни)

        Route::post('/schedule/add_holiday', "ScheduleController@postAddHoliday");
        
        Route::get('/schedule/delete_holiday/{day_id}', "ScheduleController@getDeleteHoliday");

        Route::get('/schedule/calendar', "ScheduleController@getCalendar");
        
        Route::get('/menu/add_toping', "MenuController@getAddToping");
        
        Route::post('/menu/add_toping', "MenuController@postAddToping");
        
        Route::get('/menu/edit_toping/{item_id}', "MenuController@getEditToping");
        
        Route::post('/menu/edit_toping/{item_id}', "MenuController@postEditToping");
        
        Route::get('/menu/delete_toping/{item_id}', "MenuController@getDeleteToping");
    });

    Route::group(['middleware' => 'admin'], function() {
        
        Route::get('/partners', "PartnerController@getPartners");
        
        Route::get('/partners/info/{item_id}', "PartnerController@getPartner");
        
        Route::get('/partners/info/{item_id}/restaurants', "PartnerController@getPartnerRestaurants");
        
        Route::get('/partners/info/{item_id}/restaurants/add', "PartnerController@getAddRestaurant");
        
        Route::post('/partners/info/{item_id}/restaurants/add', "PartnerController@postAddRestaurant");
        
        Route::get('/partners/info/{item_id}/restaurants/edit/{restaurant_id}', "PartnerController@getEditRestaurant");
        
        Route::post('/partners/info/{item_id}/restaurants/edit/{restaurant_id}', "PartnerController@postEditRestaurant");
        
        Route::get('/partners/info/{item_id}/restaurants/delete/{restaurant_id}', "PartnerController@getDeleteRestaurant");
        
        Route::get('/partners/info/{item_id}/menu_categories', "PartnerController@getPartnerCategories");
        
        Route::get('/partners/info/{item_id}/menu_categories/add', "PartnerController@getAddPartnerCategories");
        
        Route::post('/partners/info/{item_id}/menu_categories/add', "PartnerController@postAddPartnerCategories");
        
        Route::get('/partners/info/{item_id}/menu_categories/edit/{category_id}', "PartnerController@getEditPartnerCategories");
        
        Route::post('/partners/info/{item_id}/menu_categories/edit/{category_id}', "PartnerController@postEditPartnerCategories");
        
        Route::get('/partners/info/{item_id}/menu_categories/delete/{category_id}', "PartnerController@getDeletePartnerCategories");
        
        Route::get('/partners/add', "PartnerController@getAddPartner");
        
        Route::post('/partners/add', "PartnerController@postAddPartner");
        
        Route::get('/partners/edit/{item_id}', "PartnerController@getEditPartner");
        
        Route::post('/partners/edit/{item_id}', "PartnerController@postEditPartner");
        
        Route::get('/partners/delete/{item_id}', "PartnerController@getDeletePartner");
        
        Route::get('/managers', "ManagerController@getManagers");
        
        Route::get('/managers/add', "ManagerController@getAddManager");
        
        Route::post('/managers/add', "ManagerController@postAddManager");
        
        Route::get('/managers/edit/{item_id}', "ManagerController@getEditManager");
        
        Route::post('/managers/edit/{item_id}', "ManagerController@postEditManager");
        
        Route::get('/managers/delete/{item_id}', "ManagerController@getDeleteManager");
    });

    Route::get('/ajax/telegram.testMessage/{token}', "TelegramController@sendMessage");

    Route::get('/ajax/telegram.unbind/{token}', "TelegramController@unbind");

});