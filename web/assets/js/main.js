var s3Viewer = {
    init: function () {
        var _this = s3Viewer;

        _this.loadBuckets();
    },
    loadBuckets: function () {
        jQuery.ajax({
            url: '/list-buckets',
            dataType: 'json'
        }).done(function (data) {
            jQuery.each(data, function (i, link) {
                link = "<li>" + link + '</li>';
                jQuery('ol.dir-tree').append(link);
            });
        });
    },
    loadObjects: function () {
        jQuery.ajax({
            
        });
    }
};

jQuery(document).ready(function () {
    s3Viewer.init();
});