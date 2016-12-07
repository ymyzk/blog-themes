window.addEventListener("DOMContentLoaded", function() {
  // Add a custom language for plain text
  hljs.registerLanguage("custom-plain", function(hljs) {
    return {};
  });

  // New style
  document.querySelectorAll("pre code").forEach(function(block) {
    // remove padding of <pre>
    block.parentNode.style.padding = 0;
    hljs.highlightBlock(block);
  });

  // Old style
  document.querySelectorAll("pre").forEach(function(block) {
    if (block.firstChild.nodeName !== "#text") { return; }
    hljs.highlightBlock(block);
  });
}, false);
