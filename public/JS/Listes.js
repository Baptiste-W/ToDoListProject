$('#saveCreateList').click(function(){
    var nom = $('#createList').val();
    if(nom !== '') {
        $.ajax({
            url: $(location).attr('origin') + '/list',
            type: 'POST',
            data: {nom: nom},
            success: function(data){
                $('#myList').append(($nom));
                $('.closeModal').click();
            }
        });
    }
});