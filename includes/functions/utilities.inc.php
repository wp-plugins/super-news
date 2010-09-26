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
Function that handles a remote request.
This extends wp_remote_request() through the `WP_Http` class.
*/
if (!function_exists ("ws_plugin__super_news_remote"))
	{
		function ws_plugin__super_news_remote ($url = FALSE, $post_vars = FALSE, $args = array ())
			{
				static $http_response_filtered = false; /* Filter once. */
				/**/
				$args = (!is_array ($args)) ? array (): $args;
				/**/
				if (!$http_response_filtered && ($http_response_filtered = true))
					add_filter ("http_response", "_ws_plugin__super_news_remote_gz_variations");
				/**/
				if ($url) /* Obviously, we must have a URL to do anything. */
					{
						if (preg_match ("/^https/i", $url) && strtolower (substr (PHP_OS, 0, 3)) === "win")
							add_filter ("use_curl_transport", "_ws_plugin__super_news_remote_disable_curl");
						/**/
						if ((is_array ($post_vars) || is_string ($post_vars)) && !empty ($post_vars))
							{
								$args["method"] = "POST";
								$args["body"] = $post_vars;
							}
						/**/
						$body = wp_remote_retrieve_body (wp_remote_request ($url, $args));
						/**/
						remove_filter ("use_curl_transport", "_ws_plugin__super_news_remote_disable_curl");
						/**/
						return $body; /* The body content received. */
					}
				/**/
				return false;
			}
	}
/*
A sort of callback function that disables the WP_Http cURL transport option.
This is ONLY necessary on a Windows OS; and ONLY when processing https requests.
Attach to: add_filter("use_curl_transport");

If you're going to process SSL requests over https, Windows servers should set `allow_url_fopen = on` inside their php.ini file.
*/
if (!function_exists ("_ws_plugin__super_news_remote_disable_curl"))
	{
		function _ws_plugin__super_news_remote_disable_curl ($use_curl_transport = TRUE)
			{
				return ($use_curl_transport = FALSE);
			}
	}
/*
A sort of callback function that filters the WP_Http response for additional gzinflate variations.
Attach to: add_filter("http_response");
*/
if (!function_exists ("_ws_plugin__super_news_remote_gz_variations"))
	{
		function _ws_plugin__super_news_remote_gz_variations ($response = array ())
			{
				if (!isset ($response["ws__gz_variations"]) && ($response["ws__gz_variations"] = 1))
					{
						if ($response["headers"]["content-encoding"])
							if (substr ($response["body"], 0, 2) === "\x78\x9c")
								if (($gz = @gzinflate (substr ($response["body"], 2))))
									$response["body"] = $gz;
					}
				/**/
				return $response;
			}
	}
/*
Function that extends array_unique to
support multi-dimensional arrays.
*/
if (!function_exists ("ws_plugin__super_news_array_unique"))
	{
		function ws_plugin__super_news_array_unique ($array = FALSE)
			{
				if (!is_array ($array))
					{
						return array ($array);
					}
				else /* Serialized array_unique. */
					{
						foreach ($array as &$value)
							{
								$value = serialize ($value);
							}
						/**/
						$array = array_unique ($array);
						/**/
						foreach ($array as &$value)
							{
								$value = unserialize ($value);
							}
						/**/
						return $array;
					}
			}
	}
/*
Function that buffers ( gets ) function output.
*/
if (!function_exists ("ws_plugin__super_news_get"))
	{
		function ws_plugin__super_news_get ($function = FALSE)
			{
				$args = func_get_args ();
				$function = array_shift ($args);
				/**/
				if (is_string ($function) && $function)
					{
						ob_start ();
						/**/
						if (is_array ($args) && !empty ($args))
							{
								$return = call_user_func_array ($function, $args);
							}
						else /* There are no additional arguments to pass. */
							{
								$return = call_user_func ($function);
							}
						/**/
						$echo = ob_get_clean ();
						/**/
						return (!strlen ($echo) && strlen ($return)) ? $return : $echo;
					}
				else /* Else return null. */
					return;
			}
	}
/*
Function evaluates PHP code, and returns the output afterward.
*/
if (!function_exists ("ws_plugin__super_news_eval"))
	{
		function ws_plugin__super_news_eval ($code = FALSE)
			{
				ob_start (); /* Output buffer. */
				/**/
				eval ("?>" . trim ($code));
				/**/
				return ob_get_clean ();
			}
	}
