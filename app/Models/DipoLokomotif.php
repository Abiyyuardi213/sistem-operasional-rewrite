<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DipoLokomotif extends Model
{
    protected $table = 'dipo_lokomotif';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_dipo',
        'alamat',
        'telepon',
        'kepala_dipo',
        'status',
        'kota_id',
        'daop_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($dipoLokomotif) {
            if (!$dipoLokomotif->id) {
                $dipoLokomotif->id = (string) Str::uuid();
            }
        });
    }

    public static function createDipoLokomotif($data)
    {
        return self::create([
            'nama_dipo' => $data['nama_dipo'],
            'alamat' => $data['alamat'] ?? null,
            'kota_id' => $data['kota_id'],
            'daop_id' => $data['daop_id'],
            'telepon' => $data['telepon'] ?? null,
            'kepala_dipo' => $data['kepala_dipo'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateDipoLokomotif($data)
    {
        $this->update([
            'nama_dipo' => $data['nama_dipo'],
            'alamat' => $data['alamat'] ?? null,
            'kota_id' => $data['kota_id'],
            'daop_id' => $data['daop_id'],
            'telepon' => $data['telepon'] ?? null,
            'kepala_dipo' => $data['kepala_dipo'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function deleteDipoLokomotif()
    {
        return $this->delete();
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function daop()
    {
        return $this->belongsTo(Daops::class, 'daop_id');
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
