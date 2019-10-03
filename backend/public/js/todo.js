var base_url = '/goal_tracker_app/public/';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

                var todo = '<tr id="todo_id_' + data.data.id + '"> <td><input type="checkbox"> <i class="dark-white"></i></td>';
                todo += '<td>' + data.data.task + '</td>';
                todo += '<td style="width:200px"><a href="javascript:void(0)"  data-id="' + data.data.id+ '" class="btn btn-outline-info btn-xs"> <i class="fa fa-plus"></i>View</a>';
                todo += '<a href="javascript:void(0)" data-id="' + data.data.id + '" class="btn btn-outline-warning btn-xs"> <i class="fa fa-plus"></i> Edit</a>';
                todo += '<a href="javascript:void(0)" data-id="' + data.data.id + '" class="btn  btn-outline-danger btn-xs delete"> <i class="fa fa-plus"></i> Del</a></td></tr>';

                $('#todo').prepend(todo);
                Swal.fire(data.status, data.message, 'success');
            },
            error: (request) => {
                Swal.fire({ type: 'error', title: 'Oops...', text: request.responseJSON.message })
            }
        });
    });

    $(".delete").on('click', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: base_url + 'todo/' + id,
                    success: (data) => {
                        $("#todo_id_" + id).remove();
                        Swal.fire(data.status, data.message, 'success');
                    },
                    error: (request) => {
                        Swal.fire({ type: 'error', title: 'Oops...', text: request.responseJSON.message })
                    }
                });
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })

    });
});
