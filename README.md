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

#### Capture Groups
Capture groups are just used by the standard $1, $2, ect. within your "Redirect To" field.

##### Capture Goup Example:
**URI To Match:**
	"#^products(.*)#"
	
**Redirect To:** "shop$1"

*Note, we do not include the "/" because it will be part of the capture group*