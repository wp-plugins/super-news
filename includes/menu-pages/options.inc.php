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
Options page.
*/
echo '<div class="wrap ws-menu-page">' . "\n";
/**/
echo '<div id="icon-plugins" class="icon32"><br /></div>' . "\n";
echo '<h2><div>Developed by <a href="' . ws_plugin__super_news_parse_readme_value ("Plugin URI") . '" target="_blank"><img src="' . $GLOBALS["WS_PLUGIN__"]["super_news"]["c"]["dir_url"] . '/images/brand-light.png" alt="." /></a></div>Super News Options</h2>' . "\n";
/**/
echo '<div class="ws-menu-page-hr"></div>' . "\n";
/**/
echo '<table class="ws-menu-page-table">' . "\n";
echo '<tbody class="ws-menu-page-table-tbody">' . "\n";
echo '<tr class="ws-menu-page-table-tr">' . "\n";
echo '<td class="ws-menu-page-table-l">' . "\n";
/**/
echo '<form method="post" name="ws_plugin__super_news_options_form" id="ws-plugin--super-news-options-form">' . "\n";
echo '<input type="hidden" name="ws_plugin__super_news_options_save" id="ws-plugin--super-news-options-save" value="' . esc_attr (wp_create_nonce ("ws-plugin--super-news-options-save")) . '" />' . "\n";
echo '<input type="hidden" name="ws_plugin__super_news_configured" id="ws-plugin--super-news-configured" value="1" />' . "\n";
/**/
echo '<div class="ws-menu-page-group" title="Google® Ajax Search API Key">' . "\n";
/**/
echo '<div class="ws-menu-page-section ws-plugin--super-news-google-key-section">' . "\n";
echo '<h3>Google® Search API Key ( required )</h3>' . "\n";
echo '<p>The Super News plugin uses an Ajax Search API, provided by Google® ( it\'s free ). This is how it taps into billions of articles written about whatever topics you need to find. In order for the Super News plugin to connect to the Google® API, it needs a Key for permission. You\'ll need to have your own Key, which is provided by Google® for free. You just need to <a href="http://code.google.com/apis/ajaxsearch/signup.html" target="_blank" rel="external">register</a>.</p>' . "\n";
/**/
echo '<table class="form-table">' . "\n";
echo '<tbody>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<th>' . "\n";
echo '<label for="ws-plugin--super-news-google-key">' . "\n";
echo 'My Google® Search API Key:' . "\n";
echo '</label>' . "\n";
echo '</th>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<td>' . "\n";
echo '<input type="text" name="ws_plugin__super_news_google_key" id="ws-plugin--super-news-google-key" value="' . format_to_edit ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["google_key"]) . '" /><br />' . "\n";
echo 'Don\'t have a Key yet? [ <a href="http://code.google.com/apis/ajaxsearch/signup.html" target="_blank" rel="external">click here</a> ]' . "\n";
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '</tbody>' . "\n";
echo '</table>' . "\n";
echo '</div>' . "\n";
/**/
echo '</div>' . "\n";
/**/
echo '<div class="ws-menu-page-group" title="ShrinkTheWeb® / WebSnapr® / Thumbshots">' . "\n";
/**/
echo '<div class="ws-menu-page-section ws-plugin--super-news-thumb-key-provider-section">' . "\n";
echo '<h3>Thumbnail / Screenshot Provider ( optional )</h3>' . "\n";
echo '<p>Super News can integrate Thumbnail Previews, provided by one of three companies ( they\'re all free ). In order for the Super News plugin to connect to one of these Thumbnail Providers ( with the exception of Thumbshots.com ), it needs a Key for permission. You\'ll need to have your own Key, which is provided by each company for free. You just need to register. We recommend ShrinkTheWeb® ( best service ), and then WebSnapr®. The last provider in the list, is Thumbshots.com. If you select Thumbshots.com, just leave the Key field empty.</p>' . "\n";
/**/
echo '<table class="form-table">' . "\n";
echo '<tbody>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<th>' . "\n";
echo '<label for="ws-plugin--super-news-thumb-provider">' . "\n";
echo 'Choose A Thumbnail Provider:' . "\n";
echo '</label>' . "\n";
echo '</th>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<td>' . "\n";
echo '<select name="ws_plugin__super_news_thumb_provider" id="ws-plugin--super-news-thumb-provider">' . "\n";
echo '<option value=""' . ((!$GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_provider"]) ? ' selected="selected"' : '') . '>&mdash; Thumbnails Disabled &mdash;</option>' . "\n";
echo '<option value="shrinktheweb"' . (($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_provider"] === "shrinktheweb") ? ' selected="selected"' : '') . '>ShrinkTheWeb® ( great service, free, very few limitations )</option>' . "\n";
echo '<option value="websnapr"' . (($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_provider"] === "websnapr") ? ' selected="selected"' : '') . '>WebSnapr® ( great service, free, with a few limitations )</option>' . "\n";
echo '<option value="thumbshots"' . (($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_provider"] === "thumbshots") ? ' selected="selected"' : '') . '>Thumbshots.com ( good service, free, but lower coverage )</option>' . "\n";
echo '</select><br />' . "\n";
echo 'ShrinkTheWeb® is our top choice. Up to 250k thumbnails each month, for free! Upgrades are also possible.' . "\n";
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<th>' . "\n";
echo '<label for="ws-plugin--super-news-thumb-key">' . "\n";
echo 'My Thumbnail Access Key/ID ( from your Thumbnail Provider ):' . "\n";
echo '</label>' . "\n";
echo '</th>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<td>' . "\n";
echo '<input type="text" name="ws_plugin__super_news_thumb_key" id="ws-plugin--super-news-thumb-key" value="' . format_to_edit ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_key"]) . '" /><br />' . "\n";
echo 'Don\'t have a Key yet? Register your site at <a href="http://www.shrinktheweb.com/" target="_blank" rel="external">ShrinkTheWeb®</a>, or <a href="http://www.websnapr.com/" target="_blank" rel="external">WebSnapr®</a>.' . "\n";
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '</tbody>' . "\n";
echo '</table>' . "\n";
echo '</div>' . "\n";
/**/
echo '</div>' . "\n";
/**/
echo '<div class="ws-menu-page-group" title="Default Super News Stylesheet">' . "\n";
/**/
echo '<div class="ws-menu-page-section ws-plugin--super-news-enqueue-styles-section">' . "\n";
echo '<h3>The Super News Default Stylesheet ( optional )</h3>' . "\n";
echo '<p>In order for the Cut\'n Paste Content that Super News produces to look good, it needs just a few CSS styles. The Default Stylesheet is located here: <code>/super-news/includes/super-news.css</code>. You can either allow the Default Stylesheet to be loaded into your theme automatically, or you can use the Default Stylesheet as an example, and build your own.</p>' . "\n";
/**/
echo '<table class="form-table">' . "\n";
echo '<tbody>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<th>' . "\n";
echo '<label for="ws-plugin--super-news-enqueue-styles">' . "\n";
echo 'Enqueue Default Stylesheet?' . "\n";
echo '</label>' . "\n";
echo '</th>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<td>' . "\n";
echo '<select name="ws_plugin__super_news_enqueue_styles" id="ws-plugin--super-news-enqueue-styles">' . "\n";
echo '<option value="1"' . (($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["enqueue_styles"]) ? ' selected="selected"' : '') . '>Yes ( load the Default Stylesheet into my theme )</option>' . "\n";
echo '<option value="0"' . ((!$GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["enqueue_styles"]) ? ' selected="selected"' : '') . '>No ( I\'ll take care of loading my own Custom Stylesheet )</option>' . "\n";
echo '</select><br />' . "\n";
echo 'The Default Stylesheet is located here: <code>/super-news/includes/super-news.css</code>' . "\n";
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '</tbody>' . "\n";
echo '</table>' . "\n";
echo '</div>' . "\n";
/**/
echo '</div>' . "\n";
/**/
echo '<div class="ws-menu-page-group" title="Custom Code Injection">' . "\n";
/**/
echo '<div class="ws-menu-page-section ws-plugin--super-news-custom-injection-section">' . "\n";
echo '<h3>Custom Code Injection ( optional, for further customization )</h3>' . "\n";
echo '<p>Whenever Super News generates its list of results, it also prepares a Cut\'n Paste Snippet for those results. If you\'d like Super News to prepend ( inject ) some Custom Code into your Snippets, you can insert that Custom Code here. Instead of inserting it yourself, each time you generate a list of results. Super News will handle it automatically; saving you the trouble.</p>' . "\n";
echo '<table class="form-table">' . "\n";
echo '<tbody>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<th>' . "\n";
echo '<label for="ws-plugin--super-news-custom-injection">' . "\n";
echo 'Custom Code To Be Injected:' . "\n";
echo '</label>' . "\n";
echo '</th>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<td>' . "\n";
echo '<textarea name="ws_plugin__super_news_custom_injection" id="ws-plugin--super-news-custom-injection" rows="10" spellcheck="false" style="font-family:monospace;">' . format_to_edit ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["custom_injection"]) . '</textarea><br />' . "\n";
echo 'Any valid XHTML or JavaScript works just fine here.' . "\n";
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '</tbody>' . "\n";
echo '</table>' . "\n";
echo '</div>' . "\n";
/**/
echo '</div>' . "\n";
/**/
echo '<div class="ws-menu-page-group" title="De-Activation Safeguards">' . "\n";
/**/
echo '<div class="ws-menu-page-section ws-plugin--super-news-deactivation-section">' . "\n";
echo '<h3>De-Activation Safeguards ( optional, for safeguarding Super News options )</h3>' . "\n";
echo '<p>By default, Super News will cleanup ( erase ) all of it\'s Configuration Options when/if you de-activate it from the Plugins Menu in WordPress®. If you would like to Safeguard all of this information, in case Super News is de-activated inadvertently, you can disable the De-Activation Routines for Super News.</p>' . "\n";
echo '<table class="form-table">' . "\n";
echo '<tbody>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<th>' . "\n";
echo '<label for="ws-plugin--super-news-run-deactivation-routines">' . "\n";
echo 'Run De-Activation Routines for Super News?' . "\n";
echo '</label>' . "\n";
echo '</th>' . "\n";
/**/
echo '</tr>' . "\n";
echo '<tr>' . "\n";
/**/
echo '<td>' . "\n";
echo '<select name="ws_plugin__super_news_run_deactivation_routines" id="ws-plugin--super-news-run-deactivation-routines">' . "\n";
echo '<option value="1"' . (($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["run_deactivation_routines"]) ? ' selected="selected"' : '') . '>Yes ( erase all Super News data/options on de-activation )</option>' . "\n";
echo '<option value="0"' . ((!$GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["run_deactivation_routines"]) ? ' selected="selected"' : '') . '>No ( safeguard all Super News data/options )</option>' . "\n";
echo '</select><br />' . "\n";
echo 'It is recommended that you Safeguard all Super News data/options on your system.' . "\n";
echo '</td>' . "\n";
/**/
echo '</tr>' . "\n";
echo '</tbody>' . "\n";
echo '</table>' . "\n";
echo '</div>' . "\n";
/**/
echo '</div>' . "\n";
/**/
echo '<div class="ws-menu-page-hr"></div>' . "\n";
/**/
echo '<p class="submit"><input type="submit" class="button-primary" value="Save Changes" /></p>' . "\n";
/**/
echo '</form>' . "\n";
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