![PHP DOT ENV CONFIGURATION]('assets/images/php-dot-env-cover.png')

# PHP DOT ENV CONFIGURATION 

## Introduction

Simple functional library to read .ENV file and call its value using simple function `env()` everywhere in project.


## Setting up

1. Download and merge `config` directory to project's root directory.
2. Update `config-loader.php` file with Path of ENV file. Default is set already.
3. Add following line in any of the header/main config file or `index.php` in case of frameworks like Codeigniter 3.x

```
require('config/config-loader.php');
```

## Usage
1. Add varable in .ENV file as set
2. Use following format

```
KEY=VALUE
```

3. Empty lines will be ignored
Make sure no further `=` sign is there in key/value beside main saparator
4. Use the function simply as follow

```
env('BASE_URL');
```

That's it.