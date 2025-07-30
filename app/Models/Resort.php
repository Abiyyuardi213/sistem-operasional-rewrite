<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resort extends Model
{
    protected $table = 'resort';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kategori_id',
        'nama_resort',
        'kota_id',
        'alamat',
        'kepala_resort',
        'telepon',
    ];

    protected static function booted()
    {
        static::creating(function ($resort) {
            if (!$resort->id) {
                $resort->id = (string) Str::uuid();
            }
        });
    }

    public static function createResort($data)
    {
        return self::create([
            'kategori_id'   => $data['kategori_id'],
            'nama_resort'   => $data['nama_resort'],
            'kota_id'       => $data['kota_id'],
            'alamat'        => $data['alamat']?? null,
            'kepala_resort' => $data['kepala_resort'] ?? null,
            'telepon'       => $data['telepon'] ?? null,
        ]);
    }

    public function updateResort($data)
    {
        $this->update([
            'kategori_id'   => $data['kategori_id'],
            'nama_resort'   => $data['nama_resort'],
            'kota_id'       => $data['kota_id'],
            'alamat'        => $data['alamat']?? null,
            'kepala_resort' => $data['kepala_resort'] ?? null,
            'telepon'       => $data['telepon'] ?? null,
        ]);
    }

    public function deleteResort()
    {
        return $this->delete();
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriResort::class, 'kategori_id')->withTrashed();
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id')->withTrashed();
    }

    public function kategori_resort()
    {
        return $this->belongsTo(KategoriResort::class, 'kategori_id')->withTrashed();
    }
}