/*
Function escapes double quotes.
*/
if (!function_exists ("ws_plugin__super_news_esc_dq"))
	{
		function ws_plugin__super_news_esc_dq ($string = FALSE)
			{
				return preg_replace ('/"/', '\"', $string);
			}
	}
/*
Function escapes single quotes.
*/
if (!function_exists ("ws_plugin__super_news_esc_sq"))
	{
		function ws_plugin__super_news_esc_sq ($string = FALSE)
			{
				return preg_replace ("/'/", "\'", $string);
			}
	}
/*
Function escapes single quotes.
*/
if (!function_exists ("ws_plugin__super_news_esc_ds"))
	{
		function ws_plugin__super_news_esc_ds ($string = FALSE)
			{
				return preg_replace ('/\$/', '\\\$', $string);
			}
	}
/*
Function that trims deeply.
*/
if (!function_exists ("ws_plugin__super_news_trim_deep"))
	{
		function ws_plugin__super_news_trim_deep ($value = FALSE)
			{
				return is_array ($value) ? array_map ('ws_plugin__super_news_trim_deep', $value) : trim ($value);
			}
	}
/*
Determines whether or not this is a Multisite Farm.
*/
if (!function_exists ("ws_plugin__super_news_is_multisite_farm"))
	{
		function ws_plugin__super_news_is_multisite_farm ()
			{
				return (is_multisite () && defined ("MULTISITE_FARM") && MULTISITE_FARM);
			}
	}
/*
Determines whether or not this is a Multisite Dashboard blog.
*/
if (!function_exists ("ws_plugin__super_news_is_main_dashboard"))
	{
		function ws_plugin__super_news_is_main_dashboard ()
			{
				global $current_blog; /* Needed for comparison to the Dashboard blog. */
				/**/
				return (is_multisite () && $current_blog->blog_id == get_site_option ("dashboard_blog"));
			}
	}
/*
Functions that handles CSS compression routines.
*/
if (!function_exists ("ws_plugin__super_news_compress_css"))
	{
		function ws_plugin__super_news_compress_css ($css = FALSE)
			{
				$c6 = "/(\:#| #)([A-Z0-9]{6})/i";
				$css = preg_replace ("/\/\*(.*?)\*\//s", "", $css);
				$css = preg_replace ("/[\r\n\t]+/", "", $css);
				$css = preg_replace ("/ {2,}/", " ", $css);
				$css = preg_replace ("/ , | ,|, /", ",", $css);
				$css = preg_replace ("/ \> | \>|\> /", ">", $css);
				$css = preg_replace ("/\[ /", "[", $css);
				$css = preg_replace ("/ \]/", "]", $css);
				$css = preg_replace ("/ \!\= | \!\=|\!\= /", "!=", $css);
				$css = preg_replace ("/ \|\= | \|\=|\|\= /", "|=", $css);
				$css = preg_replace ("/ \^\= | \^\=|\^\= /", "^=", $css);
				$css = preg_replace ("/ \$\= | \$\=|\$\= /", "$=", $css);
				$css = preg_replace ("/ \*\= | \*\=|\*\= /", "*=", $css);
				$css = preg_replace ("/ ~\= | ~\=|~\= /", "~=", $css);
				$css = preg_replace ("/ \= | \=|\= /", "=", $css);
				$css = preg_replace ("/ \+ | \+|\+ /", "+", $css);
				$css = preg_replace ("/ ~ | ~|~ /", "~", $css);
				$css = preg_replace ("/ \{ | \{|\{ /", "{", $css);
				$css = preg_replace ("/ \} | \}|\} /", "}", $css);
				$css = preg_replace ("/ \: | \:|\: /", ":", $css);
				$css = preg_replace ("/ ; | ;|; /", ";", $css);
				$css = preg_replace ("/;\}/", "}", $css);
				/**/
				return preg_replace_callback ($c6, "ws_plugin__super_news_compress_css_c3", $css);
			}
	}
if (!function_exists ("ws_plugin__super_news_compress_css_c3"))
	{
		function ws_plugin__super_news_compress_css_c3 ($m = FALSE)
			{
				if ($m[2][0] === $m[2][1] && $m[2][2] === $m[2][3] && $m[2][4] === $m[2][5])
					return $m[1] . $m[2][0] . $m[2][2] . $m[2][4];
				return $m[0];
			}
	}
?>