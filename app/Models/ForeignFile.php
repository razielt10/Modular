<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForeignFile extends Model
{
  use \App\Traits\ConstantPeople;

    protected $connection = 'pgsql_people';
    protected $table = 'tForeignFiles';
    protected $primaryKey = 'idForeignFile';
    protected $dates = ['emisionPersonalID',  'expirationPersonalID', 'dateIn',
     'dateOut', 'emisionPassport', 'expirationPassport' ];
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Get id field.
     *
     * @return
     */
    public function idField()
    {
        return $this[$this->primaryKey];
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
   "idPersonalFile" ,   "personalID",   "alternativePersonalID",
   "emisionPersonalID",   "expirationPersonalID",   "idState",
   "idCountry",   "addressForeign",   "localPhoneNumber",   "mobilePhoneNumber",
   "dateIn",   "dateOut",   "passportNumber",   "emisionPassport",
   "expirationPassport",   "jobOcupattion",   "idUserModified",
   "naturalized", "idImmigrationSituation" ,  "hasSentence" ,  "sentenceFrom" ,
   "sentenceTo" , "sentenceDescription" ,  "studyDescription"
   ];

   /**
    * return a instance for
    * @return collection
    */
   public function descriptionImmSit()
   {
     return $this
       ->belongsTo(ImmigrationSituation::class, 'idImmigrationSituation',
          'idImmigrationSituation');
     //'App\Role', 'role_user', 'user_id', 'role_id'
   }

   /**
    * return a instance for Country on field birth
    * @return collection
    */
   public function addressCountry()
   {
     return $this
       ->belongsTo(Country::class, 'idCountry', 'idCountry');
     //'App\Role', 'role_user', 'user_id', 'role_id'
   }

   /**
    * return a instance for State on field birth
    * @return collection
    */
   public function addressState()
   {
     return $this
       ->belongsTo(State::class, 'idState', 'idState');
     //'App\Role', 'role_user', 'user_id', 'role_id'
   }

}
