$( document ).ready(function() {
    $("#appbundle_room_object").keyup(function(){
        alert('ifzef');
        const inputObject = $(this).val().toUpperCase();
        if ( inputObject.length >= 2 ) {
            $.ajax({
                type: "POST",
                url: "/object/list/" + inputObject,
                dataType: 'json',
                timeout: 3000,
                success: function(response){
                    const objects = JSON.parse(response.data);
                    let html = "";
                    for (object of objects) {
                        let highlightObject = object.object.replace(inputObject, `<span class="highlight">${inputObject}</span>`);
                        html += `<li class="list-group-item"><span class="object">${highlightObject}</span></li>`;                    }
                    $('#autocomplete').html(html);
                    $('#autocomplete li').on('click', function() {
                        let getObject = $(this).children('span').first().text();
                        $('#appbundle_room_object').val(getObject);
                        $('#autocomplete').html('');
                    });
                },
                error: function() {
                    $('#autocomplete').text('Ajax call error');
                }
            });
        } else {
            $('#autocomplete').html('');
        }
    });
});