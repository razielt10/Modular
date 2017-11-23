<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \App\Models\ImmigrationSituation;

class ImmigrationSituationController extends Controller
{
  /**
   * find a ImmigrationSituation
   * @param by idImmigrationSituation
   * @return json object or false
   */
  public function jsonById(Request $request)
  {
    $filtro = $request->only( 'idImmigrationSituation' );
    if(count($filtro)==0){
      return false;
    }else{
      $list = new ImmigrationSituation;
      foreach ($filtro as $key => $value) {
        $list = $list->orWhere($key, $value);
      }
    }
    $value = $list->first();

    return \Response::json(compact('value'));
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
      $lists = $list::where('firstName', 'like', '%'.$param.'%')->paginate(10);
      $request->flash();
    }else{
      $lists = $list::paginate(10);
    }

    return view('lists.index', compact('lists') );
  }

  /**
   * Show form create list
   * @return view
   */
  public function create()
  {
    $countrys = \App\Models\Country::all();
    $civillists = \App\Traits\ConstantPeople::getCivillists();
  	return view('lists.add', compact( [ 'countrys' , 'civillists' ] ));
  }

  /**
   * Show form edit list
   * @param  Integer $id
   * @return view
   */
  public function edit($id)
  {
      $list = $list::find($id);
      return view('lists.edit', compact('list'));
  }

  /**
   * validate new list, to use ajax
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
   * Save new list
   * @param  Request $request
   * @return Array of errors or redirect to view lists.add
   */
  public function store(Request $request)
  {
      //dd($request->file('avatar'));
      $list = new ImmigrationSituation;
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
          $list->avatar = $path;
      }

      $list->emailUsuario = $request->input('emailUsuario');
      $list->loginUsuario = $request->input('loginUsuario');
      $list->claveUsuario = password_hash($request->input('claveUsuario'), PASSWORD_DEFAULT);

      $list->save();

      return redirect( route('lists.index') );
  }


  /**
   * Save an list
   * @param  Request $request
   * @return Array of errors or redirect to view lists.edit
   */
  public function update(Request $request)
  {
      $list = new ImmigrationSituation;
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

      $list->emailUsuario = $request->input('emailUsuario');
      $list->loginUsuario = $request->input('loginUsuario');
      $list->claveUsuario = password_hash($request->input('claveUsuario'), PASSWORD_DEFAULT);

      $list->save();

      return redirect( route('lists') );
  }



}
