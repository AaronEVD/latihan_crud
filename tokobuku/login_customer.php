<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>LOGIN Customer</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/js/popper.min.js"></script>
   <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <h2 align="center">Login Customer</h2>
        </div>
        <div class="card-body">
          <form action="prologcus.php" method="post">
            Username
            <input type="text" name="username" class="form-control" required/><br>
            Password
            <input type="password" name="password" class="form-control" required/><br>
            <button type="submit" name="login_customer" class="btn btn-dark">Login</button>
          </form>
        </div>
      </div>
      <!-- form modal -->
    </div>
  </body>
</html>
