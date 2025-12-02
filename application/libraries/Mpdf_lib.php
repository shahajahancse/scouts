<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class Mpdf_lib {

    public function __construct() {}

    public function create($options = []) {

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $config = array_merge([
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 5,

            'fontDir' => array_merge($fontDirs, [
                APPPATH . 'third_party/Nikosh'
            ]),

            'fontdata' => $fontData + [
                'nikosh' => [
                    'R' => 'Nikosh.ttf',
                ]
            ],

            'default_font' => 'nikosh',
        ], $options);

        return new Mpdf($config);
    }
}

