# ACF Plugin Framework

A simple ACF framework for WordPress plugins developers.

### Behavior
This framework will automatically detect if ACF is installed and activated on the targeted website. If ACF isn't found, it will be silently loaded within the plugin.

### ACF admin menu
When ACF is loaded from the framework, the ACF admin menu is hidden by default. It is possible to alter this behavior using the following hook: `add_filter('acff/show_admin', '__return_true');`.

If ACF is loaded as a native plugin, the ACF admin menu isn't altered.

### ACF Pro
By default, the framework is bundled with ACF Free version. To use ACF Pro instead, please follow this instructions:
* Create a folder in: `/my-plugin/acf-framework/acf-pro/`
* Put ACF Pro files inside the `/acf-pro/` folder

The framework will automatically load ACF Pro, if it isn't detected on the current website.

It is possible to use a custom ACF Pro path, using the following hooks:

```php
add_filter('acff/path', '/path/to/acf-pro/');
add_filter('acff/url', '/url/to/acf-pro/');
```

### ACF json
The framework will auto-detect the following folders and include them as part of the ACF Json Loading sequence:
`/my-plugin/acf-framework/acf-json/`
`/my-plugin/acf-json/`
