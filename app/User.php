<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Str;
use Illuminate\Contracts\Notifications\Dispatcher;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'pgsql_security';
    protected $table = 'tUsuarios';
    protected $primaryKey = 'idUsuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loginUsuario', 'emailUsuario', 'claveUsuario'
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
    public function getEmailForPasswordReset()
    {
        return $this['emailUsuario'];
    }

     /**
      * Get the password for the user.
      *
      * @return string
      */
     public function getAuthPassword()
     {
         return $this['claveUsuario'];
     }

     /**
      * Get the username field
      * @return string
      */
     public function getNameUser()
     {
         //return '8c45026793-8bf7bb@inbox.mailtrap.io';
         return $this['loginUsuario'];
     }



    /**from Illuminate\Notifications\RoutesNotifications
     * Get the notification routing information for the given driver.
     *  Need change this because use the atteribute email and not the method
     *     getEmailForPasswordReset()
     * @param  string  $driver
     * @return mixed
     */
    public function routeNotificationFor($driver)
    {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}();
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->getEmailForPasswordReset();
            case 'nexmo':
                return $this->phone_number;
        }
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
      //echo 'aqui voy';
      //dd($token);
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'claveUsuario', 'remember_token',
    ];


    /**
     * return a instance of the relations from user and module
     * @return collection of bellongs to Modules
     */
    public function userModule()
    {
      return $this
        ->belongsToMany(Module::class, 'tUserModules', 'idUser', 'idModule')
        ->orderBy('idParent','asc')
        ->orderBy('idModule', 'asc');
      //'App\Role', 'role_user', 'user_id', 'role_id'
    }



}
