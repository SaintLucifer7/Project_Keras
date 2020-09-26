<?php

namespace App\Exports;

use App\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class CartExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize, WithCustomStartCell
{
    use Exportable, RegistersEventListeners;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cart::all();
    }

    public function startCell(): string
    {
        return 'A6';
    }

    public function headings(): array
    {
        return [
            'No.',
            'Kode Barang',
            '     Nama Barang     ',
            'Harga Satuan',
            'QTY',
            'Jumlah',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class=>function(BeforeSheet $event){
                $event->sheet->mergeCells('B2:C2');
                $event->sheet->mergeCells('A5:B5');
                $event->sheet->mergeCells('A4:B4');
                $event->sheet->mergeCells('E2:F2');
                $event->sheet->mergeCells('E3:F3');
                $event->sheet->mergeCells('E4:F4');
                $event->sheet->mergeCells('B5:C5');
                $event->sheet->setCellValue('B2', 'SURYA INDO PERKASA');
                $event->sheet->setCellValue('A5', 'NOTA FAKTUR NO. :');
                $event->sheet->setCellValue('A4', 'Tanggal: ');
                $event->sheet->setCellValue('E1', 'Kepada Yth, ');

            },
            AfterSheet::class=>function(AfterSheet $event){
                $event->sheet->getStyle('A6:F6')->applyFromArray([
                    'font' =>[
                        'bold' => true
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
                $event->sheet->getStyle('E19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $event->sheet->getStyle('F19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $event->sheet->getStyle('A6:F6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A7:A18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B7:B18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('F19', '=SUM(F7:F18)');
                $event->sheet->setCellValue('B19', 'Diterima Oleh: ');
                $event->sheet->setCellValue('D19', 'Hormat Kami, ');
                $event->sheet->setCellValue('E19', 'TOTAL');
                $event->sheet->getStyle('E19')->applyFromArray([
                    'font' =>[
                        'bold' => true
                    ],
                ]);
                $event->sheet->getStyle('A19:F19')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },
        ];
    }
}
