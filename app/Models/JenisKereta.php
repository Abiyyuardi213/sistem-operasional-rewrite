<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JenisKereta extends Model
{
    protected $table = 'jenis_kereta';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'jenis',
        'tahun',
        'kelas',
        'kecepatan_maks',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($jenisKereta) {
            if (!$jenisKereta->id) {
                $jenisKereta->id = (string) Str::uuid();
            }
        });
    }

    public static function createJenisKereta($data)
    {
        return self::create([
            'jenis' => $data['jenis'],
            'tahun' => $data['tahun'],
            'kelas' => $data['kelas'],
            'kecepatan_maks' => $data['kecepatan_maks'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateJenisKereta($data)
    {
        $this->update([
            'jenis' => $data['jenis'],
            'tahun' => $data['tahun'],
            'kelas' => $data['kelas'],
            'kecepatan_maks' => $data['kecepatan_maks'] ?? $this->kecepatan_maks,
            'status' => $data['status'] ?? $this->status,
        ]);
    }

    public function deleteJenisKereta()
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
