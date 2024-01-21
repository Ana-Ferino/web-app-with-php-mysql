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
            $usuario    = $_POST["username"];      
            $senha   = $_POST["password"];     
            $email   = $_POST["email"];     
        ?>

        <?php
            function usuarioOuEmailExistente($usuario, $email) {
                require 'database/connectDB.php';
                $conn = new mysqli($hostname, $username, $password, $database, $port);

                if ($conn->connect_error) {
                    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                }
                
                $sql = "SELECT id FROM login_data WHERE usuario = '$usuario' OR email = '$email'";
               
                $jaExistente = $conn->query($sql)->num_rows > 0;

                $conn->close(); 
                return $jaExistente;
            }

            function gerarUserID() {
                
                $minuto_atual = date("i");
                $segundo_atual = date("s");
                
                $numero_aleatorio = mt_rand(100, 999);
                
                $id = $minuto_atual . $segundo_atual . $numero_aleatorio;
                return $id;        
            }

            function cadastraUsuario($usuario, $senha, $email) {
                require 'database/connectDB.php';
                $conn = new mysqli($hostname, $username, $password, $database, $port);

                $id_usuario = gerarUserID();
                $sql = "INSERT INTO login_data (id, usuario, senha, email)
                        VALUES ('$id_usuario', '$usuario', md5('$senha'), '$email')";
                
                if ($result = $conn->query($sql)) {
                    echo '<script type="text/javascript">
                            alert("Registro cadastrado com sucesso! Você já pode realizar login.");
                            setTimeout(function(){
                                window.location.href = "/app-web-frontend/login.php";
                            }, 0.1); // Atraso de 0.1 milissegundo
                        </script>';
                    $_SESSION ['nao_autenticado'] = true;
                    $_SESSION ['mensagem_header'] = "Cadastro";
                    exit();
                } else {
                    echo '<script type="text/javascript">
                            alert("Erro executando INSERT. Tente novo cadastro.");
                            setTimeout(function(){
                                window.location.href = "/app-web-frontend/register.html";
                            }, 0.1); // Atraso de 1 segundo (1000 milissegundos)
                        </script>';
                    $_SESSION ['nao_autenticado'] = true;
                    $_SESSION ['mensagem_header'] = "Cadastro";
                    exit();
                    }
                
                $conn->close(); 
            }

            $jaExisteCadastro = usuarioOuEmailExistente($usuario, $email);

            if ($jaExisteCadastro == true) {
                echo '<script type="text/javascript">
                            alert("Já existe cadastro com este usuário/email.");
                            setTimeout(function(){
                                window.location.href = "/app-web-frontend/register.html";
                            }, 0.1); // Atraso de 1 segundo (1000 milissegundos)
                        </script>';
                $_SESSION ['nao_autenticado'] = true;
                $_SESSION ['mensagem_header'] = "Cadastro";
            } else {
                cadastraUsuario($usuario, $senha, $email);
            }
        ?>
      </body>
</html>