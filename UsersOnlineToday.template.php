<?php
/**
 * @package UsersOnlineToday
 * @version 2.1.2
 * @author @rjen
 *
 */
 
function template_ic_block_UsersOnlineToday()
{
	global $context, $txt, $modSettings, $settings;

	echo '
			<div class="sub_bar">
				<h4 class="subbg">
					<span class="main_icons people"></span> ', $txt['uot_users_online_'. $modSettings['uot_setting_period']], '
				</h4>
			</div>
			<p class="inline">';
	echo
				$txt['uot_total'], ': <b>', $context['num_users_online_today'], '</b>';

			if ($context['viewing_allowed'])
	echo
				' (', $txt['uot_visible'], ': ', ($context['num_users_online_today'] - $context['num_users_hidden_today']), ', ', $txt['uot_hidden'], ': ', $context['num_users_hidden_today'], ')';

				// Assuming there ARE users online... each user in users_online has an id, username, name, group, href, and link.
				if (!empty($context['users_online_today']) && $context['viewing_allowed'])
				{
	echo
					'<br>', implode(', ', $context['list_users_online_today']);
				}
	echo '
			</p>';
}
?>