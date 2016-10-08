var $ = jQuery;

$(document).ready(function() {
  // Add a custom language for plain text
  hljs.registerLanguage("custom-plain", function(hljs) {
    return {};
  });

  $('pre code').each(function(i, block) {
    // remove padding of <pre>
    $(block).parent().css({padding: 0});
    hljs.highlightBlock(block);
  });
  $('pre:not(:has(>code))').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});
