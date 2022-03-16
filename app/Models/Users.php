<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Users extends Model
{
	use Sortable;
	protected $table = 'cnt_users';
	protected $fillable = [
		'id',
		'name', 
		'email',
		'gender', 
		'image'
	];

    public $sortable = ['id',
                        'name',
                        'email',
                        'gender',
						'image'
					];

    public function category()
    {
        return $this->belongsTo('AppCategory');
    }

}
?>