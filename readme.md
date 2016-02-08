# Controller Action Field plugin for Craft CMS

The plugin provides a button field type to trigger controller actions.

## Installation

To install the plugin, copy the controlleractionfield/ folder into craft/plugins/. Then go to Settings → Plugins and click the "Install" button next to "Controller Action Field".

## Example Settings

Action Path:

`cacheMonster/warmByKeys`

POST Data:

    {% set data = {
        cacheKeys: ['rest-1', 'rest-2', 'rest-3']
    } %}
