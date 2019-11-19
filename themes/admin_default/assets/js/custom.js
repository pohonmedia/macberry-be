/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$(document).ready(function() {
    // Homepage Text Area
    if($('#desc_area1').length != 0) {
        $('#desc_area1').summernote({
            tabsize: 2,
            height: 100
        });
    }
    if($('#desc_area2').length != 0) {
        $('#desc_area2').summernote({
            tabsize: 2,
            height: 100
        });
    }
    if($('#desc_area3').length != 0) {
        $('#desc_area3').summernote({
            tabsize: 2,
            height: 100
        });
    }
    if($('#desc_area4').length != 0) {
        $('#desc_area4').summernote({
            tabsize: 2,
            height: 100
        });
    }
});