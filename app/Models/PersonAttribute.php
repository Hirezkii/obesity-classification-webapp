<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'age',
        'height',
        'weight',
        'family_history_with_overweight',
        'favc',
        'fcvc',
        'ncp',
        'caec',
        'smoke',
        'ch2o',
        'scc',
        'faf',
        'tue',
        'calc',
        'mtrans',
        'nobeyesdad',
    ];


    public function getGenderLabelAttribute()
    {
        return $this->gender == 'Male' ? 'Laki-laki' : 'Perempuan';
    }

    public function getFamilyHistoryLabelAttribute()
    {
        return $this->family_history_with_overweight == 'yes' ? 'Ya' : 'Tidak';
    }

    public function getFavcLabelAttribute()
    {
        return $this->favc == 'yes' ? 'Ya' : 'Tidak';
    }

    public function getFcvcLabelAttribute()
    {
        $labels = [
            1 => 'Tidak Pernah',
            2 => 'Kadang-kadang',
            3 => 'Selalu'
        ];
        return $labels[$this->fcvc] ?? 'Tidak Diketahui';
    }

    public function getNcpLabelAttribute()
    {
        $labels = [
            1 => 'Sekali sehari',
            2 => 'Dua kali sehari',
            3 => 'Tiga kali sehari',
            4 => 'Lebih dari tiga kali sehari'
        ];
        return $labels[$this->ncp] ?? 'Tidak Diketahui';
    }

    public function getCaecLabelAttribute()
    {
        $labels = [
            'no' => 'Tidak',
            'Sometimes' => 'Kadang-kadang',
            'Frequently' => 'Sering',
            'Always' => 'Selalu'
        ];
        return $labels[$this->caec] ?? 'Tidak Diketahui';
    }

    public function getSmokeLabelAttribute()
    {
        return $this->smoke == 'yes' ? 'Ya' : 'Tidak';
    }

    // Mendapatkan label ch2o
    public function getCh2oLabelAttribute()
    {
        $labels = [
            1 => 'Kurang dari satu liter',
            2 => 'Antara 1 dan 2 liter',
            3 => 'Lebih dari 2 liter'
        ];
        return $labels[$this->ch2o] ?? 'Tidak Diketahui';
    }

    // Mendapatkan label scc
    public function getSccLabelAttribute()
    {
        return $this->scc == 'yes' ? 'Ya' : 'Tidak';
    }

    // Mendapatkan label faf
    public function getFafLabelAttribute()
    {
        $labels = [
            0 => 'Tidak Pernah',
            1 => '1 sampai 2 hari',
            2 => '2 sampai 4 hari',
            3 => '4 sampai 5 hari'
        ];
        return $labels[$this->faf] ?? 'Tidak Diketahui';
    }

    // Mendapatkan label tue
    public function getTueLabelAttribute()
    {
        $labels = [
            0 => '0-2 jam sehari',
            1 => '3-5 jam sehari',
            2 => 'Lebih dari 5 jam'
        ];
        return $labels[$this->tue] ?? 'Tidak Diketahui';
    }

    // Mendapatkan label calc
    public function getCalcLabelAttribute()
    {
        $labels = [
            'no' => 'Tidak Pernah',
            'Sometimes' => 'Kadang-kadang',
            'Frequently' => 'Sering',
            'Always' => 'Selalu'
        ];
        return $labels[$this->calc] ?? 'Tidak Diketahui';
    }

    // Mendapatkan label mtrans
    public function getMtransLabelAttribute()
    {
        $labels = [
            'Automobile' => 'Mobil',
            'Motorbike' => 'Sepeda Motor',
            'Bike' => 'Sepeda',
            'Public Transportation' => 'Transportasi Publik',
            'Walking' => 'Berjalan kaki'
        ];
        return $labels[$this->mtrans] ?? 'Tidak Diketahui';
    }
}
