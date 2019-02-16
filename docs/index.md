# CSS Tool

Another CSS tool in CSS.

## Installing

You have to install this way or this other way. 

### Usage

You use it like this.

### Methods

These are the methods

- Method 1
-- You use it this way
- Method 2
-- This one you use like this

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
  var header_tag = document.getElementsByTagName('head')[0];
  
  /* Create the link tag dynamically to manifest lol */
  var link_manifest = document.createElement('link');
      link_manifest.href = "manifest.json";
      link_manifest.rel = 'manifest';
      header_tag.appendChild(link_manifest);

  /* Create the link tag dynamically favicon lol */
  var link_favicon = document.createElement('link');
      link_favicon.href = "assets/img/logo-192px.png";
      link_favicon.rel = 'shortcut icon';
      link_favicon.type = 'image/png';
      header_tag.appendChild(link_manifest);
  
  /* Try to register the empty service-worker, to "add to home banner" in Chrome */
  if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker.register('service-worker.js')
      .then(function(reg){
        console.log("Yes, it did.");
      }).catch(function(err) {
        console.log("No it didn't. This happened: ", err)
      });
  }
</script>