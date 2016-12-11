if (typeof WPCOM_sharing_counts !== "undefined") {
  for (var url in WPCOM_sharing_counts) {
    var postId = WPCOM_sharing_counts[url];
    var $shareTwitter = jQuery('a[data-shared=sharing-twitter-' + postId + ']');

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

    jQuery.ajax({
      url     : "/wpcom-stats-proxy/stats/post/" + postId,
      success : function(data) {
        if (typeof data === "undefined") return;
        var count = data.views;
        if (typeof count === "undefined" || count <= 0) return;
        var $sharePV = $shareTwitter.parent().nextAll(".share-custom-pv").children("a");
        $sharePV.attr("href", "#");
        $sharePV.removeAttr("target");
        $sharePV.find('span:has(.share-count)').remove();
        $sharePV.append('<span style="padding: 0 !important"><span class="share-count" style="padding: 1px 3px !important; line-height: 9px; width: auto; height: auto;">' + WPCOMSharing.format_count(count) + '</span></span>');
      }
    });
  }
}
