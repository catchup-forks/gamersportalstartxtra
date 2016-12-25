<?php

namespace Modules\Games\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Genre.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:32:02pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Genre extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'genres';

	
}
