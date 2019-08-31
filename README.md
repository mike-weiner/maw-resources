# maw-resources
Contributors: [vikings412](https://profiles.wordpress.org/vikings412/) <br>
Donate Link: https://paypal.me/michaelw13?locale.x=en_US <br>
Tags: custom post-tyope, resources <br>
Requires at least: 4.6 <br>
Tested up to: 5.2.2 <br>
Stable tag: 2.0 <br>
Requires PHP: 5.6 <br>
License: GPLv2 or later <br>
License URI: https://www.gnu.org/licenses/gpl-2.0.html <br>

This Wordpress plugin creates a custom post-type called "Resources" to make displaying PDF, PPTX, DOCX, and more file types easy to organize and display for users to read.

## Description

This plugin creates a custom post-type called "Resources" to make displaying PDF, PPTX, DOCX, and more file types easy to organize, add publisher/metadata for each resource, and display them for users to read.

## Installation

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the plugins directory, or install the plugin through the WordPress Plugins panel directly.
2. Activate the plugin through the Plugins panel in the WordPress administration area.

## Display
This plugin will includes a display for your new custom `Resources` post-type. Below is an example of what that dislay will look like on any page or post. To learn how to use a shortcode to create your own display, [view the shortcode section below.](https://github.com/mike-weiner/maw-resources/blob/master/README.md#shortcodes)

| Resource                                      | Link          |  
|-----------------------------------------------|---------------|
| Resource Post Name #1<br> Published By: Lorem | View Resource | 
| Resource Post Name #2<br> Published By: Lorem | View Resource |
| Resource Post Name #3<br> Published By: Lorem | View Resource | 

## Shortcodes

### Quick Start
To quickly get started, use `[maw_resources]` on any page or post to quickly display 5 of your most recent resources for visitors to see. To see more complex exmaples, read the shortcode modifiers below, or [view our additional examples.](https://github.com/mike-weiner/maw-resources#examples) 

### Shortcode Modifiers

This plugin uses a shortcode with *several* modifiers to display the posts within the Resources post type. Below are a list of the modifiers and their default values. 

- `cat` --> Filter your display to only pull Resources from a certain category(s). To accomplish this, enter the category ID number. To filter from multiple categories, separate each ID number by a comma. 
   * **Default:** Pulls posts from every category. 
   * **All Options:** 
      * (VARIES) - This value depends on the categories on your website.
- `ignore_sticky_posts` --> Choose whether or not your display will include sticky posts or not.  
   * **Default:** `false` - By default the dispaly _will_ include sticky posts in the display.
   * **All Options:** 
      * `true` - Remove sticky posts from your display of resources.
      * `false` - Keep sticky posts in your display of resources.
- `posts_per_page` --> Change how many posts are displayed with the shortcode. 
   * **Default:** `5` - By default the display will display the 5 latest resources.
   * **All Options**:** 
      * `Any Integer (greater than 0)` - Your integer will determine how many posts are displayed
      * `-1` - Display all resources.
- `offset` --> Choose whether the display skips a certain number of posts that do not need to be displayed.
   * **Default:** `0` - By default the display will _not_ offset or skip any posts
   * **All Options:** 
      * `Any Integer (greater than 0)` - Your integer will determine how many posts are displayed
   * **_NOTE_** - If you have `posts_per_page` set to `-1` then no matter how many posts you offset, every post will still be displayed.    
- `order` --> Choose whether the resources in your display are ordered in ascending or descending order. 
   * **Default:** `ASC` - By default the display will order your posts in an ascending order.
   * **All Options:** 
      * `ASC` - Order posts in an ascending order
      * `DESC` - Order posts in a descending order
- `orderby` --> Choose what metric the resources in your display are sorted by.
   * **Default:** `title` - By default the display will order posts by their title
   * **All Options:** 
      * `title` - Title of Your Resource(s)
      * `post_date` - Publish Date of Your Resources
- `post_type` --> Choose what post type to display.
   * **Default:** `maw-resources` - By default the display will order posts from the maw-resources post type.
   * **All Options:** 
      * `any` - Pull in all posts from any post-type on your website
      * (VARIES) - You can use this field to pull in different custom post-types.      
- `tag` --> Filter your display to only pull Resources with a certain tag(s). To accomplish this, enter the tag ID number. To filter with multiple tags, separate each ID number by a comma. 
   * **Default:** Pulls posts from every category. 
   * **All Options:** 
      * (VARIES) - This value depends on the tags on your website.      
 
### Examples
- `[maw_resources]` - This is the deault shortcode. It will pull in the 5 latest Resources with any category or tag.
- `[maw_resources num="-1" orderby="post-date" order="DESC"]` - This shortcde will pull in every resource in the system, and order in by the date of their post in a descending order.
- `[maw_resources num="-1" orderby="post-date" cat="23, 24"]` - This shortcde will pull in every resource with the category whose IDs are 23 and 24 and order them in ascending order by their post-date.

## Frequently Asked Questions

### Where do I find and create new resources?

Once this plugin is activated, you will find a new 'Resources' tab in the left-hand admin sidebar of your Wordpress website. This is where you can view and create new resources like you would any other post or page.

### Why does this post type only use custom fields and not a standard editor?

Great question! We wanted to keep this tool as simple as possible. All you need to enter is the resource's name, a publication date of the resource, a link to the resource, and a short description of what your resource is (optional). That is all it takes to publish your resources to allow visitors on your website to find.

### Can I use this shortcode to display other post types?

Yes! You will need to use the `post-type` shortcode modifier. You can pull in only certain post-types, other custom post-types, all post-types, or a select few. Please read our [shortcode documentation](https://github.com/mike-weiner/maw-resources/blob/master/README.md#shortcodes) to see how to implement this.

## Screenshots
All images can be found in the /assets/ folder.

1. Lorem Ipsum
2. Lorem Ipsum
3. Lorem Ipsum

## Changelog

### 1.0 🎉
* Welcome to the maiden release of maw-resources! We hope you love what you find!

### 1.0 🎉
* Relased On - xx/xx/xxxx
* Initial release

## Arbitrary section

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
