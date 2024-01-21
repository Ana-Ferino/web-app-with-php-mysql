
<?php
    require 'common/menu.php';
    require 'database/connectDB.php';

    $id = $_SESSION['id'];

    $conn = new mysqli($hostname, $username, $password, $database, $port);
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    $sql = "DELETE FROM login_data WHERE id = $id";

    if ($result = mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">
                    alert("Registro excluído com sucesso!");
                    setTimeout(function(){
                        window.location.href = "/app-web-frontend/register.html";
                    }, 0.1);
                </script>';
        session_start();
        session_destroy();
        exit();
    } else {
        echo "Erro ao executar o DELETE: " . mysqli_error($conn);
    }
    mysqli_close($conn);

?>