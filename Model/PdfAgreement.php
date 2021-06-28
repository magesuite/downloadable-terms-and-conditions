<?php

namespace MageSuite\DownloadableTermsAndConditions\Model;

class PdfAgreement
{
    /**
     * @var \MageSuite\DownloadableTermsAndConditions\Model\AgreementsProvider
     */
    protected $agreementsProvider;

    public function __construct(
        \MageSuite\DownloadableTermsAndConditions\Model\AgreementsProvider $agreementsProvider
    ) {
        $this->agreementsProvider = $agreementsProvider;
    }


    public function getPdf()
    {
        $pdf = $this->generatePdf();
        foreach ($this->agreementsProvider->getAgreements() as $agreement) {
            $pdf->writeHTML($agreement, true, false, true, false, '');
        }
        return $pdf;
    }

    protected function generatePdf()
    {
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->AddPage();

        return $pdf;
    }
}
