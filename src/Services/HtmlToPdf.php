<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class HtmlToPdf
{
    public static function generate_pdf($html)
    {
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);
        $dompdf->set_base_path('assets/bootstrap/css/bootstrap.min.css');
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
