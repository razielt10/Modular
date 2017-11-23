<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
  protected $connection = 'pgsql_inventory';
  protected $table = 'tCategories';
  protected $primaryKey = 'idCategorie';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nameCategorie'
  ];

  /**
   * Get id field.
   *
   * @return integer
   */
  public function idField()
  {
      return $this[$this->primaryKey];
  }

  /**
   * Get the e-mail address where password reset links are sent.
   *
   * @return string
   */
  public function nameCategorie()
  {
      return $this['nameCategorie'];
  }

}
