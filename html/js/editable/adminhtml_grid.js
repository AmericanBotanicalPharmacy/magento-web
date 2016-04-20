/*LOCATION: js/editable/adminhtml_grid.js */
alert(1);
var varienGridMassaction = Class.create(varienGridMassaction, {

   apply: function($super) {

      var qties = [];

      $('productGrid_table').getElementsBySelector('.qty').each(function(qty) {

         if (qty.value != '')

         {

            qties.push(qty.readAttribute('rel') + '[|]' + qty.value);

         }

      });

      new Insertion.Bottom(this.formAdditional, this.fieldTemplate.evaluate({
         name: 'qties',

         value: qties
      }));

      return $super();

   }

   function updateField(button, fieldId) {
      new Ajax.Request('<?php echo Mage::helper(\'catalog\')->getUrl(\'*/*/updateField\') ?>', {
         method: 'post',
         parameters: {
            id: fieldId,
            title: $(button).previous('input').getValue()
         }
      });
   }


});