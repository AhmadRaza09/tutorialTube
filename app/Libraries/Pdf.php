<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

 namespace App\Libraries;
// Include the main TCPDF library (search for installation path).
include_once (APPPATH . 'libraries\tcpdf\tcpdf.php');

class Pdf extends \TCPDF
{
    public function __construct($para1, $para2, $para3, $para4, $para5, $para6)
    {
        parent::__construct($para1, $para2, $para3, $para4, $para5, $para6);
    }
}
