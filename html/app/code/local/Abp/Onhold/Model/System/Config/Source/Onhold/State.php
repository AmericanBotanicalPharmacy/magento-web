<?php
 class Abp_Onhold_Model_System_Config_Source_Onhold_State
{
    public function toOptionArray()
    {
        // $arr_opt = array(array('value'=>'', 'label'=>'...Plese Select...'));
        $us_states = Mage::getResourceModel('directory/region_collection')->addCountryFilter('US')->load();
        // foreach($us_states as $state) {
        //     array_push($arr_opt, array('value'=>$state['code'], 'label'=>$state['name']));
        // }
        // return $arr_opt;
        return $us_states->toOptionArray(false);
    }
}