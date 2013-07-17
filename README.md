# EoWidgetBundle

Widgets for Symfony2

## Prerequisites
This version of the bundle requires Symfony 2.1+

## Installation

### Step 1: Download EoWidgetBundle using composer
Add EoWidgetBundle in your composer.json:
```
{
    "require": {
        "eo/widget-bundle": "dev-master"
    }
}
```

This will also install the following dependencies:
```
"doctrine/common": ">=2.1.3"
"jms/serializer-bundle": ">=0.9.0"
```

Now tell composer to download the bundle by running the command:
```
$ php composer.phar update eo/widget-bundle
```
Composer will install the bundle to your project's vendor/eo directory.

### Step 2: Enable the bundle
Enable the bundle in the kernel:
```
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Eo\WidgetBundle\EoWidgetBundle(),
    );
}
```

### Step 3: Configure the EoWidgetBundle
Now that you have properly installed and enabled EoWidgetBundle, the next step is to configure the bundle to work with the specific needs of your application.

Add the following configuration to your `config.yml` file
```
# app/config/config.yml
eo_widget:
    storages:
        session: true
```
Currently all configuration values are optional.

## Usage

(Not ready!)

## License
This bundle is under the MIT license. See the complete license in the bundle:
```
Resources/meta/LICENSE
```

## Reporting an issue or a feature request
Issues and feature requests related to this bundle are tracked in the Github issue tracker https://github.com/eymengunay/EoWidgetBundle/issues.

