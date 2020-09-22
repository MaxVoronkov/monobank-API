$(document).ready(function() {
    var accName = localStorage.getItem('accName');
 $.ajax({
             url: '../../functions/get_account.php',
             type: 'POST',
             data: {
                  name: accName
                },
             success: function(data) {
                $("#accinfo").html(data)

                },
            error: function() {
                    alert('Error');
                }
            });



    setInterval(function() {
         $.ajax({
             url: '../../functions/get_account.php',
             type: 'POST',
             data: {
                  name: accName
                },
             success: function(data) {
                $("#accinfo").html(data)

                },
            error: function() {
                    alert('Error');
                }
            });
}, 60000);

        $("#cal").change(function(){
         $("#fb").hide();
         $("#other").show();
         var date = $('input[name="cal"]').val();
         $.ajax({
             url: '../../functions/get_filter.php',
             type: 'POST',
             data: {
                  date: date
                },
             success: function(data) {
                $(".table-result").html(data)

                },
            error: function() {
                    alert('Error');
                }
            });

         })
        $("#other").click(function(){
          var date = $('input[name="cal"]').val();
          $("#other").hide();
          $("#fb").show();
          $.ajax({
             url: '../../functions/get_filter.php',
             type: 'POST',
             data: {
                  com: 'other',
                  date: date
                },
             success: function(data) {
                $(".table-result").html(data)

                },
            error: function() {
                    alert('Error');
                }
            });
         })
        $("#fb").click(function(){
          var date = $('input[name="cal"]').val();
          $("#fb").hide();
          $("#other").show();
              $.ajax({
                 url: '../../functions/get_filter.php',
                 type: 'POST',
                 data: {
                      com: 'fb',
                      date: date
                    },
                 success: function(data) {
                    $(".table-result").html(data)
                    },
                error: function() {
                        alert('Error');
                    }
                });
             })
});
