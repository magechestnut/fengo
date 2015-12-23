<?php

class Elegento_Newsletter_Model_System_Config_Source_File_Image extends Mage_Adminhtml_Model_System_Config_Backend_Image
{
	const EG_UPLOAD_DIR = 'elegento/file/image';
    const EG_UPLOAD_ROOT = 'media';

    public function getEGUploadDir()
    {
        return Mage::getBaseUrl(self::EG_UPLOAD_ROOT) . '/' . self::EG_UPLOAD_DIR;
    }

    protected function _getUploadDir()
    {
        $uploadDir = self::EG_UPLOAD_DIR;
        $uploadRoot = self::_getUploadRoot(self::EG_UPLOAD_ROOT);
        $uploadDir = $uploadRoot . '/' . $uploadDir;
        return $uploadDir;
    }

    protected function _getAllowedExtensions()
    {
        return array('ico', 'png', 'gif', 'jpg', 'jpeg', 'apng', 'svg');
    }

    protected function _getUploadRoot($token) {
        return Mage::getBaseDir($token);
    }
}