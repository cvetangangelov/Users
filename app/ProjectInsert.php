<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectInsert extends Model
{
	protected $table = 'cnt_users';
	protected $fillable = [
		'id',
		'name', 
		'email',
		'gender', 
		'image'
	];
}
?>