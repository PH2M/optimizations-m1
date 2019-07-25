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
 * Class PH2M_PhOptimizations_Model_Override_Cms_Page
 */
class PH2M_PhOptimizations_Model_Override_Cms_Page extends Mage_Cms_Model_Page
{
    /**
     * @inheritDoc
     */
    public function load($id, $field=null)
    {
        if (is_null($id)) {
            return $this->noRoutePage();
        }

        $cacheId    = 'MODEL_CMS_PAGE_' . $id . '_' . $field . '_STORE_' . Mage::app()->getStore()->getId();
        $cacheTags  = [self::CACHE_TAG . '_' . $id];

        if ($pageCache = Mage::app()->loadCache($cacheId)) {
            $data = unserialize($pageCache);
            if (!empty($data)) {
                foreach ($data as $key => &$value){
                    $this->$key = $value;
                }
                unset($value);
            }
        } else {
            parent::load($id, $field);
            Mage::app()->saveCache(serialize(get_object_vars($this)), $cacheId, $cacheTags);
        }

        return $this;
    }
}
