<!DOCTYPE html>
<html>
    <head>
        <title>LigaBot</title>
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/png" href="img/pandaicon.jpg">
    </head>
    <body>
        <?php
            session_start();
            require 'database/connectDB.php'; 

            $conn = new mysqli($hostname, $username, $password, $database, $port);

            if ($conn->connect_error) {
                die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
            }

            $usuario = $conn->real_escape_string($_POST['usuario']); 
            $senha   = $conn->real_escape_string($_POST['senha']); 
            
            $sql = "SELECT id, usuario FROM login_data WHERE usuario = '$usuario' AND senha = md5('$senha')";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $_SESSION ['login']       = $usuario;
                    $_SESSION ['id']          = $row['id'];
                    unset($_SESSION['nao_autenticado']);
                    unset($_SESSION ['mensagem_header'] ); 
                    unset($_SESSION ['mensagem'] ); 
                    header('location: /app-web-frontend/profile.php'); 
                    exit();
                    
                } else {
                    $_SESSION ['nao_autenticado'] = true;
                    $_SESSION ['mensagem_header'] = "Login";
                    echo '<script type="text/javascript">
                            alert("ERRO: Login ou Senha inválidos.");
                            setTimeout(function(){
                                window.location.href = "/app-web-frontend/login.php";
                            }, 0.1); // Atraso de 1 segundo (1000 milissegundos)
                        </script>';
                    exit();
                }
            }
            else {
                echo "Erro ao acessar o BD: " . mysqli_error($conn);
            }
            $conn->close();
        ?>
      </body>
</html>