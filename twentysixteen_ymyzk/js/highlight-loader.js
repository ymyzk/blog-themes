var $ = jQuery;

$(document).ready(function() {
  $('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });
  $('pre:not(:has(>code))').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});
