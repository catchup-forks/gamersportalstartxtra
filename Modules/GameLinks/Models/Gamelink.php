<?php

namespace Modules\GameLinks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Gamelink.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:10:43pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Gamelink extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'gamelinks';

	
}
