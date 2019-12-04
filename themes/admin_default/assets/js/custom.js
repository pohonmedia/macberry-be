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
    // Desc Add Textarea
    if($('#desc_area').length != 0) {
        $('#desc_area').summernote({
            tabsize: 2,
            height: 300
        });
    }
    // Desc Add Textarea
    if($('#ct_desc').length != 0) {
        $('#ct_desc').summernote({
            tabsize: 2,
            height: 200
        });
    }

    // Sub Categories Chained
    if ($('#subCats').length != 0) {
        $("#subCats").chained("#cats");
    }

    // Menu Section
    if ($('#url_link_input').length) {
        $('#url_link_input').attr('readonly', true);
        if (typeof linkVal !== 'undefined') {
            $('#option-type').val(menuType).change();
            // the variable is defined
        } else {
            $('#url_link_input').val('');
        }
    }

    if ($('#btnSelectArticleCat').length) {
        $('#btnSelectArticleCat').addClass('disabled');
    }

    if ($('#btnSelectCatalogCat').length) {
        $('#btnSelectCatalogCat').addClass('disabled');
    }

    // Edit Menu
    if ($('#option-type').length) {
        if ($('#option-type option:selected').val() === 'pages') {
            $('#pages-select').removeClass('d-none');

            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
            $('#url_link_input').attr('readonly', true);
            if (typeof linkVal === 'undefined') {
                $('#url_link_input').val('');
            }
        } else if ($('#option-type option:selected').val() === 'articles') {
            $('#article-select').removeClass('d-none');

            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
            if (typeof linkVal !== 'undefined') {
                if (linkVal === 'articles') {
                    $('input[name=article_type][value=1]').attr('checked', true);
                } else if (linkVal === 'articles/categories') {
                    $('input[name=article_type][value=2]').attr('checked', true);
                } else {
                    $('input[name=article_type][value=3]').attr('checked', true);
                }
            }
            var art_type = $('input[name=article_type]:checked', '#article-select').val();
            $('#url_link_input').attr('readonly', true);
            if (art_type === '1') {
                $('#url_link_input').val('articles');
                if (!$("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').addClass('disabled');
                }
            } else if (art_type === '2') {
                $('#url_link_input').val('articles/categories');
                if (!$("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').addClass('disabled');
                }
            } else {
                if (typeof linkVal === 'undefined') {
                    $('#url_link_input').val('');
                }
                if ($("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').removeClass('disabled');
                }
            }
        } else if ($('#option-type option:selected').val() === 'catalogs') {
            $('#catalog-select').removeClass('d-none');

            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }

            if (typeof linkVal !== 'undefined') {
                if (linkVal === 'catalogs') {
                    $('input[name=catalog_type][value=1]').attr('checked', true);
                } else if (linkVal === 'catalogs/categories') {
                    $('input[name=catalog_type][value=2]').attr('checked', true);
                } else {
                    $('input[name=catalog_type][value=3]').attr('checked', true);
                }
            }

            var catalog_type = $('input[name=catalog_type]:checked', '#catalog-select').val();
            $('#url_link_input').attr('readonly', true);
            if (catalog_type === '1') {
                $('#url_link_input').val('catalogs');
                if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                    $('#btnSelectCatalogCat').addClass('disabled');
                }
            } else if (catalog_type === '2') {
                $('#url_link_input').val('catalogs/categories');
                if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                    $('#btnSelectCatalogCat').addClass('disabled');
                }
            } else {
                if (typeof linkVal === 'undefined') {
                    $('#url_link_input').val('');
                }
                if ($("#btnSelectCatalogCat").hasClass("disabled")) {
                    $('#btnSelectCatalogCat').removeClass('disabled');
                }
            }
        } else if ($('#option-type option:selected').val() === 'link' || $('#option-type option:selected').val() === 'eksternal') {
            $('#url_link_input').attr('readonly', false);
            if (typeof linkVal === 'undefined') {
                $('#url_link_input').val('');
            }

            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
        } else {
            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
            $('#url_link_input').attr('readonly', true);
            $('#url_link_input').val('contacts');
        }
    }

    $('#option-type').on('change', function () {
        if (this.value === 'pages') {
            $('#pages-select').removeClass('d-none');

            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
            $('#url_link_input').attr('readonly', true);
            if (typeof linkVal === 'undefined') {
                $('#url_link_input').val('');
            }
        } else if (this.value === 'articles') {
            $('#article-select').removeClass('d-none');

            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
            if (typeof linkVal !== 'undefined') {
                if (linkVal === 'articles') {
                    $('input[name=article_type][value=1]').attr('checked', true);
                } else if (linkVal === 'articles/categories') {
                    $('input[name=article_type][value=2]').attr('checked', true);
                } else {
                    if(linkVal.toLowerCase().indexOf("articles") >= 0) {
                        $('input[name=article_type][value=3]').attr('checked', true);
                    } else {
                        $('input[name=article_type][value=1]').attr('checked', true);
                    }
                }
            }
            var art_type = $('input[name=article_type]:checked', '#article-select').val();
            $('#url_link_input').attr('readonly', true);
            if (art_type === '1') {
                $('#url_link_input').val('articles');
                if (!$("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').addClass('disabled');
                }
            } else if (art_type === '2') {
                $('#url_link_input').val('articles/categories');
                if (!$("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').addClass('disabled');
                }
            } else {
                if (typeof linkVal === 'undefined') {
                    $('#url_link_input').val('');
                }
                if ($("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').removeClass('disabled');
                }
            }
        } else if (this.value === 'catalogs') {
            $('#catalog-select').removeClass('d-none');

            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (typeof linkVal !== 'undefined') {
                if (linkVal === 'catalogs') {
                    $('input[name=catalog_type][value=1]').attr('checked', true);
                } else if (linkVal === 'catalogs/categories') {
                    $('input[name=catalog_type][value=2]').attr('checked', true);
                } else {
                    if(linkVal.toLowerCase().indexOf("catalogs") >= 0) {
                        $('input[name=catalog_type][value=3]').attr('checked', true);
                    } else {
                        $('input[name=catalog_type][value=1]').attr('checked', true);
                    }
                }
            }

            var catalog_type = $('input[name=catalog_type]:checked', '#catalog-select').val();
            $('#url_link_input').attr('readonly', true);
            if (catalog_type === '1') {
                $('#url_link_input').val('catalogs');
                if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                    $('#btnSelectCatalogCat').addClass('disabled');
                }
            } else if (catalog_type === '2') {
                $('#url_link_input').val('catalogs/categories');
                if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                    $('#btnSelectCatalogCat').addClass('disabled');
                }
            } else {
                if (typeof linkVal === 'undefined') {
                    $('#url_link_input').val('');
                }
                if ($("#btnSelectCatalogCat").hasClass("disabled")) {
                    $('#btnSelectCatalogCat').removeClass('disabled');
                }
            }
        } else if (this.value === 'link' || this.value === 'eksternal') {
            $('#url_link_input').attr('readonly', false);
            if (typeof linkVal === 'undefined') {
                $('#url_link_input').val('');
            }

            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
        } else {
            if (!$("#pages-select").hasClass("d-none")) {
                $('#pages-select').addClass('d-none');
            }
            if (!$("#article-select").hasClass("d-none")) {
                $('#article-select').addClass('d-none');
            }
            if (!$("#catalog-select").hasClass("d-none")) {
                $('#catalog-select').addClass('d-none');
            }
            $('#url_link_input').attr('readonly', true);
            $('#url_link_input').val('contacts');
        }
    });

    $('input[name=article_type]:radio').on('change', function () {
        if (this.value === '1') {
            $('#url_link_input').val('articles');
            if (!$("#btnSelectArticleCat").hasClass("disabled")) {
                $('#btnSelectArticleCat').addClass('disabled');
            }
        } else if (this.value === '2') {
                $('#url_link_input').val('articles/categories');
                if (!$("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').addClass('disabled');
                }
        } else {
                $('#url_link_input').val('');
                if ($("#btnSelectArticleCat").hasClass("disabled")) {
                    $('#btnSelectArticleCat').removeClass('disabled');
                }
        }
    });

    $('input[name=catalog_type]:radio').on('change', function () {
        if (this.value === '1') {
            $('#url_link_input').val('catalogs');
            if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                $('#btnSelectCatalogCat').addClass('disabled');
            }
        } else if (this.value === '2') {
            $('#url_link_input').val('catalogs/categories');
            if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                $('#btnSelectCatalogCat').addClass('disabled');
            }
        } else {
            $('#url_link_input').val('');
            if (!$("#btnSelectCatalogCat").hasClass("disabled")) {
                $('#btnSelectCatalogCat').removeClass('disabled');
            }
        }
    });
});

