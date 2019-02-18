<div align='center'>
    <a href='https://igorfaria.github.io/CSSTool/' title='Another CSS tool in PHP'>
        <img src='https://igorfaria.github.io/CSSTool/assets/img/logo.png' alt='CSSTool logo' />
    </a>
    <br />
    Another tool to parse CSS, minify and optimize CSS properties and values
    <br /><br />
     <a href='https://igorfaria.github.io/CSSTool/' title='Another CSS tool in PHP'>https://igorfaria.github.io/CSSTool/</a>
</div>


# CSS Tool

#### Another CSS tool in CSS.

This is a <strong>CSS optimizer</strong> that parse CSS code into a set of associatives arrays. 
You can manipulate the CSS with PHP and execute the magic of optimization, outputing the result as a text or save into a file.
<br><br>

#### Optimizations
- **Minify CSS**: Replace multiple spaces, break lines and last semicolons
- **Optimize Values**: Remove zeros when it is not needed (0.3s -> .3s)
- **RGB to HEX**: Colors rgb to hex (*rgb(255,255,255)* -> *#fff*)
- **HLS to HEX**: Colors hls to hex (*hsl(236, 0%, 0%)* -> *#000*)
- **Optimize HEX**: Abbreviation for hex (*#ffcc00* -> *#fc0*)
- **Improve Compatibility**: Add prefixes (*-webkit-*, *-moz-*, *-ms-* and *-o-*)
- **Optimize Syntax**: Shorthand properties

## Installing

You have to install this way or this other way. 

### Usage

You can use the CSS Tool to optimize one or multiple CSS files, outputing as a text or saving into a file.

```php
<?php
// Include the autoloader or the classes files
require 'vendor/autoload.php';

// Declare the use of CSSTool
use CSSTool;

// Create an instanece of CSSTool\CSS class
$CSS = new CSS;

// Load the initial CSS from a file
$CSS->load('assets/css/css1.css');

// Load another CSS file, appending to the previous CSS
$CSS->load('assets/css/css2.css');

// Saves the final merged and optimized CSS into a file
if($CSS->save('assets/css/optimized.min.css')){
  echo 'Saved with sucess!';
} else {
  echo 'Something went wrong...';
}
```

And of course you can do much more, just check the public methods and you can do see that there is a lot more to do with CSS Tool. 
If you have a task that involve manipulate CSS with PHP or just minify and optimize CSS, this is it.

### Methods

These are the public methods:

#### Method set(*$cssInput*)
***$cssInput***: string or array

Used to set initial CSS. 
Can be used with an array of parsed CSS or the CSS code in a string, it will not append, it will replace the actual data.

You can use the set() method with string, this string could come from a file or whatever. 

```php
<?php
$CSS = new CSSTool\CSS;

// Set an initial CSS from string
$CSS->set('body{color:#333}');

echo $CSS->get('string');
```

Output: 

```css
body{color:#333}
```

Or if you have an set of rules structured in an associative array, you can use that too:

```php
<?php
$CSS = new CSSTool\CSS;

// Set an initial CSS from array
$rule = array( 
    'body' => array('color' => '#333')
);
$CSS->set($rule);
echo $CSS->get('string');
```

Will output: 
```css
body{color:#333}
```
<br>

#### Method load(*$cssFilepath*)
***$cssFilepath***: string with local path or remote URL to a CSS file

Used load CSS from a file. 
The subsequently loaded files will be appended to the CSS already in the object. 

Loading a CSS file from a local path:

```php
<?php
$CSS = new CSSTool\CSS;

// Load CSS from a file
$CSS->load('tests/example.css');

echo $CSS->get('string');
```

Output: 

```css
body{color:#333}
```

Loading a CSS file from an URL:

```php
<?php
$CSS = new CSSTool\CSS;

// Load CSS from a file
$CSS->load('https://localhost/tests/example.css');

echo $CSS->get('string');
```

Output: 

```css
body{color:#333}
```
<br>

#### Method save(*$cssFilepath*)
***$cssFilepath***: string with pathname to the output file

Used to save a file with the CSS defined in the object.

Saving into a file:

```php
<?php
$CSS = new CSSTool\CSS;

$CSS->set('body{color:#333}');
// Create a optimized file
if($CSS->save('tests/css/example-min.css')){
  echo 'File created with success';
} else {
  echo 'Something went wrong...';
}
```
<br>

#### Method parse(*$cssStringInput*)
***$cssStringInput***: string

Used to get a CSS in a string parsed into a set of rules in an associative array, to be manipulated and appended or prepended to the CSS later.

Example of parsing: 

```php
<?php
$CSS = new CSSTool\CSS;

// string with CSS
$stringCSS = 'body {color:red;} p {margin:0}';

// Array with parsed CSS
$parsedCSS = $CSS->parse($stringCSS);

var_dump($parsedCSS);
```

Output: 

```
array(2) {
  [0]=>
  array(1) {
    ["body"]=>
    array(1) {
      ["color"]=>
      string(3) "red"
    },
  [1]=>
  array(1) {
    ["p"]=>
    array(1) {
      ["margin"]=>
      string(1) "0"
    }
  }
```
<br>

#### Method append(*$cssInput*)
***$cssInput***: string or array

Used to add CSS rules at the end of the CSS:

```php
<?php
$CSS = new CSSTool\CSS;

// Set initial CSS 
$CSS->set('body{color:#333333;}');

// Add rule to the end of the CSS
$CSS->append(array(
    'p' => array('color'=>'#222222'),
));

echo $CSS->get('string');
```

Output:

```css
body{color:#333}p{color:#222}
```
<br>

#### Method prepend(*$cssInput*)
***$cssInput***: string or array

Used to add CSS rules at the beginning of the CSS:

```php
<?php
$CSS = new CSSTool\CSS;

// Set initial CSS 
$CSS->set('body{color:#333333;}');

// Add rule to the beginning of the CSS
$CSS->prepend(array(
    'p' => array('color'=>'#222222'),
));

echo $CSS->get('string');
```

Output: 

```css
p{color:#222}body{color:#333}
```
<br>

#### Method get(*$format='array',$minified=true*)
***$format***:  'array', 'string' or 'json'
***$minified***: true or false

Used to get the CSS in the indicated format.
The *$minified* attribute has no effect in the array format.

The default value of the get() parameter is 'array', so the return will be a set of associatives arrays:

```php
<?php
$CSS = new CSSTool\CSS;

$CSS->load('tests/example.css');

// Output as an array
echo $CSS->get();
```

Output: 

```
array(1) {
  [0]=>
  array(1) {
    ["body"]=>
    array(1) {
      ["color"]=>
      string(4) "#333"
    }
  }
```
<br>
If you need the CSS in a string you have to indicate the *$format* with the value *'string'*

```php
<?php
$CSS = new CSSTool\CSS;

$CSS->load('tests/example.css');

// Output as a string
echo $CSS->get('string');
```

Output: 

```css
body{color:#333}
```
<br>
If you need the CSS in a string but not minified, you have to indicate the *$minified* atribute as *false*

```php
<?php
$CSS = new CSSTool\CSS;

$CSS->load('tests/example.css');

// Output a non minified string
echo $CSS->get('string', false);
```

Output: 

```css
body{
  color:#333
}
```

You can also use the *$format* as 'json', but I think you kinda get it.
<br><br>

#### Configurations
- **autoprefixer:** (*default: true*) - add prefixes automatically to specified properties that require vendor prefixes

Example: 

```css
.example {
    -moz-transform: rotate(30deg);
    -webkit-transform: rotate(30deg);
    -ms-transform: rotate(30deg);
    transform: rotate(30deg);
}
```

- **optimize:** (*default: true*) - optimize values and properties of CSS

Example of values not optimized:

```css
body {
    margin: 1.050px;
    transition: 0.3s;
    padding: 0px;
    color: rgb(255,0,0);
}
```

After optimization:

```css
body {
    margin: 1.05px;   /* Not needed zero removed from the end        */
    transition: .3s;  /* Not needed zero removed from the beggining  */
    padding: 0;       /* Zero is always zero :D                      */
    color: #f00;      /* Color rgb to hex and hex abbreviation.      */
}
```

If you need for for whatever reason disable the autoprefixer or the otimization, you can: 

```php
<?php
// Constructor receives the configs
$CSS = new CSSTool\CSS(['autoprefixer'=>false]); 
```
<br><br>

### Tools

- **CSS** - Manipulate and Optimizes CSS
- **Filer** - Read, Create and Delete files
- **Parser** - Parse CSS string into array of parsed CSS
- **Optimizer** - Optimize properties and values of a parsed CSS
- **Minifier** - Minify the CSS output
<br><br>

###### Running the tests

They are in the /tests/ folder.
You can run them through a web browser or using the command line.

To use the through browser you need to navigate to domain.com/tests/ :D

For using the command line, you need a to have PHP installed and execute the file *show_source.php* passing the paramter *f=tests/filename.php*.

Example:

```
php show_source.php f=tests/filename.php
```

:D