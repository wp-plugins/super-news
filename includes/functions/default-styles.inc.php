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
	exit;
/*
Function for adding styles to the header.
Attach to: add_action("wp_print_styles");
*/
function ws_plugin__super_news_default_styles ()
	{
		if (!is_admin () && $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["enqueue_styles"])
			{
				wp_enqueue_style ("super-news", $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . "/includes/super-news.css", array (), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"], "all");
			}
		/**/
		return;
	}
/*
Function for adding styles to the search page.
Attach to: add_action("admin_print_styles");
*/
function ws_plugin__super_news_search_styles ()
	{
		if (is_admin () && $_GET["page"] === "ws-plugin--super-news-search")
			{
				wp_enqueue_style ("super-news", $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . "/includes/super-news.css", array (), $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["options_version"] . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["filemtime"], "all");
			}
		/**/
		return;
	}
?>