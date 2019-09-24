var base_url = '/goal_tracker_app/public/';

$(document).ready(function () {
    $("#create").on('click', function (e) {
        e.preventDefault();
        var _token = $("input[name=_token]").val();
        var goal_id = $("input[name=goal_id]").val();
        var task = $("input[name=task]").val();
        var description = $("input[name=description]").val();

        $.ajax({
            type: 'POST',
            url: base_url + 'todo',
            data: { _token: _token, goal_id: goal_id, task: task, description: description },
            success: (data) => {
                $("#task").val('')
                $("#description").val('');
                /**
                 * @todo 
                 * pass new data to Dom Object
                 */
                Swal.fire(data.status, data.message, 'success');
            },
            error: (request) => {
                Swal.fire({type: 'error',title: 'Oops...',text: request.responseJSON.message})
            }
        });
    });
});
