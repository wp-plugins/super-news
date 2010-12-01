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
Add the plugin actions/filters here.
*/
add_action ("init", "ws_plugin__super_news_css");
add_action ("init", "ws_plugin__super_news_menu_pages_js");
add_action ("init", "ws_plugin__super_news_menu_pages_css");
/**/
add_action ("wp_print_styles", "ws_plugin__super_news_default_styles");
add_action ("admin_print_styles", "ws_plugin__super_news_search_styles");
/**/
add_filter ("gettext", "ws_plugin__super_news_translation_mangler", 10, 3);
/**/
add_action ("admin_notices", "ws_plugin__super_news_admin_notices");
add_action ("admin_menu", "ws_plugin__super_news_add_admin_options");
add_action ("admin_print_scripts", "ws_plugin__super_news_add_admin_scripts");
add_action ("admin_print_styles", "ws_plugin__super_news_add_admin_styles");
/*
Register the activation | de-activation routines.
*/
register_activation_hook ($GLOBALS["WS_PLUGIN__"]["super_news"]["l"], "ws_plugin__super_news_activate");
register_deactivation_hook ($GLOBALS["WS_PLUGIN__"]["super_news"]["l"], "ws_plugin__super_news_deactivate");
?>