<?php
namespace MageSuite\DownloadableTermsAndConditions\Model;

class AgreementsProvider
{
    /**
     * @var \Magento\CheckoutAgreements\Api\CheckoutAgreementsListInterface
     */
    protected $checkoutAgreementsList;

    /**
     * @var \Magento\CheckoutAgreements\Model\Api\SearchCriteria\ActiveStoreAgreementsFilter
     */
    protected $activeStoreAgreementsFilter;

    public function __construct(
        \Magento\CheckoutAgreements\Api\CheckoutAgreementsListInterface $checkoutAgreementsList,
        \Magento\CheckoutAgreements\Model\Api\SearchCriteria\ActiveStoreAgreementsFilter $activeStoreAgreementsFilter
    ) {
        $this->checkoutAgreementsList = $checkoutAgreementsList;
        $this->activeStoreAgreementsFilter = $activeStoreAgreementsFilter;
    }

    public function getAgreements()
    {
        $agreementsList = $this->checkoutAgreementsList->getList(
            $this->activeStoreAgreementsFilter->buildSearchCriteria()
        );

        foreach ($agreementsList as $agreement) {
            $agreements[] = $agreement->getContent();
        }

        return $agreements;
    }
}
