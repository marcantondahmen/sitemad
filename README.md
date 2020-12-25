# Sitemad

A beautiful and automatically generated list of links to all your PHP web projects in the document root.

Sitemad scans the document root of your local development environment for `index.php`, `index.html` and `index.htm` files and generates a nice looking page based on the [Halfmoon](https://www.gethalfmoon.com) framework with links to all the found index files. Optionally you can specify dashboard maps to also generate corresponding login buttons. 

## Installation

Simply clone this repository into its own directory in your document root of your localhost. Sitemad will scan its own parent directory for projects.

	$ cd [document root]
	$ git clone https://github.com/marcantondahmen/sitemad sitemad

You can then navigate to `https://localhost/sitemad to use Sitemad.

## Configuration

There are a few options that can be defined to configure Sitemad. Just add a file called `config.json` to the `/sitemad` directory. That file will be automatically ignored by Git. The default options are:

	{
	    "maxdepth": 8,
	    "dashboards": {
	        "/automad/gui": "/dashboard"
	    },
	    "ignore": "archive|node_modules|.git|.hg|vendor|cache|_modules|sitemad"
	}

| Name | Description |
| ---- | ----------- |
| maxdepth | The maximum depth, Sitemad scans for index files. |
| dashboards | A key/value map for generating login buttons. Conceptually the key is a path of any item in a web project that can be used to identify the type of project. The value is the URL slug pointing to the login page. By default only the Automad CMS is supported where for all `index.php` files that have a directory `/automad/gui` as a direct sibling, a login page with the slug `/dashboard` is generated. Note that it is important to understand that the key is only used to identify a project. It must be a path that typically exists in a project with the given dashboard slug. |
| ignore | A regex of items that are ignored when performing a scan such as the `node_modules` directory. |