/* 
 * JQuery script for the product filter
 * 
 */
$(document).ready(function() {
    $("#finderForm").ajaxForm({url: 'finder.php', type: 'post', dataType: 'json', beforeSubmit: validateSubmit, success: processJson});
    $("#clear").click(function() {
        clearForm();
    });
});

//Validate height fielt, before submitting
function validateSubmit(formData, jqForm, options) {
    var height = jQuery('input:text[name=height]').val();
    if ((height != '') && (!height.match(/^\d+$/))) {
        alert('Das Feld "Hoehe" muss eine Zahl sein!');
        return false;
    }
    $("#resultsList").html('<img src="images/loading-64.gif" />');
}
//Display JSON response as list
function processJson(data) {
    // 'data' is the json object returned from the server   
    $("#resultsList").html('');
    $.each(data, function(key, value) {
        $("#resultsList").append('<li><a onclick="event.preventDefault();openInParent(this);" class="productLink" href="' + value.url + '">' + value.name + '</a></li>');
    });
}
//Reset Button to clear form
function clearForm() {
    $(':input', '#finderForm')
            .removeAttr('checked')
            .removeAttr('selected')
            .not(':button, :submit, :reset, :hidden, :radio, :checkbox')
            .val('');
}
//Pop up Fenster
function windowpop(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=yes,location=no,directories=no");
}
//Open resilt links in the same tab as popup parent tab
function openInParent(url) {
    window.opener.location.href = url.href;
    return false;
}