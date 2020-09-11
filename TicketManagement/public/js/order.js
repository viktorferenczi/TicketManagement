/**
 *
 * Order for ticket list
 *
 */
$(document).ready(function() {

    // created at order----------------------------
     $("#created_at").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //error 419
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
                    //got yyyy-mm-ddt00:00:00.000z from backend in json
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
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    });

// due date order----------------------------
    $("#due_date").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//error 419
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
                    //got yyyy-mm-ddt00:00:00.000z from backend in json
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
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    });



/**
 *
 * Order for customer ticket list
 *
 */


    // created at order----------------------------
    $("#created_at_customer").click(function() {
        let order = 'created_at';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//error 419
            }
        });
        $.ajax({
            url: '/'+$("#created_at_customer").val() +'/tickets/order/'+order,
            method: 'post',
            data: {
                "customer":$("#created_at_customer").val(),
                "order":'created_at'
            },
            success: function (data)
            {
                $("#customerTaxList").empty();
                data.forEach(ticket => {
                    //got yyyy-mm-ddt00:00:00.000z from backend in json
                    let date = ticket.created_at.slice(0,10);
                    let time = ticket.created_at.slice(11,19);
                    $("#customerTaxList").append('<div class="card mb-5">' +
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
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    });

    // due date order----------------------------
    $("#due_date_customer").click(function() {
        let order = 'due_date';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//error 419
            }
        });
        $.ajax({
            url: '/'+$("#due_date_customer").val() +'/tickets/order/'+order,
            method: 'post',
            data: {
                "customer":$("#due_date_customer").val(),
                "order":'due_date'
            },
            success: function (data)
            {
                $("#customerTaxList").empty();
                data.forEach(ticket => {
                    //got yyyy-mm-ddt00:00:00.000z from backend in json
                    let date = ticket.created_at.slice(0,10);
                    let time = ticket.created_at.slice(11,19);
                    $("#customerTaxList").append('<div class="card mb-5">' +
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
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    });
});


