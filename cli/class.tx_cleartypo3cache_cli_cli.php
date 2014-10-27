<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 AOE media GmbH <dev@aoemedia.de>
 *  All rights reserved
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

if (!defined ('TYPO3_cliMode')) die ('Access denied: CLI only.');

/**
 * class to process actions via CLI
 * @package eft
 * @subpackage typo3
 */
class tx_cleartypo3cache_cli_cli extends t3lib_cli {
	/**
	 * definition of the extension name
	 * @var string
	 */
	protected $extKey = 'cleartypo3cache';
	/**
	 * @var string
	 */
	protected $prefixId = 'tx_cleartypo3cache_cli_cli'; // Same as class name
	/**
	* Path to this script relative to the extension dir
	* @var string
	*/
	protected $scriptRelPath = 'cli/class.tx_cleartypo3cache_cli_cli.php';

	/**
	 * constructor
	 */
	public function __construct() {
        if (version_compare(TYPO3_version, '4.6.0', '>=')) {
            parent::__construct();
        } else {
            parent::t3lib_cli();
        }
		$this->cli_options = array_merge($this->cli_options, array());
		$this->cli_help = array_merge($this->cli_help, array(
			'name' => 'tx_cleartypo3cache_cli_cli',
			'synopsis' => $this->extKey . ' cache-command',
			'description' => 'This script can clear the complete TYPO3-cache',
			'examples' => 'typo3/cli_dispatch.phpsh ' . $this->extKey . ' [all|pages]',
			'author' => '(c) 2010 AOE media GmbH <dev@aoemedia.de>',
		));
	}
	/**
	 * main function which detects the action and call the related methods
	 * @param array $argv array contains the arguments, which were post via CLI
	 */
	public function cli_main($argv) {
		$this->init();

		$shellExitCode = 0;
		try {
			// select called function
			switch ($this->getAction()) {
				case 'all':
				case 'pages':
					$this->clearTypo3Cache( $this->getAction() );
					break;
				default:
					$this->cli_help();
					break;
			} // END switch
		} catch (Exception $e) {
			$shellExitCode = 1;
		}

		return $shellExitCode;
	}

	/**
	 * clear TYPO3-cache
	 * 
	 * @param string $cacheCmd
	 */
	private function clearTypo3Cache($cacheCmd) {
		/* @var $TceMain t3lib_TCEmain */
		$TceMain = t3lib_div::makeInstance('t3lib_TCEmain');
		$TceMain->admin = 1;
		$TceMain->stripslashes_values = 0;
		$TceMain->start(Array(),Array());
		$TceMain->clear_cacheCmd( $cacheCmd );
		unset($TceMain);
	}
	
	/**
	 * @return string
	 */
	private function getAction() {
		return (string) $this->cli_args['_DEFAULT'][1];
	}
	/**
	 * do initialization
	 */
	private function init() {
		// validate input
		$this->cli_validateArgs();
	}
}

$extensionkey = t3lib_div::makeInstance('tx_cleartypo3cache_cli_cli');
exit($extensionkey->cli_main($_SERVER['argv']));
