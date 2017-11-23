<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \App\Models\State;

class StatesController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * find a state by login or email
   * @param gy bet loginUsuario or emailUsuario
   * @return json object or false
   */
  public function byCountry(Request $request)
  {
    $filtro = $request->only( 'idCountry', 'idCountryForeign' );
    if(count($filtro)==0){
      return false;
    }else{
      $state = new State;
      foreach ($filtro as $key => $value) {
        $state = $state->orWhere('idCountry', $value);
      }
    }
    $state = $state->get();

    return \Response::json(compact('state'));
  }




  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $param = isset($request['param']) ? $request['param'] : null ;
    if($param){
      $states = State::where('firstName', 'like', '%'.$param.'%')->paginate(10);
      $request->flash();
    }else{
      $states = State::paginate(10);
    }

    return view('states.index', compact('states') );
  }

  /**
   * Show form create state
   * @return view
   */
  public function create()
  {
    $countrys = \App\Models\Country::all();
    $civilStates = \App\Traits\ConstantPeople::getCivilStates();
  	return view('states.add', compact( [ 'countrys' , 'civilStates' ] ));
  }

  /**
   * Show form edit state
   * @param  Integer $id
   * @return view
   */
  public function edit($id)
  {
      $state = State::find($id);
      return view('states.edit', compact('state'));
  }

  /**
   * validate new state, to use ajax
   * @param  Request $request
   * @return json errors
   */

  public function validateNewDuplicated(Request $request){
    return \Response::json( $this->validate($request, [
        'emailUsuario' => 'required|string|email|max:255|unique:pgsql_security.tUsuarios',
        'loginUsuario' => 'required|string|min:4|max:20|unique:pgsql_security.tUsuarios',
    ], [
        'emailUsuario.required' => 'El email es requerido',
        'emailUsuario.unique'   => 'Este email ya está registrado.',
        'loginUsuario.required' => 'El rating es requerido',
        'loginUsuario.unique' => 'Este usuario ya está registrado',
    ]) ) ;

  }


  /**
   * Save new state
   * @param  Request $request
   * @return Array of errors or redirect to view states.add
   */
  public function store(Request $request)
  {
      //dd($request->file('avatar'));
      $state = new State;
      $this->validate($request, [
          'emailUsuario' => 'required|string|email|max:255|unique:pgsql_security.tUsuarios',
          'loginUsuario' => 'required|string|min:4|max:20|unique:pgsql_security.tUsuarios',
          'claveUsuario' => 'required|string|min:6|confirmed',
      ], [
          'emailUsuario.required' => 'El email es requerido',
          'emailUsuario.unique'   => 'Este email ya está registrado.',
          'loginUsuario.required' => 'El login es requerido',
          'loginUsuario.unique' => 'Este usuario ya está registrado',
          'claveUsuario.required' => 'La Clave es requerida',
          'claveUsuario.confirmed' => 'Las claves no coinciden',
      ]);

      if($request->file('avatar')){
          $file = $request->file('avatar');
          $path = $file->store('avatars', 'public');
          $state->avatar = $path;
      }

      $state->emailUsuario = $request->input('emailUsuario');
      $state->loginUsuario = $request->input('loginUsuario');
      $state->claveUsuario = password_hash($request->input('claveUsuario'), PASSWORD_DEFAULT);

      $state->save();

      return redirect( route('states.index') );
  }


  /**
   * Save an state
   * @param  Request $request
   * @return Array of errors or redirect to view states.edit
   */
  public function update(Request $request)
  {
      $state = new State;
      $this->validate($request, [
          'emailUsuario' => 'required|string|email|max:255|unique:pgsql_security.tUsuarios',
          'loginUsuario' => 'required|string|min:4|max:20|unique:pgsql_security.tUsuarios',
          'claveUsuario' => 'required|string|min:6|confirmed',
      ], [
          'emailUsuario.required' => 'El email es requerido',
          'emailUsuario.unique'   => 'Este email ya está registrado.',
          'loginUsuario.required' => 'El rating es requerido',
          'loginUsuario.unique' => 'Este usuario ya está registrado',
          'claveUsuario.required' => 'La Clave es requerida',
          'claveUsuario.confirmed' => 'Las claves no coinciden',
      ]);

      $state->emailUsuario = $request->input('emailUsuario');
      $state->loginUsuario = $request->input('loginUsuario');
      $state->claveUsuario = password_hash($request->input('claveUsuario'), PASSWORD_DEFAULT);

      $state->save();

      return redirect( route('states') );
  }



}
