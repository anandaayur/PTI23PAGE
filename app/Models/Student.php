<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'nim',
        'birth_date',
        'phone',
        'email',
        'instagram',
        'linkedin',
        'github',
        'twitter',
        'photo_url',
        'lecturer_id',
    ];

    protected $fields = [
        'name',
        'nim',
        'birth_date',
        'phone',
        'email',
        'instagram',
        'linkedin',
        'github',
        'twitter',
        'photo_url',
        'created_at',
        'updated_at',
    ];

    static $sortables = [
        'name' => 'Nama',
        'nim' => 'NIM',
        'birth_date' => 'Tanggal Lahir',
        'phone' => 'Telepon',
        'email' => 'Email',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu diperbarui',
    ];

    static $allowedParams = [
        'limit',
        'q',
        'sortby',
        'order',
        'lecturer_id',
    ];

    public function scopeOptions($query, $options)
    {
        if (isset($options['q'])) {
            $query->where(function ($query) use ($options) {
                $query->where('name', 'like', '%' . $options['q'] . '%')
                    ->orWhere('nim', 'like', '%' . $options['q'] . '%')
                    ->orWhere('phone', 'like', '%' . $options['q'] . '%')
                    ->orWhere('email', 'like', '%' . $options['q'] . '%')
                    ->orWhereHas('lecturer', function ($query) use ($options) {
                        $query->where('name', 'like', '%' . $options['q'] . '%');
                    });
            });
        }

        if (isset($options['lecturer_id'])) {
            $query->where('lecturer_id', $options['lecturer_id']);
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

    public static function getStudentNotInCoreTeam($exceptId = null)
    {
        return self::whereDoesntHave('coreTeam')
            ->when($exceptId, function ($query) use ($exceptId) {
                return $query->where('id', '!=', $exceptId);
            })
            ->get();
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'student_organization_pivot', 'student_id', 'organization_id');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'student_id');
    }

    public function coreTeam()
    {
        return $this->hasOne(CoreTeam::class, 'student_id');
    }
}
