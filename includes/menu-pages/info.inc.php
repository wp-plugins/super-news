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
Info page.
*/
echo '<div class="wrap ws-menu-page">' . "\n";
/**/
echo '<div id="icon-plugins" class="icon32"><br /></div>' . "\n";
echo '<h2><div>Developed by <a href="' . ws_plugin__super_news_parse_readme_value ("Plugin URI") . '" target="_blank"><img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-light.png" alt="." /></a></div>Super News Information</h2>' . "\n";
/**/
echo '<div class="ws-menu-page-hr"></div>' . "\n";
/**/
echo '<table class="ws-menu-page-table">' . "\n";
echo '<tbody class="ws-menu-page-table-tbody">' . "\n";
echo '<tr class="ws-menu-page-table-tr">' . "\n";
echo '<td class="ws-menu-page-table-l">' . "\n";
/**/
echo '<img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-icon.png" class="ws-menu-page-brand-icon" alt="." />' . "\n";
/**/
echo '<a href="' . ws_plugin__super_news_parse_readme_value ("Plugin URI") . '?check_ver=' . urlencode (ws_plugin__super_news_parse_readme_value ("Version")) . '" target="_blank"><img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-updates.png" class="ws-menu-page-brand-updates" alt="." /></a>' . "\n";
/**/
echo '<div class="ws-menu-page-readme">' . "\n";
echo ws_plugin__super_news_parse_readme () . "\n";
echo '</div>' . "\n";
/**/
echo '</td>' . "\n";
/**/
echo '<td class="ws-menu-page-table-r">' . "\n";
/**/
echo ($GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["menu-r"]["tools"]) ? '<div class="ws-menu-page-tools"><img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-tools.png" alt="." /></div>' . "\n" : '';
/**/
echo ($GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["menu-r"]["support"]) ? '<div class="ws-menu-page-support"><a href="' . ws_plugin__super_news_parse_readme_value ("Forum URI") . '" target="_blank"><img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-support.png" alt="." /></a></div>' . "\n" : '';
/**/
echo ($GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["menu-r"]["donations"]) ? '<div class="ws-menu-page-donations"><a href="' . ws_plugin__super_news_parse_readme_value ("Donate link") . '" target="_blank"><img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-donations.jpg" alt="." /></a></div>' . "\n" : '';
/**/
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '</tbody>' . "\n";
echo '</table>' . "\n";
/**/
echo '</div>' . "\n";
?>