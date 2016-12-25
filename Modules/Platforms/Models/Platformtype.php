<?php

namespace Modules\Platforms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Platformtype.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:17:03pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Platformtype extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'platformtypes';

	
}
