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
Function for adding styles to the header.
Attach to: add_action("wp_print_styles");
*/
if (!function_exists ("ws_plugin__super_news_default_styles"))
	{
		function ws_plugin__super_news_default_styles ()
			{
				do_action ("ws_plugin__super_news_before_default_styles", get_defined_vars ());
				/**/
				if (!is_admin () && $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["enqueue_styles"])
					{
						wp_enqueue_style ("ws-plugin--super-news", get_bloginfo ("wpurl") . "/?ws_plugin__super_news_css=1", array (), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"], "all");
						/**/
						do_action ("ws_plugin__super_news_during_default_styles", get_defined_vars ());
					}
				/**/
				do_action ("ws_plugin__super_news_after_default_styles", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Function for adding styles to the search page.
Attach to: add_action("admin_print_styles");
*/
if (!function_exists ("ws_plugin__super_news_search_styles"))
	{
		function ws_plugin__super_news_search_styles ()
			{
				do_action ("ws_plugin__super_news_before_search_styles", get_defined_vars ());
				/**/
				if (is_admin () && $_GET["page"] === "ws-plugin--super-news-search")
					{
						wp_enqueue_style ("ws-plugin--super-news", get_bloginfo ("wpurl") . "/?ws_plugin__super_news_css=1", array (), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"], "all");
						/**/
						do_action ("ws_plugin__super_news_during_search_styles", get_defined_vars ());
					}
				/**/
				do_action ("ws_plugin__super_news_after_search_styles", get_defined_vars ());
				/**/
				return;
			}
	}
/*
Function that outputs the CSS for default styles.
Attach to: add_action("init");
*/
if (!function_exists ("ws_plugin__super_news_css"))
	{
		function ws_plugin__super_news_css ()
			{
				do_action ("ws_plugin__super_news_before_css", get_defined_vars ());
				/**/
				if ($_GET["ws_plugin__super_news_css"]) /* Incoming request? */
					{
						header ("Content-Type: text/css; charset=utf-8");
						header ("Expires: " . gmdate ("D, d M Y H:i:s", strtotime ("+1 week")) . " GMT");
						header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
						header ("Cache-Control: max-age=604800");
						header ("Pragma: public");
						/**/
						$u = $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"];
						$i = $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . "/images";
						/**/
						ob_start ("ws_plugin__super_news_compress_css"); /* Compress. */
						/**/
						include_once dirname (dirname (__FILE__)) . "/super-news.css";
						/**/
						do_action ("ws_plugin__super_news_during_css", get_defined_vars ());
						/**/
						exit ();
					}
				/**/
				do_action ("ws_plugin__super_news_after_css", get_defined_vars ());
			}
	}
?>