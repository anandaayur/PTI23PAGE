<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreTeam extends Model
{
    use HasFactory;

    protected $table = 'core_teams';

    protected $fillable = [
        'position',
        'order',
        'student_id',
    ];

    protected $fields = [
        'position',
        'order',
        'student_id',
    ];

    static $sortables = [
        'position' => 'Divisi',
        'order' => 'Urutan',
    ];

    static $allowedParams = [
        'limit',
        'q',
        'sortby',
        'order',
    ];

    public function scopeOptions($query, $options)
    {
        if (isset($options['q'])) {
            $query->where(function ($query) use ($options) {
                $query->where('position', 'like', '%' . $options['q'] . '%')
                    ->orWhereHas('student', function ($query) use ($options) {
                        $query->where('name', 'like', '%' . $options['q'] . '%');
                    });
            });
        }

        if (isset($options['sortby']) && in_array($options['sortby'], $this->fields)) {
            if (!isset($options['order'])) {
                $options['order'] = 'asc';
            }
            $query->orderBy($options['sortby'], validateAndGetOrder($options['order']));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function workingPrograms()
    {
        return $this->hasMany(WorkingProgram::class, 'core_team_id');
    }
}
