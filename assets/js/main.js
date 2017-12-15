var $ = require('jquery');
require('bootstrap-sass');
require('../css/global.scss');

$(document).ready(function () {
    $("#appbundle_room_object").keyup(function () {
        const inputObject = $(this).val().toLowerCase();
        if (inputObject.length >= 2) {
            $.ajax({
                type: "POST",
                url: "/search/objects/list/" + inputObject,
                dataType: 'json',
                timeout: 3000,
                success: function (response) {
                    const objects = JSON.parse(response.data);
                    let html='';
                    for (object of objects) {
                        html += `<li data-id="${object.id}">${object.name}</li>`;
                    }
                    $('#autocomplete').html(html);
                },
                error: function () {
                    $('#autocomplete').text('Ajax call error');
                }
            });
        }
    });
});