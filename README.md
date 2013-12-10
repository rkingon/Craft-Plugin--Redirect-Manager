# Redirect Manager for Craft

Keep all your 301/302 managed within Craft. Very useful when using NGINX because you don't have an htaccess file! :(

## Installation

* Upload to plugins/redirectmanager
* Install Plugin (Settings -> Plugins -> Redirect Manager)

## Usage

#### Regex
To use regex, simply wrap your "Match Uri" field with "#" (Example: "#^products(.*)#" will match products and products/anything-else)
##### Regex Eamples
* "#^products\/(.+)#" will only match sub level's of products
* "#^products(.*)#" will match: products and products/anything-else

#### Wildcard
For wildcards use an asterisk. (Example: "products*" will match products and products/anything-else)

##### Wildcard Examples:
* "products/*" will only match sub level's of products
* "products*" will match: products and products/anything-else