function makeRequest(method, target, token, params) {

    if (method === 'GET') {
        window.location.href = target;
        return;
    }

    var html = '<form action="' + target + '" method="POST">';
    html += '<input type="hidden" name="_method" value="' + method + '">';
    if (token != undefined) {
        html += '<input type="hidden" name="_token" value="' + token + '">';
    }

    if (params != undefined && params.id != undefined) {
        html += '<input type="hidden" name="id" value="' + params.id + '">';
    }
    if (params != undefined && params.value != undefined) {
        html += '<input type="hidden" name=" '+ params.valueName +' " value="' + params.value + '">';
    }


    html += '</form>';
    //var $form = html;
    //$form.appendTo("body").submit();
    $(html).submit();
};