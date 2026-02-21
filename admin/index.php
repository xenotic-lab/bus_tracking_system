<?php session_start(); if(isset($_POST['login'])){ if($_POST['username']=='admin'&&$_POST['password']=='admin'){ $_SESSION['admin']=1; header('Location: admin_dashboard.php'); exit;} $err='Invalid'; } ?>
<!doctype html>
<html>
    <head><meta charset='utf-8'>
    <title>Login</title>
    <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
</head>
<body>
    <div class='center-card'>
    <h2>Admin Login</h2>
    <?php if(!empty($err)) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
    <form method='post'>
        <input name='username' placeholder="Username" required>
        <input id="password" name='password' type='password' placeholder="Password" onclick="view()" required>
  
        <button name='login'>Login</button>
        <a class="btn" href="../">back</a>
</form>
</div>
<script>
    function view(){
        var x=document.getElementById("password");
        if(x.type==="password"){
            x.type="text";
        }
        else{
            x.type="password";
        }
    }
</script>
</body>
</html>