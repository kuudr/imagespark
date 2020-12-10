<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;


/**
 * Class Users
 * @package App\Models
 * @property string $name
 * @property string $text
 * @property string $created_by
 *
 */

class Articles extends Model
{
    use Rateable;

    public $table = 'articles';


    /**
     * @var array
     */
   protected $fillable = [
       'name',
       'text',
       'created_by',
       'created_at',
       'updated_at',
   ];



}

