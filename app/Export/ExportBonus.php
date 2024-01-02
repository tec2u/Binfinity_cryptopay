<?php

namespace App\Export;

use App\Models\SaveDateBonusDaily;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportBonus
{
    public  static function saveExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Valor Pago');
        $sheet->setCellValue('B1', 'Data de Pagamento');

        $users = SaveDateBonusDaily::all();
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->amount_paid);
            $sheet->setCellValue('B' . $row, $user->date_paid);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="relatorio' . date("Y-m-d") . '.xlsx"');

        $writer->save('php://output');
    }
}
