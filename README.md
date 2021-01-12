# maw-resources
Contributors: [vikings412](https://profiles.wordpress.org/vikings412/) <br>
Donate Link: https://paypal.me/michaelw13?locale.x=en_US <br>
Tags: custom post-type, resources <br>
Requires at least: 5.6 <br>
Tested up to: 5.6 <br>
Stable tag: 1.0 <br>
Requires PHP: 7.0 <br>
License: GPLv2 or later <br>
License URI: https://www.gnu.org/licenses/gpl-2.0.html <br>

This Wordpress plugin creates a custom post-type called "Resources" to make displaying PDF, PPTX, DOCX, and more file types easy to organize and display for users to read.

## Description

This plugin creates a custom post-type called "Resources" to make displaying PDF, PPTX, DOCX, and more file types easy to organize, add publisher/metadata for each resource, and display them for users to read.

### Things to Note
- For this plugin to work, you need to have [CMB2](https://github.com/CMB2/CMB2) installed on your website! You can install it using [Wordpress](https://wordpress.org/plugins/cmb2/) or you can download a ZIP file from [Github](https://github.com/CMB2/CMB2).
- There is no standard WYSIWYG editor. There are only custom fields that you can fill out that will be used in the display of your resource post-types.

## Installation

This section describes how to install the plugin and get it working.

1. Install and Activate the [CMB2 plugin](https://wordpress.org/plugins/cmb2/) from the WordPress plugin repository. 
2. Download a .zip of this Github repository and upload the .zip to the plugins directory, or install the plugin through the WordPress Plugins panel directly.
3. Activate the plugin through the Plugins panel in the WordPress administration area.

## Display
This plugin will includes a display for your new custom `Resources` post-type. Below is an example of what that display will look like on any page or post. To learn how to use a shortcode to create your own display, [view the shortcode section below.](https://github.com/mike-weiner/maw-resources/blob/master/README.md#shortcodes)

| Resource                                           | Link          |  
|-------------------------------------------------|---------------|
| Resource Post Name #1<br> _--Published By: Lorem_ <br>Description of the resource.| View Resource | 
| Resource Post Name #2<br> _--Published By: Lorem_ <br>Description of the resource.| View Resource |
| Resource Post Name #3<br> _--Published By: Lorem_ <br>Description of the resource.| View Resource | 

## Shortcodes

### Quick Start
To quickly get started, use `[maw_resources]` on any page or post to quickly display all of your published resources for visitors to see. It will order the resources by the specified publish date and then by title. To see more complex examples, read the shortcode modifiers below, or [view our additional examples.](https://github.com/mike-weiner/maw-resources#examples) 

### Shortcode Modifiers

This plugin uses a shortcode with *several* modifiers to display the posts within the Resources post type. Below are a list of the modifiers and their default values.

**Note:** Not all of these modifiers need to be included in your shortcode. You can pick and choose which modifiers you need. However, do note that some modifiers override other modifiers. Notes have been made where applicable about this.

- `cat` --> Filter your display to only pull Resources from a certain category(s). To accomplish this, enter the category ID number. To filter from multiple categories, separate each ID number by a comma. 
   * **Default:** Pulls posts from every category. 
   * **All Options:** 
      * (VARIES) - This value depends on the tags on your website.
- `ignore_sticky_posts` --> Choose whether or not your display will include sticky posts or not.  
   * **Default:** `false` - By default the display _will_ include sticky posts in the display.
   * **All Options:** 
      * `true` - Remove sticky posts from your display of resources.
      * `false` - Keep sticky posts in your display of resources.
- `mw_show_resource_author` - Choose whether or not to display your resource's publisher within your display (This pulls in the value from the "Resource Publisher" field.
  * **Default:** By default, the display will show your resources' publishers.
  * **All Options:**
    * `true` - Show the resource publisher in the display.
    * `false` - Do _not_ show the resource publisher in the display.
- `mw_show_resource_description` - Choose whether or not to display your resource's description within your display.
  * **Default:** By default, the display will show your resource's description (if one is present).
  * **All Options:**
    * `true` - Show the post author in the display.
    * `false` - Do _not_ show the post author in the display.    
- `meta_key` --> Display posts that only have a value for a certain meta_key field.
   * **Default:** No limitations.
   * **All Options:**    
      * `maw-resource-publish-date` - Sort by the date of publication entered in the custom _'Publication Date of Resource'_ field on the backend of the site. **THIS IS NOT THE PUBLISH DATE OF THE POST.**
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
- `orderby` --> Choose what metric the resources in your display are sorted by. **Note:** You can include more than one orderby parameter as a fallback(s). When using more than one orderby parameter, separate each by a space. For example: `orderby="title post-date"` would sort posts by title and then if a post did not have a title it would sort by post-date. 
   * **Default:** `title` - By default the display will order posts by their title
   * **All Options:** 
      * `title` - Order by the title of your resource(s).
      * `post_date` - Order by the publish date of the resource post.
      * `meta_value` - order by the `meta_key` shortcode modifier. **NOTE:** The `meta_key` shortcode modifier _must_ be present for this to work.
      * `modified` - Order by the date that each post was last modified in your display of resources. 
      * `type` - Order by post-type(s).
- `page_id` --> Choose to display only a single page or post using it's ID.
   * **Default:** `` - By default the display will _not_ filter to a single post.
   * **All Options:** 
      * (VARIES) - You can use this field to pull in any post from resources section using its unique ID number.    
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
- `[maw_resources]` - This is the default shortcode. It will pull in the 5 latest resources with any category or tag.
- `[maw_resources num="-1" orderby="post-date" order="DESC"]` - This shortcode will pull in every resource in the system, and order in by the publish date of their post in a descending order.
- `[maw_resources num="-1" orderby="post-date" cat="23, 24"]` - This shortcode will pull in every resource with the category whose IDs are 23 and 24 and order them in ascending order by their post-date.
- `[maw_resources orderby="meta_value title"]` - This shortcode will pull in 5 of the latest resources and will order them by the value of the metadata field (_Publish Date of Resource_) and then by the title of the resource (if several resources either have the same date or no date at all), and all of the posts will be displayed in ascending order.
- `[maw_resources num="-1" maw_show_resource_author="false" maw_show_resource_description="false"]` - This shortcode will pull in all of your resources no matter their category or tag, and it will _not_ show the author **or** the description in the display. The posts will be ordered by the title of your resources in ascending order.
- `[maw_resources num="-1" meta_key="maw-resource-publish-date" orderby="meta_value title" order="asc"]` - This shortcode will display all of your resources and order them by the publication date of the publication (this is one of the fields you fill out) in an ascending order and then by the title of the resource (if several resources either have the same date or no date at all).

## Frequently Asked Questions

### I have installed and activated this plugin, but nothing seems to be working.

For this plugin to work, you need to have [CMB2](https://github.com/CMB2/CMB2) installed on your website!

### Where do I find and create new resources?

Once this plugin is activated, you will find a new 'Resources' tab in the left-hand admin sidebar of your Wordpress website. This is where you can view and create new resources like you would any other post or page.

### Why does this post type only use custom fields and not a standard editor?

Great question! We wanted to keep this tool as simple as possible. All you need to enter is the resource's name, a publication date of the resource, a link to the resource, and a short description of what your resource is (optional). That is all it takes to publish your resources to allow visitors on your website to find.

### Can I use this shortcode to display other post types?

Yes! You will need to use the `post-type` shortcode modifier. You can pull in only certain post-types, other custom post-types, all post-types, or a select few. Please read our [shortcode documentation](https://github.com/mike-weiner/maw-resources/blob/master/README.md#shortcodes) to see how to implement this.

## Changelog

### 1.0 🎉
* Welcome to the maiden release of MAW Resources! We hope you love what you find!

### 1.0 🎉
* Released On - 01/10/2021
* Initial release

