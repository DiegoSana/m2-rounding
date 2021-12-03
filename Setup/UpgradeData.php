<?php

namespace Sofar\Rounding\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var QuoteSetupFactory
     */
    private $_quoteSetupFactory;
    /**
     * @var SalesSetupFactory
     */
    private $_salesSetupFactory;

    /**
     * UpgradeData constructor.
     * @param QuoteSetupFactory $quoteSetupFactory
     * @param SalesSetupFactory $salesSetupFactory
     */
    public function __construct(
        QuoteSetupFactory $quoteSetupFactory,
        SalesSetupFactory $salesSetupFactory
    ) {
        $this->_quoteSetupFactory = $quoteSetupFactory;
        $this->_salesSetupFactory = $salesSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $quoteInstaller = $this->_quoteSetupFactory->create(['setup' => $setup]);
        $salesInstaller = $this->_salesSetupFactory->create(['setup' => $setup]);

        if (version_compare($context->getVersion(), '1.0.0') < 1) {
            $quoteTables = ['quote', 'quote_address'];
            foreach ($quoteTables as $table) {
                $quoteInstaller->addAttribute($table, 'grand_total_rounding', [
                    'type' => 'decimal',
                    'comment' => 'Grand Total Rounding',
                    'required' => false,
                    'after' => 'grand_total'
                ]);
                $quoteInstaller->addAttribute($table, 'base_grand_total_rounding', [
                    'type' => 'decimal',
                    'comment' => 'Base Grand Total Rounding',
                    'required' => false,
                    'after' => 'base_grand_total'
                ]);
            }

            $salesTables = ['order'];
            foreach ($salesTables as $table) {
                $salesInstaller->addAttribute($table, 'grand_total_rounding', [
                    'type' => 'decimal',
                    'comment' => 'Grand Total Rounding',
                    'required' => false,
                    'after' => 'grand_total'
                ]);
                $salesInstaller->addAttribute($table, 'base_grand_total_rounding', [
                    'type' => 'decimal',
                    'comment' => 'Base Grand Total Rounding',
                    'required' => false,
                    'after' => 'base_grand_total'
                ]);
            }
        }

        $setup->endSetup();
    }
}
