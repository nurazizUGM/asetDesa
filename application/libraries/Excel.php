<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/PhpSpreadsheet/Autoloader.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel
{
    public function load($file)
    {
        return IOFactory::load($file);
    }
}
