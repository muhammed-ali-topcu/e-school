<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Section
 * 
 * @property int $id
 * @property string $name
 * @property int $grade_id
 * @property bool $is_active
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Grade $grade
 *
 * @package App\Models
 */
class Section extends Model
{
	use SoftDeletes;
	protected $table = 'sections';

	protected $casts = [
		'grade_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'grade_id',
		'is_active'
	];

	public function grade()
	{
		return $this->belongsTo(Grade::class);
	}
}
