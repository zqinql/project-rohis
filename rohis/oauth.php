<?php 

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Google -->
    <meta name="google-signin-scope" content="profile-email">
    <meta name="google-signin-client_id" content="625020178189-3lr1p3m84dnd8gqmr7vqqi3mb1am2odi.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div id="data">
    <div class="g-signin2" data-onsuccess="onSignIn" ></div>
    </div>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
      function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        
        var nama = profile.getName();
        var email = profile.getEmail();
        var img = profile.getImageUrl();
        $.ajax({
          url: "data.php",
          type: "post",
          data: {nama:nama, email:email, img:img},
          success: function(data){
            $('#tampil').html(data)
          }
        })
      }
    </script>
  </body>
</html>