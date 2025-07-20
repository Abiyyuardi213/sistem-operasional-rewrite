<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Daops extends Model
{
    protected $table = 'daops';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_daop',
        'deskripsi',
        'alamat',
        'telepon',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($daop) {
            if (!$daop->id) {
                $daop->id = (string) Str::uuid();
            }
        });
    }

    public static function createDaop($data)
    {
        return self::create([
            'nama_daop' => $data['nama_daop'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'telepon' => $data['telepon'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updateDaop($data)
    {
        $this->update([
            'nama_daop' => $data['nama_daop'],
            'deskripsi' => $data['deskripsi'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'status' => $data['status'],
        ]);
    }

    public function deleteDaop()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
