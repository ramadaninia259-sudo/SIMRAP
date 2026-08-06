<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PdfController extends Controller
{
    public function extract(Request $request)
    {
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:5120'
        ]);

        // 1. Convert PDF menjadi gambar
        $image = $this->convertPdfToImage($request->file('file_surat'));

        // 2. OCR gambar
        $text = $this->ocrImage($image);

        // 3. Deteksi template surat
        $data = $this->detectTemplate($text);

        // 4. Kirim hasil ke AJAX
        return response()->json($data);
    }

    /**
     * Convert PDF menjadi PNG
     */
    private function convertPdfToImage($pdfFile)
    {
        // Folder sementara
        $folder = storage_path('app/temp');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0777, true);
        }

        // Simpan PDF
        $pdfPath = $folder . DIRECTORY_SEPARATOR . 'surat.pdf';

        copy(
            $pdfFile->getRealPath(),
            $pdfPath
        );

        // Lokasi Poppler
        $poppler = 'C:\\poppler\\poppler\\Library\\bin\\pdftoppm.exe';

        // Nama output
        $output = $folder . DIRECTORY_SEPARATOR . 'hasil';

        // Convert PDF → PNG
        $command =
            "\"$poppler\" -png \"$pdfPath\" \"$output\"";

        exec($command);

        // Kembalikan lokasi gambar halaman pertama
        return $folder . DIRECTORY_SEPARATOR . 'hasil-1.png';
    }

    /**
     * OCR menggunakan Tesseract
     */
    private function ocrImage($imagePath)
    {
        // Lokasi Tesseract
        $tesseract = 'C:\\Tesseract-OCR\\tesseract.exe';

        // Lokasi output txt
        $outputTxt = storage_path('app/temp/hasil');

        // Jalankan OCR
        $command =
            "\"{$tesseract}\" ".
            "\"{$imagePath}\" ".
            "\"{$outputTxt}\" ".
            "-l ind";

        exec($command);

        // Cek apakah OCR berhasil
        if (!file_exists($outputTxt.'.txt')) {

            throw new \Exception("OCR gagal dijalankan.");

        }

        // Ambil isi file txt
        $text = file_get_contents($outputTxt.'.txt');
        // Rapikan hasil OCR
        $text = preg_replace('/\r\n|\r|\n/', ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    private function detectTemplate($text)
{
    $lower = strtolower($text);

    // Template Diskominfo Sumut
    if (
        str_contains($lower, 'sekretariat daerah') ||
        str_contains($lower, 'pemerintah provinsi sumatera utara')
    ) {
        return $this->parseDiskominfo($text);
    }

    // Template Kemendagri
    if (
        str_contains($lower, 'kementerian dalam negeri') ||
        str_contains($lower, 'politik dan pemerintahan umum')
    ) {
        return $this->parseKemendagri($text);
    }

    // Template lainnya
    return $this->parseGeneric($text);
}
    private function findLabel($text, $label)
    {
        $lines = preg_split('/\r\n|\r|\n/', $text);

        $jumlah = count($lines);

        for ($i = 0; $i < $jumlah; $i++) {

            $line = trim($lines[$i]);

            // -----------------------------
            // Samakan huruf kecil
            // -----------------------------
            if (stripos($line, $label) !== false) {

                // ===========================
                // CASE 1
                // Acara : Penutupan...
                // ===========================

                if (preg_match('/'.preg_quote($label,'/').'\s*:?\s*(.+)/i',$line,$m)){

                    $isi = trim($m[1]);

                    if($isi!=''){

                        return $isi;

                    }

                }

                // ===========================
                // CASE 2
                // Acara
                // :
                // Penutupan...
                // ===========================

                for($j=$i+1;$j<min($i+6,$jumlah);$j++){

                    $isi = trim($lines[$j]);

                    if($isi=='' || $isi==':'){

                        continue;

                    }

                    // berhenti kalau ketemu label baru

                    if(preg_match('/^(hari|tanggal|hari\/tanggal|pukul|waktu|tempat|acara|agenda|media|pakaian|hal|perihal)/i',$isi)){

                        break;

                    }

                    return $isi;

                }

            }

        }

        return '';

    }
    private function parseDiskominfo($text)
    { $data = [
            'judul_rapat'    => '',
            'tanggal'        => '',
            'jam_mulai'      => '',
            'jam_selesai'    => '',
            'tempat'         => '',
            'pimpinan_rapat' => '',
            'keterangan'     => '',
            'status'         => 'Terjadwal'
        ];

        // ==========================
        // Judul Rapat
        // ==========================

        $judul = $this->findLabel($text, 'hal');

        if ($judul == '') {
            $judul = $this->findLabel($text, 'agenda');
        }

        if ($judul == '') {
            $judul = $this->findLabel($text, 'acara');
        }

        $data['judul_rapat'] = $judul;

        // ==========================
        // Tanggal
        // ==========================

        $tanggal = $this->findLabel($text, 'tanggal');

        $bulan = [
            'januari' => '01',
            'februari' => '02',
            'maret' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'agustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12'
        ];

        if (preg_match('/(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})/i', $tanggal, $m)) {

            $tgl = str_pad($m[1], 2, '0', STR_PAD_LEFT);

            $bln = $bulan[strtolower($m[2])] ?? '01';

            $thn = $m[3];

            $data['tanggal'] = "$thn-$bln-$tgl";
        }

        // ==========================
        // Waktu
        // ==========================

        $waktu = $this->findLabel($text, 'waktu');

        if ($waktu == '') {
            $waktu = $this->findLabel($text, 'jam');
        }

        if (preg_match('/(\d{2})\.(\d{2})/', $waktu, $m)) {

            $data['jam_mulai'] = $m[1] . ':' . $m[2];

        }

        if (preg_match('/s\.d\.\s*(\d{2})\.(\d{2})/i', $waktu, $m)) {

            $data['jam_selesai'] = $m[1] . ':' . $m[2];

        }

        // ==========================
        // Tempat
        // ==========================

        $tempat = $this->findLabel($text, 'tempat');

        if ($tempat != '') {

            $tempat = preg_replace('/media\s*:.*$/is', '', $tempat);

            $tempat = trim($tempat);

        }

        $data['tempat'] = $tempat;

        // ==========================
        // Media
        // ==========================

        $media = $this->findLabel($text, 'media');

        if ($media != '') {

            $data['keterangan'] .= "Media : " . $media . "\n";

        }

        // ==========================
        // Keterangan
        // ==========================

        if (preg_match('/Sehubungan dengan hal tersebut,(.*?)Demikian/s', $text, $m)) {

            $data['keterangan'] .= trim($m[1]);

        }

        // ==========================
        // Pimpinan Rapat
        // ==========================

        if (preg_match('/Sekretaris.*?\n(.*?)(?:NIP|$)/is', $text, $m)) {

            $nama = trim($m[1]);

            $nama = preg_replace('/\s+/', ' ', $nama);

            $data['pimpinan_rapat'] = $nama;

        }

        return $data;
    }

private function parseKemendagri($text)
    {
        $data = [
            'judul_rapat'    => '',
            'tanggal'        => '',
            'jam_mulai'      => '',
            'jam_selesai'    => '',
            'tempat'         => '',
            'pimpinan_rapat' => '',
            'keterangan'     => '',
            'status'         => 'Terjadwal'
        ];

        // ==========================
        // Judul Rapat
        // ==========================

        $judul = $this->findLabel($text, 'hal');

        if ($judul == '') {
            $judul = $this->findLabel($text, 'agenda');
        }

        if ($judul == '') {
            $judul = $this->findLabel($text, 'acara');
        }

        $data['judul_rapat'] = $judul;

        // ==========================
        // Tanggal
        // ==========================

        $tanggal = $this->findLabel($text, 'tanggal');

        $bulan = [
            'januari' => '01',
            'februari' => '02',
            'maret' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'agustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12'
        ];

        if (preg_match('/(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})/i', $tanggal, $m)) {

            $tgl = str_pad($m[1], 2, '0', STR_PAD_LEFT);

            $bln = $bulan[strtolower($m[2])] ?? '01';

            $thn = $m[3];

            $data['tanggal'] = "$thn-$bln-$tgl";
        }

        // ==========================
        // Waktu
        // ==========================

        $waktu = $this->findLabel($text, 'waktu');

        if ($waktu == '') {
            $waktu = $this->findLabel($text, 'jam');
        }

        if (preg_match('/(\d{2})\.(\d{2})/', $waktu, $m)) {

            $data['jam_mulai'] = $m[1] . ':' . $m[2];

        }

        if (preg_match('/s\.d\.\s*(\d{2})\.(\d{2})/i', $waktu, $m)) {

            $data['jam_selesai'] = $m[1] . ':' . $m[2];

        }

        // ==========================
        // Tempat
        // ==========================

        $tempat = $this->findLabel($text, 'tempat');

        if ($tempat != '') {

            $tempat = preg_replace('/media\s*:.*$/is', '', $tempat);

            $tempat = trim($tempat);

        }

        $data['tempat'] = $tempat;

        // ==========================
        // Media
        // ==========================

        $media = $this->findLabel($text, 'media');

        if ($media != '') {

            $data['keterangan'] .= "Media : " . $media . "\n";

        }

        // ==========================
        // Keterangan
        // ==========================

        if (preg_match('/Sehubungan dengan hal tersebut,(.*?)Demikian/s', $text, $m)) {

            $data['keterangan'] .= trim($m[1]);

        }

        // ==========================
        // Pimpinan Rapat
        // ==========================

        if (preg_match('/Sekretaris.*?\n(.*?)(?:NIP|$)/is', $text, $m)) {

            $nama = trim($m[1]);

            $nama = preg_replace('/\s+/', ' ', $nama);

            $data['pimpinan_rapat'] = $nama;

        }

        return $data;
    }

   private function parseGeneric($text)
    {
        $data = [
            'judul_rapat'    => '',
            'tanggal'        => '',
            'jam_mulai'      => '',
            'jam_selesai'    => '',
            'tempat'         => '',
            'pimpinan_rapat' => '',
            'keterangan'     => '',
            'status'         => 'Terjadwal'
        ];

        // Bersihkan hasil OCR
        $clean = preg_replace('/\r\n|\r|\n/', ' ', $text);
        $clean = preg_replace('/\s+/', ' ', $clean);

        // ==========================
        // Judul
        // ==========================
        if (preg_match('/Hal\s*:\s*(.*?)(Nomor|Yth|Kepada|Dengan hormat)/i', $clean, $m)) {

            $data['judul_rapat'] = trim($m[1]);

        }

        // ==========================
        // Tanggal
        // ==========================
        if (preg_match('/(\d{1,2}\s+[A-Za-z]+\s+\d{4})/', $clean, $m)) {

            $data['tanggal'] = trim($m[1]);

        }

        // ==========================
        // Jam Mulai
        // ==========================
        if (preg_match('/(\d{2}\.\d{2})/', $clean, $m)) {

            $data['jam_mulai'] = str_replace('.', ':', $m[1]);

        }

        // ==========================
        // Tempat
        // ==========================
        if (preg_match('/tempat\s*:\s*(.*?)(acara|agenda|media|$)/i', $clean, $m)) {

            $data['tempat'] = trim($m[1]);

        }

        // ==========================
        // Keterangan
        // ==========================
        $data['keterangan'] = substr($clean, 0, 500);

        return $data;
    }
}