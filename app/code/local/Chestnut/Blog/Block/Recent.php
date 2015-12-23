<?php

class Chestnut_Blog_Block_Recent extends Chestnut_Blog_Block_Abstract
{
    public function getRecent()
    {
        $size = self::$_helper->getRecentPage();

        if ($size) {
            $collection = clone self::$_collection; 
            //$collection->setPageSize($size);

            foreach ($collection as $item) {
                $item->setAddress($this->getBlogUrl($item->getIdentifier()));
            }

            return $collection;
        }

        return false;
    }
}