function getConfirmation(msg) {
    var retVal = confirm(msg);
    if (retVal === true) {
        return true;
    } else {
        return false;
    }
}

//FUNCTION FOR EVERYTHING
function showSelectPages() {
    $("#modalTitle").html('List All Pages');
    $.ajax({
        url: BASE_URL + 'admin/menus/list_pages_ajax',
        method: 'POST',
        success: function (resp) {
            var resp = JSON.parse(resp);
            var htmlStr = '';
            if (resp.success) {
                htmlStr += '<input type="hidden" name="popuptype" id="popupType" value="list-pages">';
                htmlStr += '<div id="list-pages">';
                $.each(resp.data, function (i, item) {
                    htmlStr += '<div class="radio">';
                    htmlStr += '<label>';
                    htmlStr += '<input type="radio" name="pages_list" value="' + resp.data[i].hal_slug + '">' + resp.data[i].hal_title;
                    htmlStr += '</label>';
                    htmlStr += '</div>';
                });
                htmlStr += '</div>';
                $("#modalContent").html(htmlStr);
            } else {
                $("#modalContent").html('Tidak Ada Daftar Pages');
            }
        }
    });
    $("#ajaxModal").modal('show');
}

function showArticleCategory() {
    $("#modalTitle").html('List All Article Category');
    $.ajax({
        url: BASE_URL + 'admin/menus/list_artcat_ajax',
        method: 'POST',
        success: function (resp) {
            var resp = JSON.parse(resp);
            var htmlStr = '';
            if (resp.success) {
                htmlStr += '<input type="hidden" name="popuptype" id="popupType" value="list-article-cat">';
                htmlStr += '<div id="list-art-cat">';
                $.each(resp.data, function (i, item) {
                    htmlStr += '<div class="radio">';
                    htmlStr += '<label>';
                    htmlStr += '<input type="radio" name="category_art_list" value="' + resp.data[i].ct_slug + '">' + resp.data[i].ct_name;
                    htmlStr += '</label>';
                    htmlStr += '</div>';
                });
                htmlStr += '</div>';
                $("#modalContent").html(htmlStr);
            } else {
                $("#modalContent").html('Tidak Ada Daftar Category');
            }
        }
    });
    $("#ajaxModal").modal('show');
}

