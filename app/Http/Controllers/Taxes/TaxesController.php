<?php

namespace App\Http\Controllers\Taxes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxesController extends Controller
{
  /**
   * dashboard for Taxes
   * @return view
   */
    public function dashboard(){

      return view('taxes.dashboard');


    }
}
