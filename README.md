# Lead-Source-Tracking-for-Salesforce

## Overview

I created this for tracking our website visitors that could be captured in Salesforce (SFDC) if they filled out a form.  I use it in our Wordpress Multisite with the Gravity Forms plugin, but you can easily add it to any website built with PHP.


## How It Works

Uses PHP `$_REQUEST[]` and `$_SERVER['HTTP_REFERER']` to extract information about visitor that are temporarily stored in `$_SESSION[]` vars.


## Usage

```
require 'lead-source.php';
```


## Using with WordPress

You will most likely need to add the `start_session()` to the bottom of your `wp-config.php` file like this:

```
if(session_id() === '')
	session_start(); 
```

#### Gravity Forms and $_SESSION

You will obviously need both Wordpress and [Gravity Forms](http://www.gravityforms.com/) for this to work. Then grab this sweet Gravity Forms add on ([Gravity Forms Extended Merge Tags](https://wordpress.org/plugins/gravity-forms-extended-merge-tags/)) so you can have it dynamically add your `$_SESSION[]` variables into a hidden form field.

If you use the default variables in the script, you can add these as hidden fields to any of your gravity forms: `{SESSION:leadSource}` and `{SESSION:refer}`


## Stating the Obvious

The `switch()` assumes that if the referer data is not provided by originating server, it is Web Direct. Obviously this is not 100% valid of an assumption to make since it could be a redirect or a link from HTPS to HTTP, for example. If you want to analyze referral traffic sources, use Google Analytics or another tool. 

This is just helpful for catching as much as possible when doing lead gen


Enjoy, and don't forget to be awesome!