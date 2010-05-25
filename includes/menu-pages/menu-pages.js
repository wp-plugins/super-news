/*
Copyright: © 2009 WebSharks, Inc. ( coded in the USA )
<mailto:support@websharks-inc.com> <http://www.websharks-inc.com/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License,
along with this software. In the main directory, see: /licensing/
If not, see: <http://www.gnu.org/licenses/>.
*/
jQuery(document).ready (function($)
	{
		/*
		These routines address common layout styles for menu pages.
		*/
		$('div.ws-menu-page-group').each (function(index)
			{
				var ins = '<ins>+</ins>', group = $(this), title = group.attr ('title');
				/**/
				var header = $('<div class="ws-menu-page-group-header">' + ins + title + '</div>');
				/**/
				header.css ({'z-index': 100 - index}); /* Stack them sequentially, top to bottom. */
				/**/
				header.insertBefore (group), group.hide (), header.click (function()
					{
						var ins = $('ins', this), group = $(this).next ();
						/**/
						if (group.css ('display') === 'none')
							{
								$(this).addClass ('open'), ins.html ('-'), group.show ();
							}
						else
							{
								$(this).removeClass ('open'), ins.html ('+'), group.hide ();
							}
						/**/
						return false;
					});
				if (index === 0) /* These are the buttons for showing/hiding all groups. */
					{
						$('<div class="ws-menu-page-groups-show">+</div>').insertBefore (header).click (function()
							{
								$('div.ws-menu-page-group-header').each (function()
									{
										var ins = $('ins', this), group = $(this).next ();
										/**/
										$(this).addClass ('open'), ins.html ('-'), group.show ();
										/**/
										return;
									});
								/**/
								return false;
							});
						$('<div class="ws-menu-page-groups-hide">-</div>').insertBefore (header).click (function()
							{
								$('div.ws-menu-page-group-header').each (function()
									{
										var ins = $('ins', this), group = $(this).next ();
										/**/
										$(this).removeClass ('open'), ins.html ('+'), group.hide ();
										/**/
										return;
									});
								/**/
								return false;
							});
					}
				/**/
				if (group.attr ('default-state') === 'open')
					header.trigger ('click');
				/**/
				return;
			});
		/**/
		$('div.ws-menu-page-hr:first').css ({'margin-top': '10px', 'margin-bottom': '20px'});
		/**/
		$('div.ws-menu-page-section:first > h3').css ({'margin-top': '0'});
		/**/
		$('div.ws-menu-page-group > div.ws-menu-page-section:first-child > h3').css ({'margin-top': '0'});
		$('div.ws-menu-page-group-header:first').css ({'margin-top': '0', 'margin-right': '140px'});
		$('div.ws-menu-page-group:first').css ({'margin-right': '145px'});
		/**/
		$('div.ws-menu-page-readme > div.readme > div.section:last-child').css ({'border-bottom-width': '0'});
		/**/
		$('input.ws-menu-page-media-btn').filter (function() /* Only those that have a rel attribute. */
			{
				return($(this).attr ('rel')) ? true : false; /* Must have rel targeting an input id. */
			})/**/
		.click (function() /* Attach click events to media buttons with send_to_editor(). */
			{
				$this = $(this), window.send_to_editor = function(html)
					{
						var $inp, $txt; /* Looking for input|textarea. */
						/**/
						if (($inp = $('input#' + $this.attr ('rel'))).length > 0)
							{
								var oBg = $inp.css ('background-color'), src = $.trim ($(html).attr ('src'));
								src = (!src) ? $.trim ($('img', html).attr ('src')) : src;
								/**/
								$inp.val (src), $inp.css ({'background-color': '#FFFFCC'}), setTimeout(function()
									{
										$inp.css ({'background-color': oBg});
									}, 2000);
								/**/
								tb_remove ();
								/**/
								return;
							}
						else if (($txt = $('textarea#' + $this.attr ('rel'))).length > 0)
							{
								var oBg = $txt.css ('background-color'), src = $.trim ($(html).attr ('src'));
								src = (!src) ? $.trim ($('img', html).attr ('src')) : src;
								/**/
								$txt.val ($.trim ($txt.val ()) + '\n' + src), $txt.css ({'background-color': '#FFFFCC'}), setTimeout(function()
									{
										$txt.css ({'background-color': oBg});
									}, 2000);
								/**/
								tb_remove ();
								/**/
								return;
							}
					};
				/**/
				tb_show('', './media-upload.php?type=image&TB_iframe=true');
				/**/
				return false;
			});
		/*
		These routines are all specific to this software.
		*/
		if (typeof adminpage === 'string' && adminpage.match (/ws-plugin--super-news-search/))
			{
				var superNews = new google.search.BlogSearch (), thumbProvider, customInjection, splitCi;
				global_superNews = {$: superNews, new__add: 'new', results: '', del: null};
				/**/
				superNews.setNoHtmlGeneration ();
				superNews.setUserDefinedLabel ('Super News');
				superNews.setResultOrder (google.search.Search.ORDER_BY_DATE);
				superNews.setResultSetSize (google.search.Search.LARGE_RESULTSET);
				/**/
				$('div#ws-plugin--super-news-search-branding').html (google.search.Search.getBranding ());
				/**/
				customInjection = '<?php echo trim(ws_plugin__super_news_esc_sq (preg_replace ("/\n/", "\\n", preg_replace ("/[\r\t]+/", "", $GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["custom_injection"])))); ?>';
				/**/
				thumbProvider = '<?php echo esc_js($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_provider"]); ?>';
				thumbProvider = (thumbProvider === 'shrinktheweb') ? 'http://www.shrinktheweb.com/xino.php?embed=1&STWAccessKeyId=<?php echo esc_js (urlencode ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_key"])); ?>&Size=lg&stwUrl=' : thumbProvider;
				thumbProvider = (thumbProvider === 'websnapr') ? 'http://images.websnapr.com/?size=S&key=<?php echo esc_js (urlencode ($GLOBALS["WS_PLUGIN__"]["super_news"]["o"]["thumb_key"])); ?>&url=' : thumbProvider;
				thumbProvider = (thumbProvider === 'thumbshots') ? 'http://open.thumbshots.org/image.aspx?url=' : thumbProvider;
				/**/
				$('input#ws-plugin--super-news-search-new').click (function()
					{
						execSearcher('new');
					});
				$('input#ws-plugin--super-news-search-add').click (function()
					{
						execSearcher('add');
					});
				/**/
				var execSearcher = function(new__add)
					{
						var q, o; /* Localize these so we can validate. */
						/**/
						global_superNews.new__add = new__add; /* Set intended action. */
						/**/
						if (q = $.trim ($('input#ws-plugin--super-news-search-q').val ()))
							{
								if ((o = $('input[name=ws_plugin__super_news_search_o]').val ()) === 'date')
									superNews.setResultOrder (google.search.Search.ORDER_BY_DATE);
								/**/
								else if (o === 'relevance') /* Returned in order of greatest relevance. */
									superNews.setResultOrder (google.search.Search.ORDER_BY_RELEVANCE);
								/**/
								$('img#ws-plugin--super-news-loading-animation').css ('visibility', 'visible');
								/**/
								superNews.execute (q); /* Execute the search. */
							}
					};
				/**/
				var searchComplete = function()
					{
						clearResults (); /* Start by clearing current results. */
						/**/
						if (superNews.results && superNews.results.length > 0)
							{
								var r = '<div class="super-news-results">\n', _r = '';
								/**/
								for (var i = 0, md5 = ''; i < superNews.results.length; i++)
									{
										_r += '<!--s-result:' + (md5 = $.md5 (superNews.results[i].postUrl + '-' + Math.random())) + '-->';
										/**/
										_r += '\t<div class="super-news-result">\n';
										/**/
										_r += '<img class="super-news-result-del" src="<?php echo $i; ?>/del-icon.png" onclick="global_superNews.del(\'' + md5 + '\');" title="Delete" alt="" />';
										/**/
										_r += (thumbProvider) ? '\t\t<div class="super-news-result-thumbnail"><a href="' + superNews.results[i].postUrl + '" title="' + superNews.results[i].title.replace (/<\/?[^>]+>/gi, '') + '" target="_blank"><img src="' + thumbProvider + encodeURIComponent(superNews.results[i].postUrl) + '" alt="" /></a></div>\n' : '';
										_r += '\t\t<div class="super-news-result-title"><h3><a href="' + superNews.results[i].postUrl + '" title="' + superNews.results[i].postUrl + '" target="_blank" rel="external">' + superNews.results[i].title.replace (/<\/?[^>]+>/gi, '') + '</a></h3></div>\n';
										_r += '\t\t<div class="super-news-result-clip" title="' + superNews.results[i].postUrl + '">' + superNews.results[i].content.replace (/<\/?[^>]+>/gi, '') + '</div>\n';
										_r += '\t\t<div class="super-news-result-details"><a href="' + superNews.results[i].postUrl + '" title="' + superNews.results[i].postUrl + '" class="super-news-result-details-url" target="_blank">' + superNews.results[i].blogUrl + '</a> <span class="super-news-result-details-date" title="Published: ' + superNews.results[i].publishedDate + '">&mdash; ' + superNews.results[i].publishedDate + '</span></div>\n';
										/**/
										_r += '\t</div>\n';
										/**/
										_r += '<!--e-result:' + md5 + '-->';
									}
								/**/
								if (global_superNews.new__add === 'add')
									_r += global_superNews.results;
								/**/
								global_superNews.results = _r;
								/**/
								r += _r + '</div>';
								/**/
								$('div#ws-plugin--super-news-search-results').html (r), $('textarea#ws-plugin--super-news-search-snippet').val (resultsSnippet(r));
								/**/
								var $a, page, cursor = superNews.cursor, curPage = cursor.currentPageIndex, $pagination = $('span#ws-plugin--super-news-search-pagination');
								/**/
								if (global_superNews.new__add === 'new')
									for (var i = 0, paginationPages = cursor.pages.length; i < paginationPages; i++)
										{
											$a = $('<a href="#wpwrap" onclick="global_superNews.$.gotoPage (' + i + ');"' + ((curPage == i) ? ' class="current"' : '') + '>' + cursor.pages[i].label + '</a>');
											$pagination.append ($a);
										}
								/**/
								displayResults(paginationPages);
							}
					};
				/**/
				var resultsSnippet = function(r)
					{
						r = r.replace (/(\<\!--)(s|e)(-result\:)(.*?)(--\>)/g, '').replace (/\<img class\="super-news-result-del"(.*?)\/\>/g, '').replace (/ target\="_blank"/g, ' rel="nofollow"').replace (/rel\="external"/g, '');
						return(customInjection) ? customInjection + '\n' + r : r;
					};
				/**/
				global_superNews.del = function(md5)
					{
						var r = '<div class="super-news-results">\n', _r = global_superNews.results;
						/**/
						_r = _r.replace (new RegExp('(\\<\\!--s-result\\:)('+md5+')(--\\>)([\\S\\s]*?)(\\<\\!--e-result\\:)('+md5+')(--\\>)', 'g'), '');
						/**/
						global_superNews.results = _r;
						/**/
						r += _r + '</div>';
						/**/
						$('div#ws-plugin--super-news-search-results').html (r), $('textarea#ws-plugin--super-news-search-snippet').val (resultsSnippet(r));
						$('div.ws-plugin--super-news-pagination-section-hr, div.ws-plugin--super-news-pagination-section').hide (), $('span#ws-plugin--super-news-search-pagination').html ('');
					};
				/**/
				var displayResults = function(paginationPages)
					{
						$('div.ws-plugin--super-news-results-section-hr').show ();
						/**/
						$('div.ws-plugin--super-news-results-section').slideDown ('fast', function()
							{
								$('img#ws-plugin--super-news-loading-animation').css ('visibility', 'hidden');
								$('div.ws-plugin--super-news-snippet-section-hr, div.ws-plugin--super-news-snippet-section').show ();
								/**/
								if (global_superNews.new__add === 'new' && paginationPages > 1)
									{
										$('div.ws-plugin--super-news-pagination-section-hr, div.ws-plugin--super-news-pagination-section').show ();
									}
							});
					};
				/**/
				var clearResults = function()
					{
						$('img#ws-plugin--super-news-loading-animation').css ('visibility', 'hidden');
						/**/
						$('div.ws-plugin--super-news-results-section-hr, div.ws-plugin--super-news-results-section').hide ();
						$('div.ws-plugin--super-news-snippet-section-hr, div.ws-plugin--super-news-snippet-section').hide ();
						$('div.ws-plugin--super-news-pagination-section-hr, div.ws-plugin--super-news-pagination-section').hide ();
						/**/
						$('div#ws-plugin--super-news-search-results').html (''), $('textarea#ws-plugin--super-news-search-snippet').val (''), $('span#ws-plugin--super-news-search-pagination').html ('');
					};
				/**/
				superNews.setSearchCompleteCallback (this, searchComplete, null), clearResults ();
			}
	});
/*
Load the Google search API.
*/
if (typeof adminpage === 'string' && adminpage.match (/ws-plugin--super-news-search/))
	google.load ('search', '1');