$('#saveCreateList').click(function(){
    var nom = $('#createList').val();
    if(nom !== '') {
        $.ajax({
            url: $(location).attr('origin') + '/list',
            type: 'POST',
            data: {nom: nom},
            success: function(data){
                $('#myList').append(`<a href="${$(location).attr('origin') + '/list/' + data.id}">
                        <img class="listIcons" src="/Pictures/tag-solid.svg">
                        <label for="listName">${nom}</label>
                    </a>`);
                $('.closeModal').click();
            }
        });
    }
});

$('.listName').click(function(){
    var taskId = $(this).attr('data-taskId');
    let checkbox = this;
    $.ajax({
        url: $(location).attr('origin') + '/taches/'+ taskId,
        type: 'delete',
        success: function(data){
            $(checkbox).parent().remove()
        }
    });
});


