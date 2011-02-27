<?php
/*
Copyright: © 2009 WebSharks, Inc. ( coded in the USA )
<mailto:support@websharks-inc.com> <http://www.websharks-inc.com/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License,
along with this software. In the main directory, see: /licensing/
If not, see: <http://www.gnu.org/licenses/>.
*/
/*
Direct access denial.
*/
if (realpath (__FILE__) === realpath ($_SERVER["SCRIPT_FILENAME"]))
	exit ("Do not access this file directly.");
/*
Function for handling activation routines.
This function should match the array key for this plugin:
ws_plugin__$plugin_key_activate() is called by our themes.

We also initialize some option values here.
Initializing these options will force them to be
autoloaded into WordPress® instead of generating
extra queries before they are set.
*/
if (!function_exists ("ws_plugin__super_news_activate"))
	{
		function ws_plugin__super_news_activate ()
			{
				do_action ("ws_plugin__super_news_before_activation", get_defined_vars ());
				/**/
				if (!is_numeric (get_option ("ws_plugin__super_news_configured")))
					update_option ("ws_plugin__super_news_configured", "0");
				/**/
				if (!is_array (get_option ("ws_plugin__super_news_notices")))
					update_option ("ws_plugin__super_news_notices", array ());
				/**/
				if (!is_array (get_option ("ws_plugin__super_news_options")))
					update_option ("ws_plugin__super_news_options", array ());
				/**/
				do_action ("ws_plugin__super_news_after_activation", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Function for handling de-activation cleanup routines.
This function should match the array key for this plugin:
ws_plugin__$plugin_key_deactivate() is called by our themes.
*/
if (!function_exists ("ws_plugin__super_news_deactivate"))
	{
		function ws_plugin__super_news_deactivate ()
			{
				do_action ("ws_plugin__super_news_before_deactivation", get_defined_vars ());
				/**/
				if ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["run_deactivation_routines"])
					{
						delete_option ("ws_plugin__super_news_configured");
						delete_option ("ws_plugin__super_news_notices");
						delete_option ("ws_plugin__super_news_options");
					}
				/**/
				do_action ("ws_plugin__super_news_after_deactivation", get_defined_vars ());
				/**/
				return;
			}
	}
?>