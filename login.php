<!DOCTYPE html>
<html>
    <head>
        <title>LigaBot</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/png" href="img/pandaicon.jpg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION ['login'])) {                              
            header("location: /app-web-frontend/profile.php");
            exit();
        }
        ?>
        <header class="titleTop">
            <a class="headerLink" href="about.html">Sobre</a>
            <a class="headerLink" href="login.php">LigaBot</a>
            <a class="headerLink" href="register.html">Cadastro</a>
        </header>

        <div class="content">
    
            <div class="image-div">
                <img class="imgStamp" src="img/panda.png">
            </div>
            <div class="login-form">
                <form method="POST" action="login_exe.php" >
                    <div class="form-group">
                        <label for="name"><i class="fa fa-user" aria-hidden="true"></i></label>
                        <input type="text" name="usuario" id="usuario" placeholder="Usuário" 
                        minlength="4" maxlength="16" required>
                    </div><br>
                    <div class="form-group">
                        <label for="password"><i class="fa fa-key" aria-hidden="true"></i></label>
                        <input type="password" name="senha" id="senha" minlength="8" maxlength="16" size="16" placeholder="Senha" required>
                    </div><br>
                    <div class="form-group form-button">
                        <input type="submit" class="form-submit" value="Login"> 
                    </div>
                </form>
            </div>
    </body>
</html>