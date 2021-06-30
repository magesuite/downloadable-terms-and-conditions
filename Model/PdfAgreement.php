<?php

namespace MageSuite\DownloadableTermsAndConditions\Model;

class PdfAgreement
{
    public const PDF_PAGE_ORIENTATION = 'P';
    public const PDF_UNIT = 'mm';
    public const PDF_PAGE_FORMAT = 'A4';
    public const PDF_FONT_NAME_MAIN = 'helvetica';
    public const PDF_FONT_SIZE_MAIN = 10;
    public const PDF_FONT_NAME_DATA = 'helvetica';
    public const PDF_FONT_SIZE_DATA = 8;
    public const PDF_FONT_MONOSPACED = 'courier';

    public const PDF_FONT_NAME = 'dejavusans';
    public const PDF_FONT_SIZE = 10;

    public const PDF_MARGIN_LEFT = 15;
    public const PDF_MARGIN_TOP = 27;
    public const PDF_MARGIN_RIGHT = 15;
    public const PDF_MARGIN_BOTTOM = 25;
    public const PDF_MARGIN_HEADER = 5;
    public const PDF_MARGIN_FOOTER = 10;

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
        $pdf = new \TCPDF(self::PDF_PAGE_ORIENTATION, self::PDF_UNIT, self::PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setHeaderFont(Array(self::PDF_FONT_NAME_MAIN, '', self::PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(self::PDF_FONT_NAME_DATA, '', self::PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(self::PDF_FONT_MONOSPACED);
        $pdf->SetMargins(self::PDF_MARGIN_LEFT, self::PDF_MARGIN_TOP, self::PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(self::PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(self::PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, self::PDF_MARGIN_BOTTOM);
        $pdf->SetFont(self::PDF_FONT_NAME, '', self::PDF_FONT_SIZE);
        $pdf->AddPage();

        return $pdf;
    }
}
