<?php

namespace Modules\GameNews\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Gamenews.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:09:47pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Gamenews extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'gamenews';

	
}
