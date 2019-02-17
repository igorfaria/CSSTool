# CSS Tool

#### Another CSS tool in CSS.

This is a <strong>CSS optimizer</strong> that parse CSS code into an set of associatives arrays, allowing to manipulate the CSS with PHP and execute the magic, outputing as a text or into a file.
<br><br>

#### Optimize
- Minify
- Remove zeros when it is not needed (0.3s -> .3s)
- Colors rgb to hex (*rgb(255,255,255)* -> *#fff*)
- Colors hls to hex (*hsl(236, 0%, 0%)* -> *#000*)
- Abbreviation for hex (*#ffcc00* -> *#fc0*)
- Add prefixes (*-webkit-*, *-moz-*, *-ms-* and *-o-*)
- Shorthand properties

## Installing

You have to install this way or this other way. 

### Usage

You can use the CSS Tool to optimize one or multiple CSS files.
```php
<?php
// Includes the autoloader file or directly the class files
require 'vendor/autoload.php';

// Declare the use of CSSTool
use CSSTool;

// Create an instance
$CSS = new CSS;

// Load a CSS file
$CSS->load('assets/css/css1.css');

// Load another CSS file
$CSS->load('assets/css/css2.css');

// Saves the final
if($CSS->save('assets/css/optimized.minified.css')){
  echo 'Saved with sucess!';
} else {
  echo 'Something went wrong...';
}
```
And of course you can do much more, just check the public methods and you can do see that there is a lot more to do with CSS Tool.

### Methods

These are the methods:

**&#9900; $CSS->set(*$cssInput*)** - (*string* or *array*): to set the array of parsed css or in text, it will not append, it will replace the actual data

You can use the set() method with an string, this string could came from a webform or from loaded from a file for example 
```php
<?php
$CSS = new CSSTool\CSS;
// Set an initial CSS from string
$CSS->set('body{color:#333}');
echo $CSS->get('string');
```

Will output: 
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
<br><br>

**&#9900; $CSS->load(*$cssFilepath*)** - string with local path or remote URL to a CSS file

Loading a CSS file from a local path

```php
<?php
$CSS = new CSSTool\CSS;

// Load CSS from a file
$CSS->load('tests/example.css');
echo $CSS->get('string');
```

Will output: 
```css
body{color:#333}
```

Loading a CSS file from an URL
```php
<?php
$CSS = new CSSTool\CSS;
// Load CSS from a file
$CSS->load('https://localhost/tests/example.css');
echo $CSS->get('string');
```

Will output: 
```css
body{color:#333}
```
<br><br>

**&#9900; $CSS->save(*$cssFilepath*)** - string with pathname to the output file

```php
<?php
$CSS = new CSSTool\CSS;

$CSS->set('body{color:#333}');
// Create a minified file
if($CSS->save('tests/css/example-min.css')){
  echo 'File created with success';
} else {
  echo 'Something went wrong...';
}
```
<br><br>

**&#9900; $CSS->parse(*$cssStringInput*)** - string with CSS to be parsed

```php
<?php
// Create an instance
$CSS = new CSSTool\CSS;
// string with CSS
$stringCSS = 'body {color:red;} p {margin:0}';
// Array with parsed CSS
$parsedCSS = $CSS->parse($stringCSS);
// Output
var_dump($parsedCSS);
```

Will output: 
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
<br><br>

**&#9900; $CSS->append(*$cssInput*)** - string or array to be added to the final of the CSS

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

Will output: 
```css
body{color:#333}p{color:#222}
```
<br><br>

**&#9900; $CSS->prepend(*$cssInput*)** - string or array to be added to the beginning of the of the CSS

```php
<?php
$CSS = new CSSTool\CSS;

// Set initial CSS 
$CSS->set('body{color:#333333;}');
// Add rule to the beginning of the CSS
$CSSLoL->prepend(array(
    'p' => array('color'=>'#222222'),
));
echo $CSS->get('string');
```

Will output: 
```css
p{color:#222}body{color:#333}
```
<br><br>

**&#9900; $CSS->get($format=[*'array','string','json'*],$minified=*true*)** - get the CSS in the indicated format. 

The default value of the get() parameter is 'array', so the return will be an set of associatives arrays
```php
<?php
$CSS = new CSSTool\CSS;
$CSS->load('tests/example.css');
// Output as an array
echo $CSS->get();
```

Will output: 
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
<br><br>
If you need the CSS in a string you have to indicate that with the string value 'string' 
```php
<?php
$CSS = new CSSTool\CSS;
$CSS->load('tests/example.css');
// Output as a string
echo $CSS->get('string');
```

Will output: 
```css
body{color:#333}
```
<br><br>

#### Configs
- **autoprefixer:** (*default: true*) - add prefixes automatically if not yet defined to specified properties that you define and require vendor prefixes
- **optimize:** (*default: true*) - optimize values and properties of CSS

```php
<?php
// Passing autoprefixer as false through constructor, for whatever reason you need it 
$CSS = new CSSTool\CSS(['autoprefixer'=>false]); 
```
<br><br>

### Tools

- **CSS** - Optimizes CSS
- **Filer** - Read, Create and Delete files
- **Parser** - Parse CSS string into array of parsed CSS
- **Optimizer** - Optimize properties and values of a parsed CSS
- **Minifier** - Minify CSS output
<br><br>

###### Running the tests

They are in the /tests/ folder.
You can run them through a web browser or using the command line.

- Example 1
- Example 2 


<script>
  <!--
  var header_tag = document.getElementsByTagName('head')[0];

  /* Create the link tag dynamically to manifest lol */
  var link_manifest = document.createElement('link');
      link_manifest.href = "manifest.json?v2";
      link_manifest.rel = 'manifest';
      header_tag.appendChild(link_manifest);

  /* Create the link tag dynamically favicon lol */
  var link_favicon = document.createElement('link');
      link_favicon.href = "assets/img/logo-192px.png";
      link_favicon.rel = 'shortcut icon';
      link_favicon.type = 'image/png';
      header_tag.appendChild(link_favicon);

  
  /* Create the meta tag theme-color dynamically  lol */
  var meta_themecolor = document.createElement('meta');
      meta_themecolor.name = "theme-color";
      meta_themecolor.content = '#4e0863';
      header_tag.appendChild(meta_themecolor);
  
  /* Try to register the empty service-worker, to "add to home banner" in Chrome */
  if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker.register('service-worker.js?v2')
      .then(function(reg){
        console.log("Yes, it did.", reg);
      }).catch(function(err) {
        console.log("No it didn't. This happened: ", err)
      });
  }
  -->
</script>