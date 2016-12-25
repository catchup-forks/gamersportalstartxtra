<?php

namespace Modules\Games\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Series.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:33:08pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Series extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'series';

	
}
