<?php

//Print
function printPdf(){
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 002');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('times', 'BI', 20);

    // add a page
    $pdf->AddPage();

// set some text to print
$txt = <<<EOD
TCPDF Example 002

Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'D');

}

function printPdf1(){
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,  array(300,100), true, 'UTF-8', false);
    // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(10, 10, 10,true);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // ---------------------------------------------------------
    // set default font subsetting mode
    // $pdf->SetFont('mm3', '', 11);
    // $pdf->SetFont('ddd', '', 11);
    $pdf->SetFont('aaa', '', 11);
    // $pdf->SetFont('myanmar1', '', 11);
    $pdf->AddPage();

    $content = '';

    $content .= '
        <style>
            h3 {
                font-size: 24pt;
                text-decoration: underline;
            }
            table.first{
                border: 0.5px solid #000;
            }
            td.first-row{
                border: 1px solid #000;
                background-color:#C8C8C8;
            }   
            td.third-row{
                border: 1px solid #000;
            }
            td.second-row{
                border-left: 1px solid #000;
            }
            table.first td{
                line-height: 20px;
            }
        </style>
        
        <p>အန္တီေလး
            <br>Phone&nbsp;&nbsp;&nbsp;: 09-975708911
            <br>Address : ဘုရားေစ်းအနီး
        </p>
        <table class="first">
            <tr>
                <td align="center" width="30" class="first-row">NO</td>
                <td align="center" width="70" class="first-row">အမ်ိဳးအမည္</td>
                <td align="center" width="40" class="first-row">ႏွုန္း</td>
                <td align="center" width="40" class="first-row">QTY</td>
                <td align="center" width="50" class="first-row">စုစုေပါင္း</td>
            </tr>
            <tr>
                <td align="center" class="second-row">1</td>
                <td align="left" class="second-row">သံ</td>
                <td align="right" class="second-row">200</td>
                <td align="right" class="second-row">1</td>
                <td align="right" class="second-row">200</td>
            </tr>
            <tr>
                <td align="center" class="second-row">1</td>
                <td align="left" class="second-row">သံ</td>
                <td align="right" class="second-row">200</td>
                <td align="right" class="second-row">1</td>
                <td align="right" class="second-row">200</td>
            </tr>
            <tr>
                <td align="center" class="second-row">1</td>
                <td align="left" class="second-row">သံ</td>
                <td align="right" class="second-row">200</td>
                <td align="right" class="second-row">1</td>
                <td align="right" class="second-row">200</td>
            </tr>
            <tr>
                <td align="center" class="second-row">1</td>
                <td align="left" class="second-row">သံ</td>
                <td align="right" class="second-row">200</td>
                <td align="right" class="second-row">1</td>
                <td align="right" class="second-row">200</td>
            </tr>
            <tr>
                <td colspan="4" align="right" style="border-left-style: none;" class="third-row">TOTAL</td>
                <td class="third-row">200,000</td>
            </tr>
        </table>
    ';

    // $content .= fetch_data();
    // $content .= '</table>';
    $pdf->writeHTML($content);
    if(isset($_POST['create_pdf'])){
        $pdf->Output('test.pdf', 'I');
    }else{
        $pdf->Output('test.pdf', 'D');
    }
}