<?php

Route::prefix('/visits')->middleware(['auth'])->group(function () {

  Route::get('checkin', 'Visits\VisitsController@checkin')->name('visits.checkin');
  Route::get('index', 'Visits\VisitsController@index')->name('visits.index');
  
  Route::get('create', 'Visits\VisitsController@create')->name('visits.create');

});
