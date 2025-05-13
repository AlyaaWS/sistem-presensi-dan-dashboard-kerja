<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;

class AdminsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::whereHas('role', function ($q) {
            $q->where('nama_role', 'like', '%admin%');
        })->select('id', 'nama_lengkap', 'name', 'email', 'created_at', 'status')->get();
    }

    public function headings(): array
    {
        return ["ID", "Nama Lengkap", "Username", "Email", "Tanggal Daftar", "Status"];
    }
}


