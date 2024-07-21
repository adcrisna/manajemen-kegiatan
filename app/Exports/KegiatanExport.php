<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class KegiatanExport implements FromView,ShouldAutoSize,WithColumnFormatting,WithCustomValueBinder
{
    private $date;

     public function __construct($tanggalAwal, $tanggalAkhir, $jenisKegiatan)
    {
        $this->awal = $tanggalAwal;
        $this->akhir = $tanggalAkhir;
        $this->jenis = $jenisKegiatan;
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path('/logo.png'));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A1');

    //     return $drawing;
    // }
    public function view(): View
    {
        $awal = $this->awal;
        $akhir = $this->akhir;
        $jenis = $this->jenis;
        $start = date("Y-m-d 00:00:00", strtotime($awal));
        $end = date("Y-m-d 23:59:59", strtotime($akhir));
        return view('excel.kegiatan', [
            'kegiatan' => Kegiatan::where('jenis_kegiatan',$jenis)
            ->whereBetween('created_at', [$start, $end])->get()
        ]);
    }

    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, DataType::TYPE_STRING);
        return true;

    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
