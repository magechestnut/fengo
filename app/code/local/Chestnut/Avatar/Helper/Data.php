<?php

class Chestnut_Avatar_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function enabledAvatar($store = null)
    {
        return Mage::getStoreConfig('chestnut_avatar/general/enabled', $store);
    }

    public function getCustomerAvatar($width = 125, $displayIfNoAvatar = false, $class = "")
    {
        $avatar = '';
        if ($this->enabledAvatar(Mage::app()->getStore()->getId())) {            
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $customerId = $customer->getId();

            if (!isset($customerId) && $displayIfNoAvatar) {
                $avatar = '<img src="' . Mage::getDesign()->getSkinUrl('images/chestnut/avatar/avatar.png') . '" width="' . $width . '" alt="avatar" class="' . $class . '"/>';
            } elseif ($customer->getAvatarSrc() == "" && $displayIfNoAvatar) {
                $avatar = '<img src="' . Mage::getDesign()->getSkinUrl('images/chestnut/avatar/avatar.png') . '" width="' . $width . '" alt="avatar" class="' . $class . '"/>';
            } elseif ($customer->getAvatarSrc() != "") {
                $avatar = '<img src="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "chestnut/avatar" . $customer->getAvatarSrc() . '" width="' . $width . '" alt="avatar" class="' . $class . '"/>';
            }
        }
        return $avatar;
    }

    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function getUploadUrl()
    {
        return Mage::getUrl() . "avatar/ajax/uploadPhoto";
    }

    public function processImage()
    {
        $session = $this->_getSession();
        $upload = new Zend_File_Transfer_Adapter_Http();
        $file = 'photo';

        try {
            $runValidation = $upload->isUploaded($file);
            if (!$runValidation) {
                return array();
            }

            $fileInfo = $upload->getFileInfo($file);
            $fileInfo = $fileInfo[$file];
        } catch (Exception $e) {
            if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > $this->_getUploadMaxFilesize()) {
                $errors[] = Mage::helper('chestnut_avatar')->__("The file you uploaded is larger than %s Megabytes allowed by server", $this->_bytesToMbytes($this->_getUploadMaxFilesize()));
                return $errors;
            } else {
                Mage::throwException(Mage::helper('chestnut_avatar')->__("Error uploading image"));
            }
        }

        $_dimentions = array();
        $_dimentions['maxwidth'] = '2000';
        $_dimentions['maxheight'] = '2000';
        $upload->addValidator('ImageSize', false, $_dimentions);

        $_allowed = $this->_parseExtensionsString("jpg/gif/png");
        if ($_allowed !== null) {
            $upload->addValidator('Extension', false, $_allowed);
        } else {
            $_forbidden = $this->_parseExtensionsString($this->getConfigData('forbidden_extensions'));
            if ($_forbidden !== null) {
                $upload->addValidator('ExcludeExtension', false, $_forbidden);
            }
        }

        $upload->addValidator('FilesSize', false, array('max' => $this->_getUploadMaxFilesize()));

        $this->_initFilesystem();

        if ($upload->isUploaded($file) && $upload->isValid($file)) {

            $extension = pathinfo(strtolower($fileInfo['name']), PATHINFO_EXTENSION);

            $fileName = Varien_File_Uploader::getCorrectFileName($fileInfo['name']);
            $dispersion = Varien_File_Uploader::getDispretionPath($fileName);
            $filePath = $dispersion;
            $destination = $this->getPhotoTargetDir() . $filePath;
            $this->_createWriteableDir($destination);
            $upload->setDestination($destination);

            $fileHash = md5(file_get_contents($fileInfo['tmp_name']));
            $filePath .= DS . $fileHash . '-' . time() . "." . $extension;

            $fileFullPath = $this->getPhotoTargetDir() . $filePath;
            $upload->addFilter('Rename', array('target' => $fileFullPath, 'overwrite' => true));
            if (!$upload->receive($file)) {
                Mage::throwException(Mage::helper('chestnut_avatar')->__("File upload failed"));
            }

            $_imageSize = @getimagesize($fileFullPath);
            if (is_array($_imageSize) && count($_imageSize) > 0) {
                $_width = $_imageSize[0];
                $_height = $_imageSize[1];
            } else {
                $_width = 0;
                $_height = 0;
            }
            $imageObj = new Varien_Image($fileFullPath);
            $imageObj->constrainOnly(TRUE);
            $imageObj->keepAspectRatio(TRUE);
            $imageObj->keepTransparency(TRUE);
            $imageObj->resize(150);
            $imageObj->save($fileFullPath);
            return ($filePath);
        } elseif ($upload->getErrors()) {
            $errors = array();
            foreach ($upload->getErrors() as $errorCode) {
                if ($errorCode == Zend_Validate_File_ExcludeExtension::FALSE_EXTENSION) {
                    $errors[] = Mage::helper('chestnut_avatar')->__("The file '%s' has an invalid extension", $fileInfo['name']);
                } elseif ($errorCode == Zend_Validate_File_Extension::FALSE_EXTENSION) {
                    $errors[] = Mage::helper('chestnut_avatar')->__("The file '%s' has an invalid extension", $fileInfo['name']);
                } elseif ($errorCode == Zend_Validate_File_ImageSize::WIDTH_TOO_BIG) {
                    $errors[] = Mage::helper('chestnut_avatar')->__("Maximum allowed image width for '%s' is %s px.", $fileInfo['name'], $_dimentions['maxwidth']);
                } elseif ($errorCode == Zend_Validate_File_ImageSize::HEIGHT_TOO_BIG) {
                    $errors[] = Mage::helper('chestnut_avatar')->__("Maximum allowed image height for '%s' is %s px.", $fileInfo['name'], $_dimentions['maxheight']);
                } elseif ($errorCode == Zend_Validate_File_FilesSize::TOO_BIG) {
                    $errors[] = Mage::helper('chestnut_avatar')->__("The file you uploaded is larger than %s Megabytes allowed by server", $fileInfo['name'], $this->_bytesToMbytes($this->_getUploadMaxFilesize()));
                }
            }
            if (count($errors) > 0) {
                return $errors;
            }
        } else {
            $errors[] = Mage::helper('chestnut_avatar')->__('File upload failed');
            return $errors;
        }
    }

    protected function _getUploadMaxFilesize()
    {
        return min($this->_getBytesIniValue('upload_max_filesize'), $this->_getBytesIniValue('post_max_size'));
    }

    protected function _getBytesIniValue($ini_key)
    {
        $_bytes = @ini_get($ini_key);

        // kilobytes
        if (stristr($_bytes, 'k')) {
            $_bytes = intval($_bytes) * 1024;
        // megabytes
        } elseif (stristr($_bytes, 'm')) {
            $_bytes = intval($_bytes) * 1024 * 1024;
        // gigabytes
        } elseif (stristr($_bytes, 'g')) {
            $_bytes = intval($_bytes) * 1024 * 1024 * 1024;
        }
        return (int) $_bytes;
    }

    public function getTargetDir($relative = false)
    {
        $fullPath = Mage::getBaseDir('media');
        return $relative ? str_replace(Mage::getBaseDir(), '', $fullPath) : $fullPath;
    }

    public function getPhotoTargetDir($relative = false)
    {
        return $this->getTargetDir($relative) . DS . 'chestnut/avatar';
    }

    protected function _initFilesystem()
    {
        $this->_createWriteableDir($this->getTargetDir());
        $this->_createWriteableDir($this->getPhotoTargetDir());

        // Directory listing and hotlink secure
        $io = new Varien_Io_File();
        $io->cd($this->getTargetDir());
        if (!$io->fileExists($this->getTargetDir() . DS . '.htaccess')) {
            $io->streamOpen($this->getTargetDir() . DS . '.htaccess');
            $io->streamLock(true);
            $io->streamWrite("Order deny,allow\nAllow from all\n");
            $io->streamWrite("Options -Indexes");
            $io->streamUnlock();
            $io->streamClose();
        }
    }

    protected function _createWriteableDir($path)
    {
        $io = new Varien_Io_File();
        if (!$io->isWriteable($path) && !$io->mkdir($path, 0777, true)) {
            Mage::throwException(Mage::helper('chestnut_avatar')->__("Cannot create writeable directory '%s'", $path));
        }
    }

    protected function _parseExtensionsString($extensions)
    {
        preg_match_all('/[a-z0-9]+/si', strtolower($extensions), $matches);
        if (isset($matches[0]) && is_array($matches[0]) && count($matches[0]) > 0) {
            return $matches[0];
        }
        return null;
    }
}
