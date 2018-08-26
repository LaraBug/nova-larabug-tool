<p align="center">
    <a href="https://www.larabug.com" target="_blank"><img width="130" src="https://www.larabug.com/images/icon128x121.png"></a>
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

## Screenshot

![Screenshot Larabug Nova Tool](https://raw.githubusercontent.com/LaraBug/nova-larabug-tool/master/screenshot.png)


## License

The larabug package is open source software licensed under the [license MIT](http://opensource.org/licenses/MIT)
