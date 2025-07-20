<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kantor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kantor';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_kantor',
        'jenis',
        'alamat',
        'kota_id',
        'telepon',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($kantor) {
            if (!$kantor->id) {
                $kantor->id = (string) Str::uuid();
            }
        });
    }

    public static function createKantor($data)
    {
        return self::create([
            'nama_kantor' => $data['nama_kantor'],
            'jenis'       => $data['jenis'],
            'alamat'      => $data['alamat'],
            'kota_id'     => $data['kota_id'],
            'telepon'     => $data['telepon'] ?? null,
            'status'      => $data['status'] ?? true,
        ]);
    }

    public function updateKantor($data)
    {
        $this->update([
            'nama_kantor' => $data['nama_kantor'],
            'jenis'       => $data['jenis'],
            'alamat'      => $data['alamat'],
            'kota_id'     => $data['kota_id'],
            'telepon'     => $data['telepon'],
            'status'      => $data['status'] ?? $this->status,
        ]);
    }

    public function deleteKantor()
    {
        return $this->delete();
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id')->withTrashed();
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }

    public static function getJenisList(): array
    {
        return [
            'pusat' => 'Kantor Pusat',
            'cabang' => 'Kantor Cabang',
            'sub' => 'Sub Kantor',
        ];
    }
}
