<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nik',
        'nama',
        'jabatan',
        'usia',
        'alamat',
        'foto'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($karyawan) {
            // Auto generate NIK: Find the smallest available gap
            $existingNiks = static::pluck('nik')->toArray();
            $newNumber = '0001';
            
            for ($i = 1; $i <= 9999; $i++) {
                $checkNik = 'KRY-' . str_pad($i, 4, '0', STR_PAD_LEFT);
                if (!in_array($checkNik, $existingNiks)) {
                    $newNumber = str_pad($i, 4, '0', STR_PAD_LEFT);
                    break;
                }
            }

            $karyawan->nik = "KRY-{$newNumber}";
        });
    }

    /**
     * Get the photo URL.
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto && \Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=00f3ff&color=000&bold=true';
    }
}
