function updateField(button, fieldId) {
   new Ajax.Request('<?php echo Mage::helper(\'adminhtml\')->getUrl(\'*/*/updateField\') ?>', {
      method: 'post',
      parameters: {
         id: fieldId,
         title: $(button).previous('input').getValue()
      }
   });
}