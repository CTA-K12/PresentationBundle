MESD PresentationBundle
=======================

Version `3.0.1`

Using Bootstrap Version `3.0.2`

Description
-----------

This bundle contains the base layout files and global css and js files for
rendering MESD web-applications.

Screenshots
-----------

Coming soon...

Dependencies
------------

Symfony Bundles:

  + symfony 2.3+
  + twig 2.1+
  + assetic 2.0+

Other:

  + NodeJS 
  + NPM
  + Less 1.7+

Installing
----------

How to install.

This bundle will is compatible with all browsers except IE8 and below.

.. code-block:: bash

    $ cd /var/www/html/project
    $ composer install

Configuring
-----------

Twig global variables are no longer used!

This bundle now uses it's own configuration, which is loaded into the service container
at runtime. The configuration currently uses defualts, which are not appropriate for a
production application. If you want to override the defaults, add some or all of the following
to your symfony configuration:

```yaml
# app/config/config.yml
mesd_presentation:
    app_name:          App
    app_abbreviation:  APP
    app_description:   App Description
    app_keywords:      App Key Words
    app_url:           http://myurl.domain/app
    app_version:       0.0.0
    app_license_1:     My License
    app_license_url_1: http://myurl.domain/my_license
    app_license_2:     MIT
    app_license_url_2: http://symfony.com/doc/current/contributing/code/license.html
    org_name:          Org
    org_abbreviation:  ORG
    org_address:       Org Address
    org_telephone:     Org Phone No
    org_email:         Org Email Address
    org_url:           http://myurl.domain
```


If you are already using one of the libraries required for the PresentationBundle
to work, then you can reference it with a named asset. Listed below are the named
assets you can set in your configuration file to override:

  + jquery
  + jqueryui
  + bootstrapjs
  + bootstrapless
  + cookie
  + elementqueries
  + modernizr
  + favicons

```yaml
# app/config/config.yml
assetic:
    assets:
        jquery_and_ui:
            inputs:
                - '@AcmeFooBundle/Resources/public/js/thirdparty/jquery.js'
                - '@AcmeFooBundle/Resources/public/js/thirdparty/jquery.ui.js'
   
```             

Updating
--------

How to update.

Usage
-----

How to use.


Code Snippet
------------

.. code-block:: html

    <body>
        <h1 class="your-class">code</h1>
        <p>some code here</p>
    </body>


Troubleshooting
---------------

This bundle is likely to fail if you attempt to install it.
I must work on this more.

History
-------

2013/05/31 - initial commit, probably several problems
