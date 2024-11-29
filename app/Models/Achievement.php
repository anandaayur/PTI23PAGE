<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'name',
        'date_awarded',
        'student_id',
    ];

    protected $fields = [
        'name',
        'date_awarded',
        'student_id',
    ];

    static $sortables = [
        'name' => 'Nama',
        'date_awarded' => 'Tanggal Diberikan',
        'created_at' => 'Waktu Dibuat',
        'updated_at' => 'Waktu Diperbarui',
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
}
