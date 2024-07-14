<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'../vendor/autoload.php';
use Dompdf\Dompdf;

class My_pdf
{
    protected $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    public function loadHtml($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation = 'portrait')
    {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function output($file_path)
    {
        $output = $this->dompdf->output();
        if(file_put_contents($file_path, $output)){
            return true;
        }else{
            return false;
        }
    }
}
