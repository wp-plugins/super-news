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
						if ((is_array ($post_vars) || is_string ($post_vars)) && !empty ($post_vars))
							{
								$args["method"] = "POST";
								$args["body"] = $post_vars;
							}
						/**/
						return wp_remote_retrieve_body (wp_remote_request ($url, $args));
					}
				/**/
				return false;
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
						$echo = ob_get_contents ();
						/**/
						ob_end_clean ();
						/**/
						return (!strlen ($echo) && strlen ($return)) ? $return : $echo;
					}
				else /* Else return null. */
					return;
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
?>