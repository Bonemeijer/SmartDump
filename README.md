# SmartDump

A smarter alternative to var_dump for PHP5.6+

The goal is to provide a friendly debug tool that is framework independent and works across multiple environments.

[![Build Status](https://travis-ci.org/Bonemeijer/SmartDump.svg?branch=master)](https://travis-ci.org/Bonemeijer/SmartDump)
[![Latest Stable Version](https://poser.pugx.org/bonemeijer/smartdump/v/stable)](https://packagist.org/packages/bonemeijer/smartdump)
[![Total Downloads](https://poser.pugx.org/bonemeijer/smartdump/downloads)](https://packagist.org/packages/bonemeijer/smartdump)
[![License](https://poser.pugx.org/bonemeijer/smartdump/license)](https://packagist.org/packages/bonemeijer/smartdump)

### Installing

This project is still in beta. Backwards incompatible changes might be introduced during this time.

```
composer require --dev bonemeijer/smartdump
```

## Basic usage

By default, SmartDump is configured to detect where you are debugging from and will output either plaintext 
or html. For example: when you dump from the commandline, a plaintext output is used. But when you are 
debugging from a browser, an interactive HTML output is used.

There is a main `SmartDump` class, which provides a friendly global interface to debug a variable anywhere 
in your code. But don't worry, you can use and configure your own instances too.

```php
\SmartDump\SmartDump::dump($variable);
``` 


### Shortcut functions

Even easier are the shortcut functions. These live in the global namespace so you don't have to do any
imports when you quickly want to debug a variable.

Available functions:

* `smartdump($variable)` - shortcut for `\SmartDump\SmartDump::dump($variable);`
* `smartdump_text($variable)` - dump plaintext to output
* `smartdump_html($variable)` - dump simplehtml to output
* `smartdump_text_stream` - dump plaintext to a file or url
* `d($variabe)` - dump a context aware format to output
* `o($variabe)` - dump a context aware format to output, clear output buffer and exit()

**TIP** - the shortcut function `smartdump()` uses the global SmartDump class, so you can configure the desired
          behaviour through the SmartDump class.

## Advanced usage

SmartDump will internally convert any passed variable to a *Node* using a *NodeFactory*.
These Nodes will then be passed to a *Dumper*, which will accept *Formatter* to render an output format.


### Nodes

A *Node* is basically an internal representation of a variable. The `DefaultNodeFactory` has support for
all regular PHP variable types like booleans, strings, integers, floats, arrays, objects, resources and 
NULL values.


### Formatters

A formatter formats the *Node* to output that can be handles by a *Dumper*. 
At this time there are only string type formatters, which will render a *Node* to a string.

By default, the `ContextAwareStringFormatter` will be used, which will return a formatter based on where
you are debugging from.

Available formatters:

* `PlainTextStringFormatter` - formats to plaintext, for use in commandline and other text based environments
* `DomStringFormatter` - can use a `Markup` document to output HTML (or someday XML or any other markup language)
* `ContextAwareStringFormatter` - switches between plaintext and dom based on the current environment
* `CallBackStringFormatter` - accepts callbacks to determine which formatter is used

To globally use a different formatter for all `SmartDump::dump()` calls:

```php
\SmartDump\SmartDump::setFormatter(
    new \SmartDump\Formatter\StringFormatter\PlainTextStringFormatter()
);
```


### Dumpers

A *Dumper* will determine how the formatted node will be handled. By default, the `OutputDumper` is used,
which will just echo the output to the screen.

Available dumpers:

* `OutputDumper` - simply echo's the output
* `StreamDumper` - dumps the formatted output to a file or stream

To globally use a different dumper for all `SmartDump::dump()` calls:

```php
\SmartDump\SmartDump::setDumper(
    new \SmartDump\Dumper\StreamDumper('output.txt')
);
```


## Deployment

Don't. Don't deploy debug tools. Which is why I recommend using the `--dev` flag during installation.


## Versioning

SmartDump uses [SemVer](http://semver.org/) for versioning. For the versions available, see the 
[tags on this repository](https://github.com/Bonemeijer/SmartDump/tags). 


## Authors

* **Maurice Bonemeijer** - *Initial work* - [Bonemeijer](https://github.com/Bonemeijer)

See also the list of [contributors](https://github.com/Bonemeijer/SmartDump/contributors) who participated in this 
project.


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details


## Links

* [Travis-CI build on travis-ci.org](https://travis-ci.org/Bonemeijer/SmartDump)
* [SonarQube report on sonarcloud.io](https://sonarcloud.io/dashboard?id=bonemeijer%3Asmartdump)
