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
Function for saving all options from any page.
*/
if (!function_exists ("ws_plugin__super_news_update_all_options"))
	{
		function ws_plugin__super_news_update_all_options ()
			{
				do_action ("ws_plugin__super_news_before_update_all_options", get_defined_vars ());
				/**/
				if (($nonce = $_POST["ws_plugin__super_news_options_save"]) && wp_verify_nonce ($nonce, "ws-plugin--super-news-options-save"))
					{
						$options = $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]; /* Get current options. */
						/**/
						foreach ($_POST as $key => $value) /* Go through each post variable and look for super_news. */
							{
								if (preg_match ("/^" . preg_quote ("ws_plugin__super_news", "/") . "/", $key)) /* Look for keys. */
									{
										if ($key === "ws_plugin__super_news_configured") /* This is a special configuration option. */
											{
												update_option ("ws_plugin__super_news_configured", trim (stripslashes ($value))); /* Update this option separately. */
												/**/
												$GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["configured"] = trim (stripslashes ($value)); /* Update configuration on-the-fly. */
											}
										else /* We need to place this option into the array. Here we remove the ws_plugin__super_news_ portion on the beginning. */
											{
												(is_array ($value)) ? array_shift ($value) : null; /* Arrays should be padded, 1st key is removed. */
												$options[preg_replace ("/^" . preg_quote ("ws_plugin__super_news_", "/") . "/", "", $key)] = $value;
											}
									}
							}
						/**/
						$options["options_version"] = $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] + 0.001; /* Increment options version. */
						/**/
						$options = ws_plugin__super_news_configure_options_and_their_defaults ($options); /* Also updates the global options array. */
						/**/
						eval ('foreach(array_keys(get_defined_vars())as$__v)$__refs[$__v]=&$$__v;');
						do_action ("ws_plugin__super_news_during_update_all_options", get_defined_vars ());
						unset ($__refs, $__v); /* Unset defined __refs, __v. */
						/**/
						update_option ("ws_plugin__super_news_options", $options); /* Update options. */
					}
				/**/
				do_action ("ws_plugin__super_news_after_update_all_options", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Add the options menus & sub-menus.
Attach to: add_action("admin_menu");
*/
if (!function_exists ("ws_plugin__super_news_add_admin_options"))
	{
		function ws_plugin__super_news_add_admin_options ()
			{
				do_action ("ws_plugin__super_news_before_add_admin_options", get_defined_vars ());
				/**/
				add_filter ("plugin_action_links", "_ws_plugin__super_news_add_settings_link", 10, 2);
				/**/
				if (apply_filters ("ws_plugin__super_news_during_add_admin_options_create_menu_items", true, get_defined_vars ()))
					{
						add_menu_page ("Super News", "Super News", "edit_posts", "ws-plugin--super-news-search", "ws_plugin__super_news_search_page");
						/**/
						if (apply_filters ("ws_plugin__super_news_during_add_admin_options_add_search_page", true, get_defined_vars ()))
							add_submenu_page ("ws-plugin--super-news-search", "Super News Search Engine", "Search Engine", "edit_posts", "ws-plugin--super-news-search", "ws_plugin__super_news_search_page");
						/**/
						if (apply_filters ("ws_plugin__super_news_during_add_admin_options_add_options_page", true, get_defined_vars ()))
							add_submenu_page ("ws-plugin--super-news-search", "Super News Config Options", "Config Options", "edit_plugins", "ws-plugin--super-news-options", "ws_plugin__super_news_options_page");
						/**/
						if (apply_filters ("ws_plugin__super_news_during_add_admin_options_add_info_page", true, get_defined_vars ()))
							add_submenu_page ("ws-plugin--super-news-search", "Super News Info", "Super News Info", "edit_plugins", "ws-plugin--super-news-info", "ws_plugin__super_news_info_page");
					}
				/**/
				do_action ("ws_plugin__super_news_after_add_admin_options", get_defined_vars ());
				/**/
				return;
			}
	}
/*
A sort of callback function to add the settings link.
Attach to: add_filter("plugin_action_links");
*/
if (!function_exists ("_ws_plugin__super_news_add_settings_link"))
	{
		function _ws_plugin__super_news_add_settings_link ($links = array (), $file = "")
			{
				eval ('foreach(array_keys(get_defined_vars())as$__v)$__refs[$__v]=&$$__v;');
				do_action ("_ws_plugin__super_news_before_add_settings_link", get_defined_vars ());
				unset ($__refs, $__v); /* Unset defined __refs, __v. */
				/**/
				if (preg_match ("/" . preg_quote ($file, "/") . "$/", $GLOBALS["WS_PLUGIN__"]["super_news"]["l"]) && is_array ($links))
					{
						$settings = '<a href="admin.php?page=ws-plugin--super-news-options">Settings</a>';
						array_unshift ($links, $settings);
						/**/
						eval ('foreach(array_keys(get_defined_vars())as$__v)$__refs[$__v]=&$$__v;');
						do_action ("_ws_plugin__super_news_during_add_settings_link", get_defined_vars ());
						unset ($__refs, $__v); /* Unset defined __refs, __v. */
					}
				/**/
				return apply_filters ("_ws_plugin__super_news_add_settings_link", $links, get_defined_vars ());
			}
	}
/*
Add scripts to admin panels.
Attach to: add_action("admin_print_scripts");
*/
if (!function_exists ("ws_plugin__super_news_add_admin_scripts"))
	{
		function ws_plugin__super_news_add_admin_scripts ()
			{
				do_action ("ws_plugin__super_news_before_add_admin_scripts", get_defined_vars ());
				/**/
				if ($_GET["page"] && preg_match ("/ws-plugin--super-news-/", $_GET["page"]))
					{
						wp_enqueue_script ("jquery");
						wp_enqueue_script ("thickbox");
						wp_enqueue_script ("media-upload");
						/**/
						if ($_GET["page"] === "ws-plugin--super-news-search")
							{
								wp_enqueue_script ("google-jsapi", "http://www.google.com/jsapi?key=" . urlencode ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["google_key"]));
								wp_enqueue_script ("jquery-md5", $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . "/includes/jquery.md5-min.js", array ("jquery"), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"]);
							}
						/**/
						wp_enqueue_script ("ws-plugin--super-news-menu-pages", get_bloginfo ("url") . "/?ws_plugin__super_news_menu_pages_js=1", array ("jquery", "thickbox", "media-upload"), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"]);
						/**/
						do_action ("ws_plugin__super_news_during_add_admin_scripts", get_defined_vars ());
					}
				/**/
				do_action ("ws_plugin__super_news_after_add_admin_scripts", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Add styles to admin panels.
Attach to: add_action("admin_print_styles");
*/
if (!function_exists ("ws_plugin__super_news_add_admin_styles"))
	{
		function ws_plugin__super_news_add_admin_styles ()
			{
				do_action ("ws_plugin__super_news_before_add_admin_styles", get_defined_vars ());
				/**/
				if ($_GET["page"] && preg_match ("/ws-plugin--super-news-/", $_GET["page"]))
					{
						wp_enqueue_style ("thickbox");
						wp_enqueue_style ("ws-plugin--super-news-menu-pages", get_bloginfo ("url") . "/?ws_plugin__super_news_menu_pages_css=1", array ("thickbox"), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"], "all");
						/**/
						do_action ("ws_plugin__super_news_during_add_admin_styles", get_defined_vars ());
					}
				/**/
				do_action ("ws_plugin__super_news_after_add_admin_styles", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Function that outputs the js for menu pages.
Attach to: add_action("init");
*/
if (!function_exists ("ws_plugin__super_news_menu_pages_js"))
	{
		function ws_plugin__super_news_menu_pages_js ()
			{
				do_action ("ws_plugin__super_news_before_menu_pages_js", get_defined_vars ());
				/**/
				if ($_GET["ws_plugin__super_news_menu_pages_js"] && is_user_logged_in () && current_user_can ("edit_posts"))
					{
						header ("Content-Type: text/javascript; charset=utf-8");
						header ("Expires: " . gmdate ("D, d M Y H:i:s", strtotime ("-1 week")) . " GMT");
						header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
						header ("Cache-Control: no-cache, must-revalidate, max-age=0");
						header ("Pragma: no-cache");
						/**/
						$u = $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"];
						$i = $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . "/images";
						/**/
						include_once dirname (dirname (__FILE__)) . "/menu-pages/menu-pages.js";
						@include_once dirname (dirname (__FILE__)) . "/menu-pages/menu-pages-s.js";
						/**/
						do_action ("ws_plugin__super_news_during_menu_pages_js", get_defined_vars ());
						/**/
						exit ();
					}
				/**/
				do_action ("ws_plugin__super_news_after_menu_pages_js", get_defined_vars ());
			}
	}
/*
Function that outputs the css for menu pages.
Attach to: add_action("init");
*/
if (!function_exists ("ws_plugin__super_news_menu_pages_css"))
	{
		function ws_plugin__super_news_menu_pages_css ()
			{
				do_action ("ws_plugin__super_news_before_menu_pages_css", get_defined_vars ());
				/**/
				if ($_GET["ws_plugin__super_news_menu_pages_css"] && is_user_logged_in () && current_user_can ("edit_posts"))
					{
						header ("Content-Type: text/css; charset=utf-8");
						header ("Expires: " . gmdate ("D, d M Y H:i:s", strtotime ("-1 week")) . " GMT");
						header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
						header ("Cache-Control: no-cache, must-revalidate, max-age=0");
						header ("Pragma: no-cache");
						/**/
						$u = $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"];
						$i = $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . "/images";
						/**/
						include_once dirname (dirname (__FILE__)) . "/menu-pages/menu-pages.css";
						@include_once dirname (dirname (__FILE__)) . "/menu-pages/menu-pages-s.css";
						/**/
						do_action ("ws_plugin__super_news_during_menu_pages_css", get_defined_vars ());
						/**/
						exit ();
					}
				/**/
				do_action ("ws_plugin__super_news_after_menu_pages_css", get_defined_vars ());
			}
	}
/*
Function for building and handling the search page.
*/
if (!function_exists ("ws_plugin__super_news_search_page"))
	{
		function ws_plugin__super_news_search_page ()
			{
				do_action ("ws_plugin__super_news_before_search_page", get_defined_vars ());
				/**/
				include_once dirname (dirname (__FILE__)) . "/menu-pages/search.inc.php";
				/**/
				do_action ("ws_plugin__super_news_after_search_page", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Function for building and handling the options page.
*/
if (!function_exists ("ws_plugin__super_news_options_page"))
	{
		function ws_plugin__super_news_options_page ()
			{
				do_action ("ws_plugin__super_news_before_options_page", get_defined_vars ());
				/**/
				ws_plugin__super_news_update_all_options ();
				/**/
				include_once dirname (dirname (__FILE__)) . "/menu-pages/options.inc.php";
				/**/
				do_action ("ws_plugin__super_news_after_options_page", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Function for building and handling the info page.
*/
if (!function_exists ("ws_plugin__super_news_info_page"))
	{
		function ws_plugin__super_news_info_page ()
			{
				do_action ("ws_plugin__super_news_before_info_page", get_defined_vars ());
				/**/
				include_once dirname (dirname (__FILE__)) . "/menu-pages/info.inc.php";
				/**/
				do_action ("ws_plugin__super_news_after_info_page", get_defined_vars ());
				/**/
				return;
			}
	}
?>