<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem SPP Tamsis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>
    <?php if(isset($message)){
    echo $message; 
}?> 
</h1>
<center>
 <form action="{{ URL::action('SqlController@loginHandler') }}" method="POST" enctype="multipart/form-data">
 {{csrf_field()}}
          <center>
          <h1 class="modal-title" id="exampleModalLabel">LOGIN ADMIN</h1>
          </center>
          
            
            <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" required/>
            </div>
            <br>
            <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" value="" required/>
            </div>
            <br>
            <button type="submit" class="btn btn-outline">LOGIN</button>
	  </form>
</center>
</body>
</html>