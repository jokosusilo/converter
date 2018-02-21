# converter

> Simple rendering function from JSON to HTML and PDF using mustache and phpwkhtmltopdf

Just a simple app for simplify my current project. I use this app to preview an email and pdf attachment before send the email in a real transaction.

## Install
- clone this project
- Install dependency using composer
```
composer install
```
- Download and install [wkhtmltopdf](https://wkhtmltopdf.org/downloads.html)

## Usage

Convert as HTML

```php
$convert->asHtml('example.html', 'example.json');
```

Or as PDF

```scss
$convert->asPdf('example.html', 'example.json');
```