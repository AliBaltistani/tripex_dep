<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/vendor/autoload.php';
use Dompdf\Dompdf;

class Pdf {
    protected $CI;
    protected $pdf;

    public function __construct() {
        $this->CI =& get_instance();
        $this->pdf = new TCPDF();
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Your Name');
        $this->pdf->SetTitle('Document');
        $this->pdf->SetSubject('Document');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $this->pdf->SetHeaderData('', '', 'TCPDF Example', 'PDF Example', array(0,64,255), array(0,64,128));
        $this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    }

    public function generate($view, $data = array(), $filename = 'document.pdf') {
        $output = $this->CI->load->view($view, $data, true);
        $this->pdf->AddPage();
        $this->pdf->writeHTML($output, true, false, true, false, '');
        $this->pdf->Output($filename, 'I');
    }
}
