<?php  if ($_cartQty == 1) {
	    //if (Mage::registry('current_category') &&
 		//echo Mage::registry('current_category')->getName();



        echo '<script type="text/javascript">';
        echo 's.events=\'scOpen\';';
        echo 's.linkTrackEvents = s.events;';
        echo 's.linkTrackVars=\'events,products\';';
        echo 's.tl(true,\'o\',\'Add to Cart\');';
		echo '</script>';
    	}
    	
		/*
elseif ($_cartQty > 1){
	    echo '<script type="text/javascript">';
        echo 's.events=\'scAdd\';';
        echo 's.linkTrackEvents = s.events;';
        echo 's.linkTrackVars=\'events,products\';';
        echo 's.tl(true,\'o\',\'Add to Cart\');';
		echo '</script>';
    }
*/
?>