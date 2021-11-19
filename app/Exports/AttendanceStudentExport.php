<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceStudentExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return AttendanceStudent::query();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Presensi',
            'Waktu Presensi',
            'Status'
        ];
    }

    public function map($attendanceStudent): array
    {
        return [
            $attendanceStudent->student->nis,
            $attendanceStudent->student->name,
            $attendanceStudent->attendance->name,
            $attendanceStudent->check_in,
            $attendanceStudent->status == "present" ? "Hadir" : $attendanceStudent->status
        ];
    }
}
