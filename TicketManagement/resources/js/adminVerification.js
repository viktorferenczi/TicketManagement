$("#verificationButton").on("click",function(){
    alert("nothing is checked");
});

$("#date").change(function(){
    if($("#date").val().length != 0){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/attendance/date',
            method: 'post',
            data: {
                "date":$("#date").val()
            },
            success: function (data)
            {
                $("#verifiedStudents").empty();
                data.forEach(user => {
                    $("#verifiedStudents").append(user.name + "<br>");
                });
            },
            error: function (data)
            {
                console.log('Error:', data.responseText);
            }
        });
    }
});
