<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriResort extends Model
{
    use SoftDeletes;
    protected $table = 'kategori_resort';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($kategoriresort) {
            if (!$kategoriresort->id) {
                $kategoriresort->id = (string) Str::uuid();
            }
        });
    }

    public static function createKategoriResort($data)
    {
        return self::create([
            'nama' => $data['nama'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateKategoriResort($data)
    {
        $this->update([
            'nama' => $data['nama'],
            'deskripsi' => $data['deskripsi'],
            'status' => $data['status'],
        ]);
    }

    public function deleteKategoriResort()
    {
        return $this->delete();
    }


    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
