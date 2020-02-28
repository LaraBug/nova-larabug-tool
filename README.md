<p align="center">
    <a href="https://www.larabug.com" target="_blank"><img width="130" src="https://www.larabug.com/images/larabug-logo-small.png"></a>
</p>

# LaraBug

Laravel Nova Package

## Installation 

```
composer require larabug/nova-larabug-tool
```

Register the tool inside the `app/Providers/NovaServiceProvider.php` file:

```php
use Larabug\NovaLarabugTool\NovaLarabugTool;

...

public function tools()
{
    return [
        new NovaLarabugTool
    ];
}
```

## Usage

All that is left to do is to define 2 ENV configuration variables.

```
LB_KEY=
LB_PROJECT_KEY=
```

`LB_KEY` is your profile key which authorises your account to the API.
`LB_PROJECT_KEY` is your project API key which you receive when creating a project.

Get these variables at [larabug.com](https://www.larabug.com)

## Screenshot

![Screenshot Larabug Nova Tool](https://raw.githubusercontent.com/LaraBug/nova-larabug-tool/master/screenshot.png)


## License
The larabug package is open source software licensed under the [license MIT](http://opensource.org/licenses/MIT)
