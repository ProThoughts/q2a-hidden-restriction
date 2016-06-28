<?php

/*
	Plugin Name: Hidden Restriction
	Plugin URI:
	Plugin Description:  Comment and Question Nondisplay is restricted
	Plugin Version: 1.0
	Plugin Date: 2016-06-28
	Plugin Author: 38qa.net
	Plugin Author URI:
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.7
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

// overrides
qa_register_plugin_overrides('qa-hidden-restriction-overrides.php');
// layer
qa_register_plugin_layer('qa-hidden-restriction-layer.php', 'Hidden Restriction Layer');

/*
	Omit PHP closing tag to help avoid accidental output
*/
