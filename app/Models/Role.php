<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $table = 'role';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'role_name',
        'role_description',
        'role_salary',
        'role_status',
    ];

    protected $casts = [
        'role_salary' => 'decimal:2',
        'role_status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($role) {
            if (!$role->id) {
                $role->id = (string) Str::uuid();
            }
        });
    }

    public static function createRole($data)
    {
        return self::create([
            'role_name' => $data['role_name'],
            'role_description' => $data['role_description'] ?? null,
            'role_salary' => $data['role_salary'],
            'role_status' => $data['role_status'] ?? true,
        ]);
    }

    public function updateRole($data)
    {
        $this->update([
            'role_name' => $data['role_name'],
            'role_description' => $data['role_description'],
            'role_salary' => $data['role_salary'] ?? $this->role_salary,
            'role_status' => $data['role_status'] ?? $this->role_status,
        ]);
    }

    public function deleteRole()
    {
        return $this->delete();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function toggleStatus()
    {
        $this->role_status = !$this->role_status;
        $this->save();
    }
}
