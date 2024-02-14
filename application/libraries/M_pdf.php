<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . '/third_party/mpdf/mpdf.php';

class M_pdf {

    public $param;
    public $pdf;

    public function __construct($param = array(
        'mode' => '',
        'format' => 'A4',
        'font_size' => 0,
        'font_default' => '',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 16,
        'margin_bottom' => 16,
        'margin_header' => 9,
        'margin_footer' => 9,
        'oriental' => 'P'
    )) {
        $this->param = $param;
        $this->pdf = new mPDF($param['mode'],$param['format'],$param['font_size'],$param['font_default'],
                $param['margin_left'],$param['margin_right'],$param['margin_top'],$param['margin_bottom'],
                $param['margin_header'],$param['margin_footer'],$param['oriental']);
    }

}
