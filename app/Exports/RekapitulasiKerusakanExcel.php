<?php

namespace App\Exports;

use App\Models\BuktiKerusakan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RekapitulasiKerusakanExcel implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithDrawings
{
    private $rows = [];
    private $currentRow = 2;

    public function collection()
    {
        return BuktiKerusakan::with(['userInspektor', 'gedung', 'buktiPerbaikan', 'inspeksiGedung'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Objek Kerusakan',
            'Deskripsi',
            'Gedung',
            'Pelapor',
            'Lokasi',
            'Tipe Kerusakan',
            'Foto',
            'Status',
            'Waktu Dilaporkan',
            'Tipe Pelaporan'
        ];
    }

    public function map($bukti): array
    {
        $status = $bukti->buktiPerbaikan ? 'Kasus Ditutup' : 'Menunggu Perbaikan';
        $waktu = \Carbon\Carbon::parse($bukti->created_at)->translatedFormat('d F Y H:i');

        $fotoText = 'Tidak ada foto';

        if ($bukti->file_bukti_kerusakan) {
            $fullPath = storage_path('app/public/' . $bukti->file_bukti_kerusakan);
            if (file_exists($fullPath)) {
                $fotoText = '✓ Foto Tersedia';
                $this->rows[] = [
                    'path' => $fullPath,
                    'row'  => $this->currentRow
                ];
            }
        }

        $data = [
            $this->currentRow - 1,
            $bukti->judul_bukti_kerusakan,
            $bukti->deskripsi_bukti_kerusakan,
            implode(' - ', array_filter([
                $bukti->gedung?->nama_gedung,
                $bukti->inspeksiGedung?->gedung?->nama_gedung
            ])),
            $bukti->userInspektor->name,
            $bukti->lokasi_bukti_kerusakan,
            $bukti->tipe_kerusakan,
            $fotoText,
            $status,
            $waktu,
            $bukti->tipe_pelaporan
        ];

        $this->currentRow++;
        return $data;
    }

    public function drawings()
    {
        $drawings = [];
        foreach ($this->rows as $foto) {
            $drawing = new Drawing();
            $drawing->setName('Foto');
            $drawing->setDescription('Foto Bukti Kerusakan');
            $drawing->setPath($foto['path']);
            $drawing->setHeight(180); // ✅ lebih besar lagi
            $drawing->setResizeProportional(true);
            $drawing->setCoordinates('H' . $foto['row']);
            $drawing->setOffsetX(0);
            $drawing->setOffsetY(0);
            $drawings[] = $drawing;
        }
        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        $totalRows = $sheet->getHighestRow();
        for ($row = 2; $row <= $totalRows; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(150); // ✅ row lebih tinggi lagi
        }

        // Style untuk header
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4e73df'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Style untuk data
        if ($totalRows > 1) {
            $sheet->getStyle('A2:K' . $totalRows)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ]);

            $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 30,
            'C' => 40,
            'D' => 25,
            'E' => 25,
            'F' => 25,
            'G' => 20,
            'H' => 40, // ✅ kolom foto lebih lebar lagi
            'I' => 25,
            'J' => 30,
            'K' => 25,
        ];
    }
}
