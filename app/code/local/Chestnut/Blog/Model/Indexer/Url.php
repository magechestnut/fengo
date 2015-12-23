<?php

class Chestnut_Blog_Model_Indexer_Url extends Mage_Index_Model_Indexer_Abstract
{
    const EVENT_MATCH_RESULT_KEY = 'blog_url_match_result';

    protected $_matchedEntities = array(
        // Chestnut_Blog_Model_Post::ENTITY => array(
        //     Mage_Index_Model_Event::TYPE_SAVE,
        //     Mage_Index_Model_Event::TYPE_MASS_ACTION,
        //     Mage_Index_Model_Event::TYPE_DELETE
        // ),
        // Chestnut_Blog_Model_Category::ENTITY => array(
        //     Mage_Index_Model_Event::TYPE_SAVE,
        //     Mage_Index_Model_Event::TYPE_MASS_ACTION,
        //     Mage_Index_Model_Event::TYPE_DELETE
        // ),
        Mage_Core_Model_Config_Data::ENTITY => array(
            Mage_Index_Model_Event::TYPE_SAVE
        )
    );

    protected $_routeName = '';

    protected $_relatedConfigSettings = array(
        Chestnut_Blog_Helper_Data::XML_PATH_BLOG_ROUTE
    );

    public function getName()
    {
        return Mage::helper('blog')->__('Blog URL Rewrites');
    }

    public function getDescription()
    {
        return Mage::helper('blog')->__('Index posts and blog categories URL rewrites');
    }

    public function matchEvent(Mage_Index_Model_Event $event)
    {
        $data = $event->getNewData();
        if (isset($data[self::EVENT_MATCH_RESULT_KEY])) {
            return $data[self::EVENT_MATCH_RESULT_KEY];
        }

        $entity = $event->getEntity();
        if ($entity == Mage_Core_Model_Config_Data::ENTITY) {
            $configData = $event->getDataObject();
            if ($configData && in_array($configData->getPath(), $this->_relatedConfigSettings)) {
                $this->_routeName = $configData->getValue();
                $result = $configData->isValueChanged();
            } else {
                $result = false;
            }
        } else {
            $result = parent::matchEvent($event);
        }

        $event->addNewData(self::EVENT_MATCH_RESULT_KEY, $result);

        return $result;
    }

    protected function _registerEvent(Mage_Index_Model_Event $event)
    {
        $event->addNewData(self::EVENT_MATCH_RESULT_KEY, true);
        $dataObject = $event->getDataObject();
        $entity = $event->getEntity();
        switch ($entity) {
            // case Chestnut_Blog_Model_Post::ENTITY:
            //     $this->_registerPostEvent($event);
            //     break;
            // case Chestnut_Blog_Model_Category::ENTITY:
            //     $this->_registerCategoryEvent($event);
            //     break;

            case Mage_Core_Model_Config_Data::ENTITY:
                if ($dataObject->getUrlReindexAll()) {
                    $event->addNewData('blog_url_reindex_all', true);
                }
                $process = $event->getProcess();
                $process->changeStatus(Mage_Index_Model_Process::STATUS_REQUIRE_REINDEX);
                break;
        }
        return $this;
    }

    // protected function _registerPostEvent(Mage_Index_Model_Event $event)
    // {
    //     $post = $event->getDataObject();
    //     $dataChange = $post->dataHasChangedFor('identifier');

    //     if ($dataChange) {
    //         $event->addNewData('rewrite_post_identifier', array($post->getIdentifier()));
    //     }
    // }

    // protected function _registerCategoryEvent(Mage_Index_Model_Event $event)
    // {
    //     $category = $event->getDataObject();
    //     $dataChange = $category->dataHasChangedFor('identifier');

    //     if ($dataChange) {
    //         $event->addNewData('rewrite_category_identifier', array($category->getIdentifier()));
    //     }
    // }

    protected function _processEvent(Mage_Index_Model_Event $event)
    {
        $data = $event->getNewData();
        if (!empty($data['blog_url_reindex_all']) && $data['blog_url_reindex_all']) {
            $this->reindexAll();

            $process = $event->getProcess();
            $process->changeStatus(Mage_Index_Model_Process::STATUS_PENDING);
        }
    }

    public function reindexAll()
    {
        Mage::getSingleton('blog/blog')->refreshRewrites($this->_routeName);
        Mage::getSingleton('blog/post')->refreshRewrites($this->_routeName);
        Mage::getSingleton('blog/category')->refreshRewrites($this->_routeName);
    }
}
