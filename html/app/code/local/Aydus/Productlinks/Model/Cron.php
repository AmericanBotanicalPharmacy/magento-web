<?php

/**
 * Schedule
 *
 * @category    Aydus
 * @package     Aydus_Productlinks
 * @author		Aydus <davidt@aydus.com>
 */

class Aydus_Productlinks_Model_Cron 
{
	/**
	 * Schedule link generation jobs based on frequency and time
	 * Jobs will be added to cron_schedule table
	 * 
	 * @param Mage_Cron_Model_Schedule $schedule
	 * @return string
	 */
	public function scheduleJobs($schedule)
	{
		$scheduler = Mage::helper('aydus/scheduler');
		
		$linkTypes = Mage::getStoreConfig('aydus_productlinks/configuration/link_types');
		$linkTypes = explode(',',$linkTypes);
		$scheduled = array();
		
		if (is_array($linkTypes) && count($linkTypes)>0 && (in_array('r', $linkTypes) || in_array('u', $linkTypes) || in_array('c', $linkTypes))){
			
			$frequency = Mage::getStoreConfig('aydus_productlinks/configuration/frequency');
			$monthDay = Mage::getStoreConfig('aydus_productlinks/configuration/month_day');
			$weekDay = Mage::getStoreConfig('aydus_productlinks/configuration/week_day'); 
			$startTime = Mage::getStoreConfig('aydus_productlinks/configuration/start_time');
			
			foreach ($linkTypes as $linkType){

				if (in_array($linkType, array('r','u','c'))){
					
					switch ($linkType){
						case 'r' :
							$jobCode = 'aydus_productlinks_related';
							break;
						case 'u' :
							$jobCode = 'aydus_productlinks_upsell';
							break;
						case 'c' :
							$jobCode = 'aydus_productlinks_crosssell';
							break;
					}
					
					$scheduled[$linkType] = $scheduler->generateSchedules($linkType, $jobCode, $frequency, $monthDay, $weekDay, $startTime);
				}
			}
		}
		
		if (is_array($scheduled) && count($scheduled)>0){
			$schedules = array();
			foreach ($scheduled as $linkType => $datetime){
				$schedules[] = $linkType. ' at ' .$datetime;
			}
			
			$return = 'Jobs scheduled: '.implode(', ',$schedules);
			
		} else {
			$return = 'Nothing to schedule';
		}
		
		return $return;
	}
	
	/**
	 * Cron job for related product links generation
	 * @param Mage_Cron_Model_Schedule $schedule
	 */
	public function runRelated($schedule)
	{
		return $this->_runCron('r');
	}
	
	/**
	 * Cron job for related product links generation
	 * @param Mage_Cron_Model_Schedule $schedule
	 */
	public function runUpsell($schedule)
	{
		return $this->_runCron('u');
	}
	
	/**
	 * Cron job for related product links generation
	 * @param Mage_Cron_Model_Schedule $schedule
	 */
	public function runCrossSell($schedule)
	{
		return $this->_runCron('c');
	}
	
	/**
	 * Run the $linkType job
	 * @param string $linkType
	 */
	protected function _runCron($linkType)
	{
		$productLinks = Mage::getModel('aydus_productlinks/productlinks');
		
		return $productLinks->assign($linkType);
	}
}