<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agama;
use App\Models\Prodi;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Mahasiswa extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mahasiswas';  
    protected $primaryKey = 'id_mhs';

    protected $fillable = [
        'nim',
        'nama_mhs',
        'nama_panggilan',
        'tempat_lahir',
        'tgl_lahir',
        'id_agama',
        'jekel',
        'jmlh_saudara',
        'anak_ke',
        'no_hp',
        'id_prodi',
        'password',
        'id_kelas',
        'fotomhs',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat_mhs',
        'nama_sekolah',
        'jurusan',
        'alamat_sekolah',
        'prestasi',
        'nama_ortu',
        'alamat_ortu',
        'pekerjaan_ortu',
        'nohp_ortu',
        'nama_wali',
        'alamat_wali',
        'pekerjaan_wali',
        'nohp_wali',
        'status_biodata',
        'id_dosen',
    ];

    public function getAuthIdentifierName()
    {
        return 'nim'; // Ganti dengan nama kolom yang berfungsi sebagai identifier
    }

    public function getAuthIdentifier()
    {
        return $this->nim; // Ganti dengan nama kolom yang berfungsi sebagai identifier
    }

    public function getAuthPassword()
    {
        return $this->password; // Ganti dengan nama kolom yang berisi password
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama', 'id_agama');

    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');

    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'id_mhs', 'id_mhs');
    }

    public function sp()
    {
        return $this->hasMany(Sp::class, 'id_mhs');
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_mhs');
    }

      /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nim_verified_at' => 'datetime',
    ];


}

