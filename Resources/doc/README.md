# MesdPresentationBundle

v.2.0.0

## Introduction

## The Base Template

The base template for the presentation bundle has been simplified greatly.
It includes less blocks with more options to override blocks as needed,
making the template extremely customizeable.

### Blocks (Base Template Only)

Block Purpose

* `_html` - Contains entire document.
* `html`  - Contains content between `html` tags.
* `_head` - Contains content including `head` tags.
* `head` - Contains content between `head` tags.
* `metas` - Contains `meta` tag content. Already outermost block.
* `title` - Contains `title` tag content. Already outermost block.
* `stylesheets` - Contains `style` tag content. Already outermost block.
* `fonts` - Contains `resource` tag content. Already outermost block.
* `icos` - Contains `resource` tag content. Already outermost block.
* `shim` - Contains `script` tag content. Already outermost block.
* `_body` - Contains content including `body` tags.
* `body` - Contains content between `body` tags.
* `_header` - Contains content including `header` tags.
  This is the top navigation bar.
* `header` - Contains content including `header` tags.
  This is the top navigation bar.
* `_wrapper` - Contains content including `div.wrapper` tags.
  Wrapper holds all content between header and footer.
* `wrapper` - Contains content between `div.wrapper` tags.
  Wrapper holds all content between header and footer.
    * `_leftaside` - Contains content between `aside.sidebar` tags.
    * `leftaside` - Contains content including `aside.sidebar` tags.
    * `_main` - Contains content including `main` tags.
    * `main` - Contains content between
      `main.container-fluid > div.row > div.col-sm-12 >` tags.
* `_footer` - Contains content including `footer` tags.
* `footer` - Contains content between `footer` tags.
* `modals` - Contains `div` content for modals.
  Used for code organization. If javascript not running,
  a no-js message degrades gracefully to prevent modals displaying on page.
  Already outermost block.
* `javascripts` - Contains `script` tag content. Already outermost block.
* `scripts` - Contains `script` tag content.
  Used for page specific scripts. Code runs after script libraries are loaded
  to prevent dependencies not being met.
  Also used for code organization.
  Already outermost block.

Block Hierarchy

* `_html`
* `html`
    * `_head`
    * `head`
        * `metas`
        * `title`
        * `stylesheets`
        * `fonts`
        * `icos`
        * `shim`
    * `_body`
    * `body`
        * `_header`
        * `header`
        * `_wrapper`
        * `wrapper`
            * `_leftaside`
            * `leftaside`
            * `_main`
            * `main`
        * `_footer`
        * `footer`
        * `modals`
        * `javascripts`
        * `scripts`

### Overriding a Block

When overriding a block, be aware that only 'inner content' is replaced.
To override the 'outer content', simply include an underscore prior
to the block name. For example:

Override the 'main' content block:

```php
{% extends 'MesdPresentationBundle:Default:index.html.twig' %}

{% block main %}
Hello, world!
{% endblock main %}
```

outputs

```html

<body>
    <main class="container-fluid">
        <div class="inner-container">
            <div class="row">
                <div class="col-sm-12">Hello, world!</div>
            </div>
        </div>
    </main>
</body>
```

Override the '_main' content block:

```php
{% extends 'MesdPresentationBundle:Default:index.html.twig' %}

{% block _main %}
Hello, world!
{% endblock _main %}
```

outputs

```html

<body>
Hello, world!
</body>
```

