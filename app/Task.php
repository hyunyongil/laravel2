<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
	protected $fillable = ['name', 'project_id'];
    use SoftDeletes;
 
    protected $dates = ['deleted_at'];
    /**
     * 완료 기한이 7 일 이내인 할 일만 조회.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDueIn7Days($query)
    {
        return $query->where('due_date', '>', \Carbon\Carbon::now()->subDays(7));
    }
    public function scopeDueInDays($query, $days)
    {
        return $query->where('due_date', '>', \Carbon\Carbon::now()->subDays($days));
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
