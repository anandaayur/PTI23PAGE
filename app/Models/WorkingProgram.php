<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingProgram extends Model
{
    use HasFactory;

    protected $table = 'working_programs';

    protected $fillable = [
        'core_team_id',
        'name',
        'description',
    ];

    protected $fields = [
        'core_team_id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    static $sortables = [
        'name' => 'Nama',
        'description' => 'Deskripsi',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu diperbarui',
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
                $query->where('name', 'like', '%' . $options['q'] . '%')
                    ->orWhere('description', 'like', '%' . $options['q'] . '%')
                    ->orWhereHas('coreTeam', function ($query) use ($options) {
                        $query->where('position', 'like', '%' . $options['q'] . '%');
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

    public function coreTeam()
    {
        return $this->belongsTo(CoreTeam::class, 'core_team_id');
    }
}
