# CSS Tool

Another CSS tool in CSS.

## Installing

You have to install this way or this other way. 

### Usage

You use it like this.

### Methods

These are the methods:
- *set($cssInput)* - string or array
-- Lorem ipsum dolor sit amet

- *load($cssFilepath)* - string local or remote
-- Lorem ipsum dolor

- *save($cssFilepath)* - string with path and name to the output file

- *parse($cssStringInput)* - string with CSS to be parsed

- *append($cssInput)* - string or array to be added to the final of the CSS

- *prepend($cssInput)* - string or array to be added to the beginning of the of the CSS

- *get($format='array',$minified=true)* - get the CSS in the indicated format. 
-- *$format* = 'array', 'string' or 'json'
-- *$minified* = true or false


#### Configs
- *autoprefixer:* true or false
- *optimize:* true or false


### Tools

- CSS 
- Filer
- Parser
- Optimizer
- Minifier

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
      link_manifest.href = "manifest.json?v1";
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
    navigator.serviceWorker.register('service-worker.js?v1')
      .then(function(reg){
        console.log("Yes, it did.");
      }).catch(function(err) {
        console.log("No it didn't. This happened: ", err)
      });
  }
  -->
</script>