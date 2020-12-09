<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Users
 * @package App\Models
 * @property string $login
 * @property string $surname
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $table
 *
 */
class Users extends Model
{

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'name',
        'surname',
        'email',
        'address',
    ];


}
