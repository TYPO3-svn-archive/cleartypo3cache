<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Qc media (qcmedia@qcmedia.ca)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script! 
 ***************************************************************/

class tx_cleartypo3cache_tasks_clearCache_AdditionalFieldProvider implements tx_scheduler_AdditionalFieldProvider {

	/**
	 * This method is used to define new fields for adding or editing a task
	 * In this case, it adds an email field
	 *
	 * @param	array					$taskInfo: reference to the array containing the info used in the add/edit form
	 * @param	object					$task: when editing, reference to the current task object. Null when adding.
	 * @param	tx_scheduler_Module		$parentObject: reference to the calling object (Scheduler's BE module)
	 * @return	array					Array containg all the information pertaining to the additional fields
	 *									The array is multidimensional, keyed to the task class name and each field's id
	 *									For each field it provides an associative sub-array with the following:
	 *										['code']		=> The HTML code for the field
	 *										['label']		=> The label of the field (possibly localized)
	 *										['cshKey']		=> The CSH key for the field
	 *										['cshLabel']	=> The code of the CSH label
	 */
	public function getAdditionalFields(array &$taskInfo, $task, tx_scheduler_Module $schedulerModule) {
		$additionalFields = array();

		if (empty($taskInfo['cacheaction'])) {
			if ($schedulerModule->CMD == 'add') {
					$taskInfo['cacheaction'] = '';
			} else {
					$taskInfo['cacheaction'] = $task->cacheaction;
			}
		}
		$fieldID = 'task_cacheaction';
		$fieldCode  = '
			<select name="tx_scheduler[cacheaction]" id="' . $fieldID . '" value="' . $taskInfo['cacheaction'] . '" />
				<option value="pages">Pages</option>
				<option value="all">All</option>
			</select>
		';
		$additionalFields[$fieldID] = array(
                        'code'     => $fieldCode,
                        'label'    => 'LLL:EXT:cleartypo3cache/locallang_db.xml:cleartypo3cache_task_clearCache.cacheaction'
                );
		return $additionalFields;
	}

	/**
	 * Validates the additional fields' values
	 *
	 * @param	array					An array containing the data submitted by the add/edit task form
	 * @param	tx_scheduler_Module		Reference to the scheduler backend module
	 * @return	boolean					True if validation was ok (or selected class is not relevant), false otherwise
	 */
	public function validateAdditionalFields(array &$submittedData, tx_scheduler_Module $schedulerModule) {
		if ( !empty($submittedData['cacheaction']))
			return true; 

		return false;
	}

	/**
	 * Takes care of saving the additional fields' values in the task's object
	 *
	 * @param	array					An array containing the data submitted by the add/edit task form
	 * @param	tx_scheduler_Module		Reference to the scheduler backend module
	 * @return	void
	 */
	public function saveAdditionalFields(array $submittedData, tx_scheduler_Task $task) {
		$task->cacheaction = $submittedData['cacheaction'];
	}
}
?>