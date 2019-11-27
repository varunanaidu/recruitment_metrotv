<?php
// get the HTML
    //ob_start();

    // include(dirname(__FILE__).'/personal_absen_rekap_all_admin_pdf.php');    
    echo $data;

    $content = ob_get_clean();

    // convert in PDF
	//$footer = '<page_footer>  test test satu dua tiga .......</page_footer> ';
	$content = '<page>'.$content.'</page>';  

	//echo $content;

    require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/media/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 30));
        // $html2pdf = new HTML2PDF('L', 'A4', 'fr', true, 'UTF-8', array(15,5,20,30));
        //$html2pdf->SetMargins(10,18);
        $html2pdf->pdf->SetDisplayMode('fullpage');

        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output("_Report-candidat-progress" . date('Ymd') . ".pdf");
    }
    //echo $html2pdf;
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    

?>