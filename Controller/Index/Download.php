<?php
namespace MageSuite\DownloadableTermsAndConditions\Controller\Index;

class Download extends \Magento\Framework\App\Action\Action
    implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * @var \MageSuite\DownloadableTermsAndConditions\Model\PdfAgreement
     */
    protected $pdfAgreement;

    /**
     * @var \MageSuite\DownloadableTermsAndConditions\Helper\Configuration
     */
    protected $configuration;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \MageSuite\DownloadableTermsAndConditions\Model\PdfAgreement $pdfAgreement,
        \MageSuite\DownloadableTermsAndConditions\Helper\Configuration $configuration
    ) {
        parent::__construct($context);
        $this->fileFactory = $fileFactory;
        $this->pdfAgreement = $pdfAgreement;
        $this->configuration = $configuration;
    }

    public function execute()
    {
        $pdf = $this->pdfAgreement->getPdf();
        $fileName = $this->configuration->getPdfFileName() . '.pdf';

        return $this->fileFactory->create(
            $fileName,
            $pdf->Output($fileName, 'S'),
            \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR,
            'application/pdf'
        );
    }
}
