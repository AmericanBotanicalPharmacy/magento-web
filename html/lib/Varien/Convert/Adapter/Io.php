<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Varien
 * @package     Varien_Convert
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */


/**
 * Convert IO adapter
 *
 * @category   Varien
 * @package    Varien_Convert
 * @author      Magento Core Team <core@magentocommerce.com>
 */
 class Varien_Convert_Adapter_Io extends Varien_Convert_Adapter_Abstract
 {
     public function getResource()
     {
         if (!$this->_resource) {
            $type = $this->getVar('type', 'file');
            $className = 'Varien_Io_'.ucwords($type);
            $this->_resource = new $className();
            try {
                $this->_resource->open($this->getVars());
            } catch (Exception $e) {
                $this->addException('Error occured during file opening: '.$e->getMessage(), Varien_Convert_Exception::FATAL);
            }
         }
         return $this->_resource;
     }

     public function load()
     {
         $data = $this->getResource()->read($this->getVar('filename'));
         $filename = $this->getResource()->pwd().'/'.$this->getVar('filename');
         if (false===$data) {
             $this->addException('Could not load file: '.$filename, Varien_Convert_Exception::FATAL);
         } else {
             $this->addException('Loaded successfully: '.$filename.' ['.strlen($data).' byte(s)]');
         }
         $this->setData($data);
         return $this;
     }

     public function save()
     {
         $data = $this->getData();
         $filename = $this->getResource()->pwd().'/'.$this->getVar('filename');
         $result = $this->getResource()->write($filename, $data, 0777);
         if (false===$result) {
             $this->addException('Could not save file: '.$filename, Varien_Convert_Exception::FATAL);
         } else {
             $text = 'Saved successfully: '.$filename.' ['.strlen($data).' byte(s)]';
             if ($this->getVar('link')) {
                 $text .= ' <a href="'.$this->getVar('link').'" target="_blank">Link</a>';
             }
             $this->addException($text);
         }
         return $this;
     }
 }
