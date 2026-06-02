<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PayrollRecord;
use Illuminate\Database\Seeder;

class HrDataSeeder extends Seeder
{
    public function run(): void
    {
        $employees = collect([
            [
                'nik' => 'EMP-0001',
                'name' => 'Ayu Permata Sari',
                'position' => 'HR Officer',
                'department' => 'Human Resource',
                'joined_at' => '2024-01-10',
                'email' => 'ayu.permata@example.test',
            ],
            [
                'nik' => 'EMP-0002',
                'name' => 'Bima Pratama',
                'position' => 'Supervisor',
                'department' => 'Operasional',
                'joined_at' => '2023-09-18',
                'email' => 'bima.pratama@example.test',
            ],
            [
                'nik' => 'EMP-0003',
                'name' => 'Citra Lestari',
                'position' => 'Finance Staff',
                'department' => 'Finance',
                'joined_at' => '2022-11-05',
                'email' => 'citra.lestari@example.test',
            ],
        ])->mapWithKeys(function (array $data): array {
            $employee = Employee::updateOrCreate(
                ['nik' => $data['nik']],
                $data + ['status' => 'Aktif']
            );

            return [$employee->nik => $employee];
        });

        LeaveRequest::updateOrCreate(
            ['employee_id' => $employees['EMP-0001']->id, 'start_date' => '2026-05-12'],
            [
                'leave_type' => 'Cuti Tahunan',
                'end_date' => '2026-05-14',
                'duration_days' => 3,
                'reason' => 'Kunjungan keluarga',
                'requested_at' => '2026-05-01',
                'status' => 'Menunggu',
            ]
        );

        LeaveRequest::updateOrCreate(
            ['employee_id' => $employees['EMP-0002']->id, 'start_date' => '2026-04-21'],
            [
                'leave_type' => 'Cuti Sakit',
                'end_date' => '2026-04-22',
                'duration_days' => 2,
                'reason' => 'Surat dokter terlampir',
                'requested_at' => '2026-04-20',
                'status' => 'Disetujui',
                'reviewed_at' => '2026-04-20 15:00:00',
            ]
        );

        LeaveRequest::updateOrCreate(
            ['employee_id' => $employees['EMP-0003']->id, 'start_date' => '2026-03-02'],
            [
                'leave_type' => 'Cuti Khusus',
                'end_date' => '2026-03-03',
                'duration_days' => 2,
                'reason' => 'Keperluan keluarga',
                'requested_at' => '2026-02-28',
                'status' => 'Ditolak',
                'reviewed_at' => '2026-02-28 16:30:00',
                'reviewer_note' => 'Jadwal operasional belum memungkinkan.',
            ]
        );

        foreach ([
            'EMP-0001' => [6500000, 1250000, 150000],
            'EMP-0002' => [8000000, 1500000, 250000],
            'EMP-0003' => [5750000, 1100000, 100000],
        ] as $nik => [$baseSalary, $allowance, $deduction]) {
            PayrollRecord::updateOrCreate(
                ['employee_id' => $employees[$nik]->id, 'period' => 'Mei 2026'],
                [
                    'base_salary' => $baseSalary,
                    'allowance' => $allowance,
                    'attendance_deduction' => $deduction,
                    'status' => 'Siap Dibayar',
                ]
            );
        }
    }
}
