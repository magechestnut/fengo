<?php

class Chestnut_Menu_Block_Adminhtml_Category_Tab_Menu extends Mage_Adminhtml_Block_Catalog_Form
{
	protected $_category;

	public function getCategory()
    {
        if (!$this->_category) {
            $this->_category = Mage::registry('category');
        }
        return $this->_category;
    }
	
	public function _prepareLayout()
    {
		parent::_prepareLayout();
        $form = new Varien_Data_Form();
        $form->setDataObject($this->getCategory());

        $fieldset = $form->addFieldset('menu_fieldset', array(
        	'legend'	=> Mage::helper('egmenu')->__('Menu Custom Blocks'),
        	'class'		=> 'fieldset-wide',
        ));

        if ($this->getCategory()->getId()) {
        	$fieldset->addField('egmcat', 'hidden', array(
				'name'				=> 'cat_id',
				'value'				=> $this->getCategory()->getId()
			));
			$fieldset->addField('egmtop', 'editor', array(
				'label'				=> 'Top Static Block',
				'name'				=> 'top_block',
				'config'			=> Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
				'wysiwyg'			=> true,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
			$fieldset->addField('egmbottom', 'editor', array(
				'label'				=> 'Bottom Static Block',
				'name'				=> 'bottom_block',
				'config'			=> Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
				'wysiwyg'			=> true,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
			$fieldset->addField('egmright', 'editor', array(
				'label'				=> 'Right Static Block',
				'name'				=> 'right_block',
				'config'			=> Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
				'wysiwyg'			=> true,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
			$fieldset->addField('egmright_width', 'select', array(
				'label'				=> 'Right Block Width',
				'name'				=> 'right_block_width',
				'values'			=> Mage::getSingleton('egmenu/category_attribute_source_width')->getAllOptions(),
				'required'			=> false,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
			$fieldset->addField('egmleft', 'editor', array(
				'label'				=> 'Left Static Block',
				'name'				=> 'left_block',
				'config'			=> Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
				'wysiwyg'			=> true,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
			$fieldset->addField('egmleft_width', 'select', array(
				'label'				=> 'Left Block Width',
				'name'				=> 'left_block_width',
				'values'			=> Mage::getSingleton('egmenu/category_attribute_source_width')->getAllOptions(),
				'required'			=> false,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
			$fieldset->addField('egm_label', 'select', array(
				'label'				=> 'Category Label',
				'name'				=> 'category_label',
				'values'			=> Mage::getSingleton('egmenu/category_attribute_source_categorylabel')->getAllOptions(),
				'required'			=> false,
				'global'			=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
			));
		} else {
			$fieldset->addField('note', 'note', array(
				'text'     => Mage::helper('egmenu')->__('Please select category or if you create new category, at first you should save the category to show attribute fields below.'),
			));
		}

		$egmData = Mage::getModel('egmenu/blocks')->getCollection()
					->addFieldToFilter('cat_id', $this->getCategory()->getId())
					->getFirstItem()->getData();
		if (!empty($egmData)) {
			$egmFormData = array(
				'egmcat'			=> $egmData['cat_id'],
				'egmtop'			=> $egmData['top_block'],
				'egmbottom'			=> $egmData['bottom_block'],
				'egmright'			=> $egmData['right_block'],
				'egmright_width'	=> $egmData['right_block_width'],
				'egmleft'			=> $egmData['left_block'],
				'egmleft_width'		=> $egmData['left_block_width'],
				'egm_label'			=> $egmData['category_label']
			);
			$form->setValues($egmFormData);
		}

        $form->setFieldNameSuffix('eg_menu');
        $this->setForm($form);
    }
}