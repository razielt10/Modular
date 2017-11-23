<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \App\User;
use \App\Module;
use \App\UserModule;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
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
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $param = isset($request['param']) ? $request['param'] : null ;
    if($param){
      $users = User::where('loginUsuario', 'like', '%'.$param.'%')->paginate(10);
      $request->flash();
    }else{
      $users = User::paginate(10);
    }

    return view('users.index', compact('users') );
  }

  /**
   * Show form create user
   * @return view
   */
  public function create()
  {
  	return view('users.add');
  }

  /**
   * Show form edit user
   * @param  Integer $id
   * @return view
   */
  public function showModules($id)
  {
      $user = User::find($id);
      $modules = Module::leftJoin
      ('tUserModules', function($join) use($id){
        $join->on('tModules.idModule', '=', 'tUserModules.idModule')
        ->where('idUser','=', $id);
      })
      ->orderBy('idParent','asc')->orderBy('idModule','asc')
      ->select('tModules.*', 'idUser', 'tUserModules.idModule as selected')
      ->get();
      return view('users.modules', compact(['user', 'modules']));
  }


  /**
   * Show form edit user
   * @param  Integer $id
   * @return view
   */
  public function edit($id)
  {
      $user = User::find($id);
      return view('users.edit', compact('user'));
  }



  /**
   * find a user by login or email
   * @param gy bet loginUsuario or emailUsuario
   * @return json object or false
   */
  public function findUsername(Request $request)
  {
    $filtro = $request->only( 'loginUsuario','emailUsuario');
    if(count($filtro)==0){
      return false;
    }else{
      $user = new User;
      foreach ($filtro as $key => $value) {
        $user = $user->orWhere($key, $value);
      }
    }
    $user = $user->first();

    return \Response::json(compact('user'));
  }

  /**
   * validate new user, to use ajax
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
   * Save new user
   * @param  Request $request
   * @return Array of errors or redirect to view users.add
   */
  public function store(Request $request)
  {
      //dd($request->file('avatar'));
      $user = new User;
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
          $user->avatar = $path;
      }

      $user->emailUsuario = $request->input('emailUsuario');
      $user->loginUsuario = $request->input('loginUsuario');
      $user->claveUsuario = password_hash($request->input('claveUsuario'), PASSWORD_DEFAULT);

      $user->save();

      return redirect( route('users.index') );
  }


  /**
   * Save new modules for users
   * @param  Request $request
   * @return Array of errors or redirect to view users.add
   */
  public function storeModules(Request $request, $id)
  {
      //delete all modules for the user
      //UserModule::where('idUser', '=', $id)->delete();

      //inserts all modules for the user

      try{
        DB::beginTransaction();
        UserModule::where('idUser', '=', $id)->delete();

        $modules = $request->only('idModule');
        $news =[]; $x=0;

        $news = array_filter($modules['idModule'], function($val){return $val;});

        foreach ($news as $key => $value) {$x++;
          $data[$x]['idModule'] = $key;
          $data[$x]['idUser'] = $id;
        }

        DB::connection('pgsql_security')->table('tUserModules')->insert($data);
        DB::commit();
      }catch(Exception $exception){
        DB::rollBack();
        abort(403, 'Unauthorized action. Try Again Later.');
      }

      return redirect()->route('users.modules', ['id' => $id])
        ->with('statusModules', 'Perfil Actualizado!');
  }


  /**
   * Save an user
   * @param  Request $request
   * @return Array of errors or redirect to view users.edit
   */
  public function update(Request $request)
  {
      $user = new User;
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

      $user->emailUsuario = $request->input('emailUsuario');
      $user->loginUsuario = $request->input('loginUsuario');
      $user->claveUsuario = password_hash($request->input('claveUsuario'), PASSWORD_DEFAULT);

      $user->save();

      return redirect( route('users.index') );
  }



}
