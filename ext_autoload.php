<?php
$extensionPath = t3lib_extMgm::extPath('cleartypo3cache');
return array(
	'tx_cleartypo3cache_tasks_clearcache' => $extensionPath . 'tasks/class.tx_cleartypo3cache_tasks_clearCache.php',
	'tx_cleartypo3cache_tasks_clearcache_additionalfieldprovider' => $extensionPath . 'tasks/class.tx_cleartypo3cache_tasks_clearCache_AdditionalFieldProvider.php'
);
?>