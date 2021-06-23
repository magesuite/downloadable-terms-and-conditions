define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/utils/wrapper',
    'mage/translate',
    'mage/url'
], function($, modal, wrapper, $t, url) {
    'use strict';


    return function (agreementModal) {
        agreementModal.createModal = wrapper.wrapSuper(agreementModal.createModal, function (element) {
            var options;
            this.modalWindow = element;

            options = {
                'type': 'popup',
                'modalClass': 'agreements-modal',
                'responsive': true,
                'innerScroll': true,
                'trigger': '.show-modal',
                'buttons': [
                    {
                        text: $t('Close'),
                        class: 'action secondary action-hide-popup',

                        /** @inheritdoc */
                        click: function () {
                            this.closeModal();
                        }
                    },
                    {
                        text: $t('Download'),
                        class: 'action secondary action-download',

                        /** @inheritdoc */
                        click: function () {
                            window.location = url.build('terms_and_conditions/index/download');
                        }
                    }
                ]
            };
            modal(options, $(this.modalWindow));

            return modal;
        });

        return agreementModal;
    };
});
