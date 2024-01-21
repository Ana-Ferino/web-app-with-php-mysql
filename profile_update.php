
<?php
    require 'common/menu.php';
    require 'database/connectDB.php';

    $id = $_SESSION['id'];
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $idade = isset($_POST['idade']) ? $_POST['idade'] : '';
    $hobby = isset($_POST['hobby']) ? $_POST['hobby'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

    $conn = new mysqli($hostname, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $checkIdSql = "SELECT id FROM user_data WHERE id = ?";
    $checkIdStmt = $conn->prepare($checkIdSql);
    $checkIdStmt->bind_param("i", $id);
    $checkIdStmt->execute();
    $checkIdStmt->store_result();

    if ($checkIdStmt->num_rows > 0) {
        $updateSql = "UPDATE user_data SET nome = ?, idade = ?, hobby = ?, cargo = ?, descricao = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssssi", $nome, $idade, $hobby, $cargo, $descricao, $id);
        
        if ($updateStmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Registro atualizado com sucesso.");
                    setTimeout(function(){
                        window.location.href = "/app-web-frontend/profile.php";
                    }, 0.1);
                </script>';
        } else {
            echo "Erro ao executar a consulta de atualização: " . $updateStmt->error;
        }
    } else {
        $insertSql = "INSERT INTO user_data (id, nome, idade, hobby, cargo, descricao)
                    VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssssss", $id, $nome, $idade, $hobby, $cargo, $descricao);
        
        if ($insertStmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Nenhum registro foi atualizado. Novo registro adicionado.");
                    setTimeout(function(){
                        window.location.href = "/app-web-frontend/profile.php";
                    }, 0.1);
                </script>';
        } else {
            echo "Erro ao executar a consulta de inserção: " . $insertStmt->error;
        }
    }

    $checkIdStmt->close();
?>