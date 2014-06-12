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

Twig global variables are used to set static application data. You'll need to add
the following list of globals to your config file:

```yaml
# app/config/config.yml
twig:
    globals:
        appName:         %app_name%
        appAbbreviation: %app_abbreviation%
        appDescription:  %app_description%
        appKeywords:     %app_keywords%
        appUrl:          %app_url%
        appVersion:      %app_version%
        appBuild:        %app_build%
        appRelease:      %app_release%
        appLicense1:     %app_license_1%
        appLicenseUrl1:  %app_license_url_1%
        appLicense2:     %app_license_2%
        appLicenseUrl2:  %app_license_url_2%
        orgName:         %org_name%
        orgAbbreviation: %org_abbreviation%
        orgAddress:      %org_address%
        orgTelephone:    %org_telephone%
        orgEmail:        %org_email%
        orgUrl:          %org_url%
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
