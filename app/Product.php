<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $connection = 'pgsql_inventory';
  protected $table = 'tUProducts';
  protected $primaryKey = 'idProduct';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      ''
  ];


  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      '',
  ];


  /**
   * return a instance of the relations from user and module
   * @return collection of bellongs to Modules
   */
  public function userModule()
  {
    return $this
      ->belongsToMany(Categorie::class, 'tCategories', 'idUser', 'idModule')
      ->orderBy('idParent','asc')
      ->orderBy('nameModule', 'asc');
    //'App\Role', 'role_user', 'user_id', 'role_id'
  }


}
