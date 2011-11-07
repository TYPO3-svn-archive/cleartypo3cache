<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 AOE media (dev@aoemedia.de)
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

class tx_cleartypo3cache_tasks_clearCache extends tx_scheduler_Task {
	/**
	 * @var string
	 */
	public $cacheaction = '';

	/**
	 * This is the main method that is called when a task is executed
	 * It MUST be implemented by all classes inheriting from this one
	 * Note that there is no error handling, errors and failures are expected
	 * to be handled and logged by the client implementations.
	 * Should return true on successful execution, false on error. 
	 *
	 * @access public
	 * @return boolean	Returns true on successful execution, false on error
	 */
	public function execute() {
		if(empty($this->cacheaction)) {
			return false;
		}

		$this->clearTypo3Cache($this->cacheaction);

		return true;
	}

	/**
	 * clear TYPO3-cache
	 * Code taken from class tx_cleartypo3cache_cli_cli
	 * 
	 * @param string $cacheCmd
	 */
	private function clearTypo3Cache($cacheCmd) {
		$TceMain = t3lib_div::makeInstance('t3lib_TCEmain');
		$TceMain->stripslashes_values = 0;
		$TceMain->start(Array(),Array());
		$TceMain->clear_cacheCmd( $cacheCmd );
		unset($TceMain); 
	}
}
?>