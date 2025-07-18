<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kota extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kota';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'pulau_id',
        'kota',
    ];

    protected static function booted()
    {
        static::creating(function ($kota) {
            if (!$kota->id) {
                $kota->id = (string) Str::uuid();
            }
        });
    }

    public static function createKota($data)
    {
        return self::create([
            'pulau_id' => $data['pulau_id'],
            'kota' => $data['kota'],
        ]);
    }

    public function updateKota($data)
    {
        $this->update([
            'pulau_id' => $data['pulau_id'] ?? $this->pulau_id,
            'kota' => $data['kota'] ?? $this->kota,
        ]);
    }

    public function pulau()
    {
        return $this->belongsTo(Pulau::class, 'pulau_id')->withTrashed();
    }

    public function deleteKota()
    {
        return $this->delete();
    }
}
