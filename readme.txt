=== Super News ( Search Related News ) ===

Version: 1.0.3
Stable tag: 1.0.3
Framework: WS-P-2.2

WordPress Compatible: yes
WP Multisite Compatible: yes
Multisite Blog Farm Compatible: yes

Tested up to: 3.0
Requires at least: 2.9.2
Requires: WordPress® 2.9.2+, PHP 5.2+

Copyright: © 2009 WebSharks, Inc.
License: GNU General Public License
Contributors: WebSharks, PriMoThemes
Author URI: http://www.primothemes.com/
Author: PriMoThemes.com / WebSharks, Inc.
Donate link: http://www.primothemes.com/donate/

Plugin Name: Super News
Forum URI: http://www.primothemes.com/forums/viewforum.php?f=6
Plugin URI: http://www.primothemes.com/post/super-news-plugin-for-wordpress/
Description: Prepares bloggable news content ( based on specific search terms that you supply ) from other WordPress® powered sites. Great for pinging related news articles!
Tags: news, pings, pingbacks, trackbacks, related, related news, related blogs, related articles, related posts, related content, thumbnails, screenshots, websnapr, web snapr, google api, google ajax apis, google search, google blog search, options panel included, websharks framework, w3c validated code, includes extensive documentation, highly extensible

Prepares bloggable news content ( based on specific search terms that you supply ) from other WordPress® powered sites. Great for pinging related news articles!

== Installation ==

1. Upload the `/super-news` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress®.
3. Navigate to the `Super News` panel & enjoy.

***Special instructions for Multisite Blog Farms:** If you're installing this plugin on WordPress® with Multisite/Networking enabled, and you run a Blog Farm ( i.e. you give away free blogs to the public ); you should create a file in this plugin's directory. Name it: `multisite.farm`. Either that, or `define("MULTISITE_FARM", true);` in your wp-config.php file. When this plugin is running on a Multisite Blog Farm, it will mutate itself ( including its menus ) for safe compatiblity with Blog Farms. You don't need to do this unless you run a Blog Farm. If you're running the standard version of WordPress®, or you run WordPress® Multisite to host your own sites, you can safely skip this step.*

== Description ==

The Super News plugin works as a specialized search engine for you on the back-end of WordPress®. Super News prepares Cut'n Paste Content ( based on specific search terms that you supply ).

Ultimately, the content that it prepares, comes to you in a list of links that point to other sites; which are all powered by blog-publishing platforms ( such as WordPress®, Blogger, Movable Type, Joomla, and many others ). Super News also prepares thumbnail image screenshots, for each site that it finds, making the list of links more attractive to your visitors. All you do is copy/paste the snippets of code that it generates, pop them into a new Post, and voila! There are many configuration options available. You can even create a Custom CSS file, using our Default Stylesheet as a starting point.

== Screenshots ==

1. Super News Screenshot #1
2. Super News Screenshot #2

== Frequently Asked Questions ==

= How do I get a Google® Ajax Search API Key? =
It's 100% free. Please [register here](http://code.google.com/apis/ajaxsearch/signup.html) for your Ajax Search API Key. The Super News engine is powered by Google®.

= How do I get a ShrinkTheWeb® API Access Key? =
It's 100% free. Please [register here](http://www.shrinktheweb.com/) for your Access Key. ShrinkTheWeb® can be used for Thumbnail Screenshots.

= How do I get a WebSnapr® API Developer Key? =
It's 100% free. Please [register here](http://www.websnapr.com/) for your Developer Key. WebSnapr® can be used for Thumbnail Screenshots.

= How does Super News order its search results? =
The web is constantly evolving, from one hour - to the next. The Super News results are ordered by Publication Date, giving you the most recent news first! A search at 5pm may return different results than you had earlier in the day.

= How come the Thumbnail Previews are not loading? =
It's normal for Thumbnail Providers to return "queued thumbnails" initially; ( this happens on sites that are NOT yet archived ). By the time you copy/paste the code into a Post and publish it; they'll all be available, so no worries :-)

= ShrinkTheWeb® is giving me a Limit Exceeded message, why? =
At the time of this writing, ShrinkTheWeb® has a limit of 250k thumbnails per month. There is also a limit of 5k discoveries per month. In other words, you get 250k total, and up to 5k new ( previously unarchived ) thumbnails, on a monthly basis. If you really need it, there is a premium option available that increases your limitations. For further details, please check [this page](http://www.shrinktheweb.com/compare-thumbnail-offerings.htm).

= WebSnapr® is giving me a Limit Exceeded message, why? =
At the time of this writing, WebSnapr® has a limit of 100k thumbnails per month. There is also a limit of 80 requests per IP address / per hour. In other words, if you've been searching a LOT; you may hit this hourly limit. If you really need it, there is a premium option available that increases your limitations. For further details, please check [this page](http://www.websnapr.com/support/).

= Is it possible to get larger lists, with more results? =
Unfortunately, no. The Google® API only provides 8 results per page, with a maximum of 8 pages ( so that's 64 total results ) returned for each of your searches. There is no way to increase this upper limit. Google® purposely imposes this limit, and there is no way around it; short of working a deal with Google® directly. All of that being said, Super News DOES integrate a feature that allows you to + Add Results to an existing Result Set. Using this technique, you can build lists of unlimited size.

== Changelog ==

= 1.0.3 =
* Contributors, Authors, and Editors will now have access to search with Super News.
* Updated minimum requirements to WordPress® 2.9.2.
* Framework updated to WS-P-2.2.

= 1.0.2 =
* A new option has been added for Custom Code Injections. This allows you to inject some of your own Custom Code into the Result Sets generated by Super News.

= 1.0.1 =
* Introduced a new feature that allows you to Add Results to the current Result Set. This makes it possible to build lists of unlimited size, based on a variety of topics, or on a variation of search terms.
* You can now delete specific results from a Result Set. This makes it easy to pick and choose ( i.e. exclude ) specific articles from the list of results.

= 1.0 =
* Initial release.