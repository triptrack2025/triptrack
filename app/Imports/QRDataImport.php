<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRDataImport implements ToArray
{
    public function array(array $rows)
    {
        $qrDataList = [];
        
        if (empty($rows)) {
            return $qrDataList;
        }

        // Extract dynamic headers from the first row
        $headers = array_map('trim', $rows[0]);
        unset($rows[0]); // Remove header row

        foreach ($rows as $row) {
            $formattedData = [];
            
            foreach ($headers as $index => $header) {
                $formattedData[$header] = isset($row[$index]) ? trim($row[$index]) : '';
            }

            // Generate QR Code text dynamically
            $qrText = $this->generateQRText($formattedData);
            $qrCode = QrCode::size(200)->generate($qrText);

            $qrDataList[] = [
                'data' => $formattedData,
                'qrCode' => $qrCode,
            ];
        }

        return $qrDataList;
    }

    private function generateQRText($data)
    {
        $text = "";
        foreach ($data as $key => $value) {
            $text .= "$key: $value\n";
        }
        return $text;
    }
}
