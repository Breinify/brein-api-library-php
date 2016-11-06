<p align="center">
  <img src="https://raw.githubusercontent.com/Breinify/brein-api-library-php/master/documentation/img/logo.png" alt="Breinify API PHP Library" width="250">
</p>

<p align="center">
Breinify's DigitalDNA API puts dynamic behavior-based, people-driven data right at your fingertips.
</p>

## Setting up IntelliJ as IDE

### Setup PHP

The IDE should always use the version installed in `/insts/php`. This is more complicated then it may be assumed. 
Nevertheless, first of all we have to setup the PHP binary within the IDE, which can be done through the settings 
(IntelliJ IDEA -> Preferences). The following picture shows the settings:

<img src="https://raw.githubusercontent.com/Breinify/brein-api-library-php/master/documentation/img/configuration-php.png" alt="Breinify IDE Settings - PHP" width="600">

### Setup Command Line Tool Support

First of all, the *Command Line Tool Support* is an additional plugin of JetBrains, which has to be installed. If installed,
the plugin can be configured within the settings (IntelliJ IDEA -> Preferences). The following image shows the settings 
to be used:

<img src="https://raw.githubusercontent.com/Breinify/brein-api-library-php/master/documentation/img/configuration-clt.png" alt="Breinify IDE Settings - Command Line Tool Support" width="600">

The command tool should execute the `composer.phar` with the `php-path.sh` script, which ensures the usage of the correct version:

`/insts/php/bin/php-path.sh <PATH_TO_GIT>/brein-workspace/brein-intellij-workspace/common-libs/composer/composer.phar`

Further information for the *Command Line Tool Support* can be found here:

* https://www.jetbrains.com/help/idea/2016.2/running-command-line-tool-commands.html
* https://www.jetbrains.com/help/idea/2016.2/command-line-tools-console-tool-window.html
* <https://plugins.jetbrains.com/plugin/6630>

### Setup Composer

The *Command Line Tool Support* already uses the *Composer* to execute all commands (and the dependency features can already
be used through there). Nevertheless, the usage of the *Composer* can also be used via the UI. To do so, the *Composer* has 
to be configured as well. This can be done in the settings (IntelliJ IDEA -> Preferences):

<img src="https://raw.githubusercontent.com/Breinify/brein-api-library-php/master/documentation/img/configuration-composer.png" alt="Breinify IDE Settings - Composer" width="600">

**Note:** The *Composer* may not use the PHP version installed in `/insts/php`. This cannot be ensured, nevertheless, 
using the `version` script shows the used version (i.e., `c run-script version`).

### Setup PHPUnit

IntelliJ also supports *PHPUnit*, which also have to be configured in settings (IntelliJ IDEA -> Preferences). The settings
should be as follow:

<img src="https://raw.githubusercontent.com/Breinify/brein-api-library-php/master/documentation/img/configuration-phpunit.png" alt="Breinify IDE Settings - PHPUnit" width="600">

**Note:** The *PHPUnit* may not use the PHP version installed in `/insts/php`. Nevertheless, calling the `test` script
ensures the correct usage (i.e., `c run-script test`).
