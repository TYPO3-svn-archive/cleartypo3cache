<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
global $_EXTKEY;

if (TYPO3_MODE == 'BE') {
	## Setting up script that can be run through cli_dispatch.phpsh
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['cliKeys'][$_EXTKEY] = array(
		'EXT:' . $_EXTKEY . '/cli/class.tx_cleartypo3cache_cli_cli.php',
		'_CLI_cleartypo3cache'
	);

	 // Setup for the scheduler
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['tx_cleartypo3cache_tasks_clearCache'] = array(
        'extension'        => $_EXTKEY,
        'title'            => 'LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:cleartypo3cache_task_clearCache.name',
        'description'      => 'LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:cleartypo3cache_task_clearCache.description',
        'additionalFields' => 'tx_cleartypo3cache_tasks_clearCache_AdditionalFieldProvider'
    );
}