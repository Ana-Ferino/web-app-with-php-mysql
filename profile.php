<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script href="script/script.js"></script>
    <title>Perfil do Usuário</title>
</head>
<body>
    <?php require 'common/menu.php'; ?>
    <?php require 'database/connectDB.php'; ?>

    <?php
        $id = $_SESSION['id'];
        $usuario = $_SESSION['login'];
        $nome = "";
        $idade = "";
        $hobby = "";
        $cargo = "";
        $descricao = "";

        $conn = new mysqli($hostname, $username, $password, $database, $port);
        if ($conn->connect_error) {
            die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
        }

        $sql = "SELECT nome, idade, hobby, cargo, descricao FROM user_data WHERE id = $id";
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $nome = $row['nome'];
                $idade = $row['idade'];
                $hobby = $row['hobby'];
                $cargo = $row['cargo'];
                $descricao = $row['descricao'];
                }
        }
        $conn->close();
    ?>
    <header class="titleTop">
        <a class="headerLink" href="login.php">Home</a>
        <a class="headerLink" href="register.html">Cadastro</a>
    </header>
    <div class="content">
        <div id="profile-container">
            <img id="profile-picture" src="img/pandaicon.jpg" alt="Imagem de Perfil">
            <form action="profile_update.php" method="POST">
                <div class="profile-field">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>">
                </div>

                <div class="profile-field">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>">
                </div>

                <div class="profile-field">
                    <label for="idade">Idade:</label>
                    <input type="number" id="idade" name="idade" value="<?php echo $idade; ?>" min="16" max="100" oninput="limitarTamanhoCampo(this, 3)">
                </div>

                <div class="profile-field">
                    <label for="hobby">Hobby:</label>
                    <input type="text" id="hobby" name="hobby" value="<?php echo $hobby; ?>">
                </div>

                <div class="profile-field">
                    <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo" value="<?php echo $cargo; ?>">
                </div>

                <div class="profile-field">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" style="width: 335px; height: 76px;"><?php echo $descricao; ?></textarea>
                </div>

                <input type="submit" value="Salvar" id="save-button">
				<input type="button" value="Excluir cadastro" id="delete-button" onclick="window.location.href='profile_delete.php'">
                <input type="button" value="Logout" id="logout-button" onclick="window.location.href='logout.php'">
            </form>
        </div>
    </div>
</body>
</html>
