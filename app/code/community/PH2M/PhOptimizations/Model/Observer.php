<?php
/**
 * 2011-2019 PH2M
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is available
 * through the world-wide-web at this URL: http://www.opensource.org/licenses/OSL-3.0
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to contact@ph2m.com so we can send you a copy immediately.
 *
 * @author PH2M - contact@ph2m.com
 * @copyright 2011-2019 PH2M
 * @license http://www.opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

/**
 * Class PH2M_PhOptimizations_Model_Observer
 */
class PH2M_PhOptimizations_Model_Observer
{
    /**
     * @param Varien_Object $observer
     */
    public function cmsPageSaveAfter(Varien_Object $observer)
    {
        /** @var Mage_Cms_Model_Page $cmsPage */
        $cmsPage = $observer->getEvent()->getDataObject();

        if ($cmsPage && $cmsPageId = $cmsPage->getId()) {
            Mage::app()->cleanCache([Mage_Cms_Model_Page::CACHE_TAG . '_' . $cmsPageId]);
            Mage::app()->cleanCache([Mage_Cms_Model_Page::CACHE_TAG . '_' . $cmsPage->getIdentifier()]);
        }
    }
}
