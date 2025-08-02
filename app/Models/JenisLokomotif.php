<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JenisLokomotif extends Model
{
    protected $table = 'jenis_lokomotif';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'jenis',
        'jenis_mesin',
        'kecepatan_maks',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($jenisLok) {
            if (!$jenisLok->id) {
                $jenisLok->id = (string) Str::uuid();
            }
        });
    }

    public static function createJenisLokomotif($data)
    {
        return self::create([
            'jenis' => $data['jenis'],
            'jenis_mesin' => $data['jenis_mesin'],
            'kecepatan_maks' => $data['kecepatan_maks'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateJenisLokomotif($data)
    {
        $this->update([
            'jenis' => $data['jenis'],
            'jenis_mesin' => $data['jenis_mesin'],
            'kecepatan_maks' => $data['kecepatan_maks'] ?? $this->kecepatan_maks,
            'status' => $data['status'] ?? $this->status,
        ]);
    }

    public function deleteJenisLokomotif()
    {
        return $this->delete();
    }

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'role_id');
    // }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
