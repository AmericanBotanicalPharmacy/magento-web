<?php
    public function updateFieldAction()
    {
        $fieldId = (int) $this->getRequest()->getParam('id');
        $best = $this->getRequest()->getParam('bestseller');
        if ($fieldId) {
            $model = Mage::getModel('catalog/resource_eav_attribute')->load($fieldId);
            $model->setTitle($best);
            $model->save();
        }
    }
?>