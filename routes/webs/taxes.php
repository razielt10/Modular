<?php

Route::prefix('/taxes')->middleware(['auth'])->group(function () {

  Route::get('dashboard', 'Taxes\TaxesController@dashboard')->name('taxes.dashboard');

});
