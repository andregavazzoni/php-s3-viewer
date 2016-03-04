var s3Viewer = {
    init: function () {
        var _this = s3Viewer;

        _this.loadBuckets();

        jQuery('.sidebar').on('click', '.dir-tree > li > a', function (event) {
            event.preventDefault();
            
            _this.loadObjects(jQuery(this).attr('href'));
        });
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
    loadObjects: function (url) {
        jQuery.ajax({
            url: url,
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
        });
    }
};

jQuery(document).ready(function () {
    s3Viewer.init();
});