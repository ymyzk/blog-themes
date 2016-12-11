if (typeof WPCOM_sharing_counts !== "undefined") {
  for (var url in WPCOM_sharing_counts) {
    var $shareTwitter = jQuery('a[data-shared=sharing-twitter-' + WPCOM_sharing_counts[url] + ']');

    jQuery.ajax({
      url     : "https://b.hatena.ne.jp/entry.count",
      data    : {url: encodeURI(url)},
      dataType: "jsonp",
      success : function(count) {
        if (typeof count === "undefined" || count <= 0) return;
        var $shareHatena = $shareTwitter.parent().nextAll(".share-custom-hatena").children("a");
        $shareHatena.find('span:has(.share-count)').remove();
        $shareHatena.append('<span style="padding: 0 !important"><span class="share-count" style="padding: 1px 3px !important; line-height: 9px; width: auto; height: auto;">' + WPCOMSharing.format_count(count) + '</span></span>');
      }
    });
  }
}
