<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrganizationPivot extends Model
{
    use HasFactory;

    protected $table = 'student_organization_pivot';

    protected $fillable = [
        'student_id',
        'organization_id',
    ];

    public static function multipleInsert($organization_ids, $student_id)
    {
        $data = [];
        foreach ($organization_ids as $organization_id) {
            $data[] = [
                'student_id' => $student_id,
                'organization_id' => $organization_id,
            ];
        }

        return self::insert($data);
    }
}
