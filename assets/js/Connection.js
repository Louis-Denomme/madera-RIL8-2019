function tryConnection(){

    console.log($("#username").val());
    console.log($("#password").val());
    var url = "http://localhost/madera-RIL8-2019/index.php/cConnection/tryConnection"
    var data = {
        username : $("#username").val(),
        password : $("#password").val()
    }

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (callback) {
            console.log(callback)
        },
        error: function(error1, error2, error3){
          console.log(error1);
          console.log(error2);
          console.log(error3);
        },
        dataType: 'html'
    });

}