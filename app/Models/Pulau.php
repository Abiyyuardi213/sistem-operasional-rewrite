<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pulau extends Model
{
    protected $table = 'pulau';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_pulau',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($pulau) {
            if (!$pulau->id) {
                $pulau->id = (string) Str::uuid();
            }
        });
    }

    public static function createPulau($data)
    {
        return self::create([
            'nama_pulau' => $data['nama_pulau'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function updatePulau($data)
    {
        $this->update([
            'nama_pulau' => $data['nama_pulau'],
            'deskripsi' => $data['deskripsi'] ?? $this->deskripsi,
            'status' => $data['status'] ?? $this->status,
        ]);
    }

    public function deletePulau()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
