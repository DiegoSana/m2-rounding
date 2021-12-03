define([
    'Magento_Checkout/js/view/summary/abstract-total',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/totals',
    'ko'
], function (Component, quote, totals, ko) {
    'use strict';

    return Component.extend({
        totals: quote.getTotals(),

        /**
         *
         * @returns {boolean}
         */
        isDisplayed: function () {
            return this.getEnabled() && this.getPureValue() && this.getPureValue() !== 0;
        },

        /**
         * Get pure value.
         *
         * @return {*}
         */
        getPureValue: function () {
            var value = 0;

            if (this.totals() && totals.getSegment('grand_total_rounding')) {
                value = totals.getSegment('grand_total_rounding').value;
            }

            return value;
        },

        /**
         * @return {*|String}
         */
        getValue: function () {
            return this.getFormattedPrice(this.getPureValue());
        },

        /**
         * @return {*}
         */
        getEnabled: function () {
            return window.checkoutConfig.sofar_rounding.enabled;
        },

        /**
         * @return {*}
         */
        getTitle: function () {
            return window.checkoutConfig.sofar_rounding.label;
        }
    });
});