<?php
/**
 * @package UsersOnlineToday
 * @version 2.1.2
 * @author @rjen
 */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
elseif (!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');

global $modSettings, $context, $smcFunc;

// Our basic settings!
$uot_variables = array(
	'uot_setting_sortby' => 'login_time',
	'uot_setting_sortorder' => 'descending',
	'uot_setting_period' => 'current_day',
	'uot_setting_canview' => 'registered',
);

if (empty($context['uninstalling']))
	foreach ($uot_variables as $var_name => $var_value)
	{
		if (empty($modSettings[$var_name]))
			updateSettings(array($var_name => $var_value), false);
	}
else
{
	$keys = array_keys($uot_variables);
	
	foreach ($keys as $uot_var)
		$smcFunc['db_query']('','
			DELETE FROM {db_prefix}settings
			WHERE variable = {string:uot_variable}',
			array(
				'uot_variable' => $uot_var,
			)
		);
}

// Tell SMF that we have updated $modSettings
updateSettings(array(
	'settings_updated' => time(),
)); 

if (SMF == 'SSI')
	echo 'Installation successful!';