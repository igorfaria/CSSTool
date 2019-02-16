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
  
  var link_manifest = document.createElement('link');
      link_manifest.href = "manifest.json";
      link_manifest.rel = 'manifest';
    document.getElementsByTagName('head')[0].appendChild(link_manifest);
  
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