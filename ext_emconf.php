<?php

########################################################################
# Extension Manager/Repository config file for ext "cleartypo3cache".
#
# Auto generated 26-07-2010 14:14
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'cleartypo3cache',
	'description' => 'extension with cli-script and scheduler-task which clears the TYPO3-cache',
	'category' => 'be',
	'author' => 'juergen kussmann',
	'author_email' => 'dev@aoe.com',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.2.0',
	'constraints' => array(
        'depends' => array(
            'typo3' => '4.7.0-0.0.0',
        ),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:5:{s:9:"ChangeLog";s:4:"43c9";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:19:"doc/wizard_form.dat";s:4:"c7bf";s:20:"doc/wizard_form.html";s:4:"4e0f";}',
);
?>