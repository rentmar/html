<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * Libreria Pdf para php
 */

require_once APPPATH . "/third_party/tcpdf/tcpdf.php";

class Pdf extends TCPDF
{
    protected $CI;
    public function __construct() {
        parent::__construct();
        $this->CI =& get_instance();
    }    
    
}
