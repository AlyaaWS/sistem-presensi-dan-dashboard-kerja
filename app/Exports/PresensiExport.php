<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresensiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Presensi::join('users', 'presensis.id_user', '=', 'users.id')
            ->join('roles', 'users.id_role', '=', 'roles.id_role') // disesuaikan!
            ->select(
                'presensis.id_presensi as ID Presensi',
                'users.nama_lengkap',
                'users.email',
                'presensis.date',
                'presensis.time',
                'roles.nama_role as Role',
                'presensis.location'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Presensi',
            'Nama Lengkap',
            'Email',
            'Tanggal',
            'Waktu',
            'Role',
            'Lokasi',
        ];
    }
}
