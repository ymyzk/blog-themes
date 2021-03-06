if (typeof WPCOM_sharing_counts !== "undefined") {
  var formatCount = function(count) {
    if (count < 1000) {
      return count;
    } else if (count >= 1000 && count < 10000) {
      return String(count).substring(0, 1) + '.' + String(count).substring(1, 2) + 'K';
    } else if (count >= 10000 && count < 100000) {
      return String(count).substring(0, 2) + 'K';
    }
    return '100K+';
  };

  for (var url in WPCOM_sharing_counts) {
    var postId = WPCOM_sharing_counts[url];
    var $shareTwitter = jQuery('a[data-shared=sharing-twitter-' + postId + ']');

    jQuery.ajax({
      url     : "https://jsoon.digitiminimi.com/twitter/count.json",
      data    : {url: encodeURI(url)},
      dataType: "jsonp",
      success : function(data) {
        if (typeof data === "undefined") return;
        var count = data.count;
        if (typeof count === "undefined" || count <= 0) return;
        WPCOMSharing.inject_share_count('sharing-twitter-' + postId, count);
      }
    });

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
        var countText = formatCount(count);
        var $sharePV = $shareTwitter.parent().nextAll(".share-custom-pv").children("a");
        $sharePV.attr("href", "#");
        $sharePV.attr("title", "PV");
        $sharePV.removeAttr("target");
        $sharePV.children(".sharing-screen-reader-text").text("PV: " + countText);
        $sharePV.find('span:has(.share-count)').remove();
        $sharePV.append('<span style="padding: 0 !important"><span class="share-count" style="padding: 1px 3px !important; line-height: 9px; width: auto; height: auto;">' + countText + '</span></span>');
      }
    });
  }
}
