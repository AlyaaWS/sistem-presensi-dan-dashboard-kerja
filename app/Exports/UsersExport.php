<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithHeadings
{
    
    public function collection(): Collection
    {
        return User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('nama_role', 'not like', '%admin%');
            })
            ->get()
            ->map(function ($user) {
                return [
                    'ID'            => $user->id,
                    'Nama Lengkap'  => $user->nama_lengkap,
                    'Username'      => $user->name,
                    'Email'         => $user->email,
                    'Tanggal Daftar'=> $user->created_at,
                    'Status'        => $user->status,
                    'Role'          => $user->role->nama_role ?? 'N/A',
                ];
            });
    }


    public function headings(): array
    {
        return ["ID", "Nama Lengkap", "Username", "Email", "Tanggal Daftar", "Status", "Role"];
    }
}
