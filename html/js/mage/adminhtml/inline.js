function updateField(button, fieldId) {
   new Ajax.Request('<?php echo Mage::helper(\'catalog\')->getUrl(\'Mage_Adminhtml/inline-edit/updateField\') ?>', {
      method: 'post',
      parameters: {
         id: fieldId,
         title: $(button).previous('input').getValue()
      }
   });
}