function showCatalogCategory() {
    $("#modalTitle").html('List All Catalog Category');
    $.ajax({
        url: BASE_URL + 'admin/menus/list_catscat_ajax',
        method: 'POST',
        success: function (resp) {
            var resp = JSON.parse(resp);
            var htmlStr = '';
            if (resp.success) {
                htmlStr += '<input type="hidden" name="popuptype" id="popupType" value="list-catalog-cat">';
                htmlStr += '<div id="list-cats-cat">';
                $.each(resp.data, function (i, item) {
                    htmlStr += '<div class="radio">';
                    htmlStr += '<label>';
                    htmlStr += '<input type="radio" name="category_cats_list" value="' + resp.data[i].ct_slug + '">' + resp.data[i].ct_name;
                    htmlStr += '</label>';
                    htmlStr += '</div>';
                });
                htmlStr += '</div>';
                $("#modalContent").html(htmlStr);
            } else {
                $("#modalContent").html('Tidak Ada Daftar Category');
            }
        }
    });
    $("#ajaxModal").modal('show');
}

function closeModal() {
    var type = $("#popupType").val();
    if (type === 'list-pages') {
        var pageVal = $('input[name=pages_list]:checked', '#list-pages').val();
        $('#url_link_input').val('pages/read/' + pageVal);
    } else if (type === 'list-article-cat') {
        var artVal = $('input[name=category_art_list]:checked', '#list-art-cat').val();
        $('#url_link_input').val('articles/category/' + artVal);
    } else {
        var catsVal = $('input[name=category_cats_list]:checked', '#list-cats-cat').val();
        $('#url_link_input').val('catalogs/category/' + catsVal);
    }

    $("#ajaxModal").modal('hide');
}

