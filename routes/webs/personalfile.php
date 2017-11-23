<?php


//masters modules
Route::prefix('/masters')->middleware(['auth'])->group(function () {

  //Personal File master module
  Route::get('personalfile{param?}',
   'PersonalFileController@index')->name('personalfile.index');
  Route::get('personalfile/create',
   'PersonalFileController@create')->name('personalfile.create');
  Route::get('personalfile/findByPersonalID',
   'PersonalFileController@findByPersonalID');
  Route::get('personalfile/findByForeignID',
   'PersonalFileController@findByForeignID');

  Route::post('personalfile/step1',
   'PersonalFileController@storePersonalFile')->name('personalfile.storePF');
  Route::post('personalfile/step2',
   'PersonalFileController@storeForeignFile')->name('personalfile.storeFF');


 Route::patch('personalfile/step1',
  'PersonalFileController@updatePF')->name('personalfile.updatePF');
 Route::patch('personalfile/step2',
  'PersonalFileController@updateFF')->name('personalfile.updateFF');

 Route::post('personalfile/stepContact',
  'PersonalFileController@storeContact')->name('personalfile.stepContact');

  Route::get('personalfile/{id}/edit',
   'PersonalFileController@edit')->name('personalfile.edit');

  //reports
  Route::get('personalfile/{id}/reportPersonalFile',
   'ReportsController@reportPersonalFile')
   ->name('personalfile.reports.reportPersonalFile');

  //states
  Route::get('states/byCountry' , 'StatesController@byCountry')
  ->name('states.json');

  //countrys
  Route::get('countrys/allCountrys' , 'CountrysController@allCountrys')
  ->name('countrys.json');

  //Relationship
  Route::get('relationship/allRelations' , 'RelationshipController@allRelations')
  ->name('relationship.json');

  //immigrationsituation
  Route::get('immigrationsituation/jsonById' ,
   'ImmigrationSituationController@jsonById')->name('immsit.json');

}) ;
