
if ($('#subCats').length) // use this if you are using id to check
{
    $("#subCats").chained("#cats");
}

if ($('#desc_area').length) // use this if you are using id to check
{
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('desc_area');
    });
}