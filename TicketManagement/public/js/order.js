$(document).ready(function() {
    $("#created_at").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/tickets/order/'+$("#created_at").val(),
            method: 'post',
            data: {
                "order":'created_at'
            },
            success: function (data)
            {
                $("#taxList").empty();
                data.forEach(ticket => {
                    let date = ticket.created_at.slice(0,10);
                    let time = ticket.created_at.slice(11,19);
                    $("#taxList").append('<div class="card mb-5">' +
                        '<div class="card-header">' +
                        "<strong>Ticket title:</strong> " + ticket.title +
                        "</div>" +
                        '<div class="card-body">' +
                        "<strong>Ticket description:</strong> "+ ticket.description +
                        "</div>" +
                        '<div class="card-footer">'+
                        "<strong>Created at:</strong> " + date + " " + time + " - " + "Duedate: " + ticket.due_date +
                        "</div>"+
                        "</div>")
                });
                console.log(data);
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    });


    $("#due_date").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/tickets/order/'+$("#due_date").val(),
            method: 'post',
            data: {
                "order":'due_date'
            },
            success: function (data)
            {
                $("#taxList").empty();
                data.forEach(ticket => {
                    let date = ticket.created_at.slice(0,10);
                    let time = ticket.created_at.slice(11,19);
                    $("#taxList").append('<div class="card mb-5">' +
                        '<div class="card-header">' +
                        "<strong>Ticket title:</strong> " + ticket.title +
                        "</div>" +
                        '<div class="card-body">' +
                        "<strong>Ticket description:</strong> "+ ticket.description +
                        "</div>" +
                        '<div class="card-footer">'+
                        "<strong>Created at:</strong> " + date + " " + time + " - " + "Duedate: " + ticket.due_date +
                        "</div>"+
                        "</div>")
                });
                console.log(data);
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    });


});


