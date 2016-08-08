$(document).ready(function() {
    var submitTimeout;

    $('[name=product_search]').submit(function () {
        var queryParams = $(this).serialize();
        $.get('product-partial', queryParams, function (res) {
            // update the list
            $('#product-list').html(res);
            // replace the query params
            window.history.replaceState({path: '?' + queryParams}, '', '?' + queryParams);
        });
        return false; // prevent default action
    }).change(function () {
        // brand field has been updated
        clearTimeout(submitTimeout);
        $(this).submit();
    }).bind("input", function () {
        // search field has been updated
        // this is a short implementation of a throttle function
        clearTimeout(submitTimeout);
        var _this = $(this);
        submitTimeout = setTimeout(function() {
            _this.submit();
        }, 200);
    });
});
