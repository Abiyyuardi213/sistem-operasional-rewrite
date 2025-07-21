<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BalaiYasa extends Model
{
    protected $table = 'balai_yasa';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_balai',
        'kota_id',
        'deskripsi',
        'alamat',
        'telepon',
        'kepala_balai',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($balai) {
            if (!$balai->id) {
                $balai->id = (string) Str::uuid();
            }
        });
    }

    public static function createBalaiYasa($data)
    {
        return self::create([
            'nama_balai' => $data['nama_balai'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'kota_id' => $data['kota_id'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'kepala_balai' => $data['kepala_balai'],
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateBalaiYasa($data)
    {
        $this->update([
            'nama_balai' => $data['nama_balai'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'kota_id' => $data['kota_id'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'kepala_balai' => $data['kepala_balai'],
            'status' => $data['status'] ?? true,
        ]);
    }

    public function deleteBalaiYasa()
    {
        return $this->delete();
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function getNamaKotaAttribute()
    {
        return $this->kota ? $this->kota->kota : null;
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
