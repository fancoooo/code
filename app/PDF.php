<?php
    // require_once('../tcpdf/tcpdf.php');
    // require_once('../tcpdf/examples/tcpdf_include.php');
    //require __DIR__ . '../tcpdf/tcpdf_import.php';
    require  '../tcpdf/tcpdf.php';
    //require __DIR__ . '../tcpdf/include/tcpdf_static.php';

    class PDF extends TCPDF {
        public function Header (){                       
             $this->SetFont('dejavusans', '', 14);
             $title = utf8_encode('title');
             $subtitle = utf8_encode('sub title');
             $this->SetHeaderMargin(40);            
             $this->Line(15,23,405,23);      
        }
    
        public function Footer() {
            $this->SetFont('dejavusans', '', 8);
            $this-> Cell (0, 5, 'Pag '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }   
    
        public static function makeHTML (){
            $html = '<table border="0.5" cellspacing="0" cellpadding="4">
            <tr>
                <th bgcolor="#DAB926" style="width:3%; text-align:left"><strong>you th</strong></th>      
            </tr>';
            
            return $html;           
        }   
    }
    
    function printReport ()
    {
        set_time_limit(0);
    
        $pdf = new PDF("L", PDF_UNIT, "A6",true, 'UTF-8', false);
    
        $pdf->SetMargins (15, 27, 15, true);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->SetAutoPageBreak(TRUE,50);
        $pdf->AddPage();
    
        //create html
        $html = $pdf->makeHTML();  
    
    
        $pdf->writeHTML($html, false, false, false, false, '');
    
        if (!file_exists("../PDF/"))
            mkdir("../PDF/");
    
        $pdf->Output("../PDF/file.pdf", 'F');  //save pdf
        //$file = fopen($_SERVER['DOCUMENT_ROOT'].'/PDF/'.'file', 'wb');
        $pdf->Output('../PDF/file.pdf', 'I'); // show pdf
    
        return true;
    }
    
    printReport();
?>