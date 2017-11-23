<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalFile extends Model
{
  use \App\Traits\ConstantPeople;

    protected $connection = 'pgsql_people';
    protected $table = 'tPersonalFiles';
    protected $primaryKey = 'idPersonalFile';
    protected $dates = ['emisionPersonalID', 'expirationPersonalID',
     'birthDate', 'emisionPassport', 'expirationPassport', 'birthFileDate' ];
    protected $dateFormat = 'Y-m-d H:i:s';

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
     * Get the first and last name.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this['firstName'].' '.$this['lastName'];
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $guarded = [ 'created_at',  'updated_at' ];

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
    'firstName', 'lastName', 'personalID', 'emisionPersonalID' ,
    'expirationPersonalID', 'idState', 'birthDate', 'birthPlace' ,
    'idCountry', 'principalEmail', 'secondaryEmail', 'bloodType' ,
    'passportNumber', 'emisionPassport', 'expirationPassport' ,
    'jobOcupattion', 'instruccionDegree', 'addressOrigin' ,
    'localPhoneNumber', 'mobilePhoneNumber', 'birthNumberFile' ,
    'idUserModified', 'alive', 'civilState', 'birthFileDate',
    'gender', 'naturalized', 'officialGazette', 'officialGazetteDate',
    'pensionerIVSS'
  ];


  /**
   * return a instance for Country on field birth
   * @return collection
   */
  public function birthCountry()
  {
    return $this
      ->belongsTo(Country::class, 'idCountry', 'idCountry');
    //'App\Role', 'role_user', 'user_id', 'role_id'
  }

  /**
   * return a instance for State on field birth
   * @return collection
   */
  public function birthState()
  {
    return $this
      ->belongsTo(State::class, 'idState', 'idState');
    //'App\Role', 'role_user', 'user_id', 'role_id'
  }




}
