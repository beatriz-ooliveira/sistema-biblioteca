<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('config.php');
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE `login` = '$login' AND `senha` = '$senha'";
    $result = $conexao->query($sql);

    if ($result) {
        $user_data = mysqli_fetch_assoc($result);

        if ($user_data) {
            // Usuário encontrado, configure as variáveis de sessão
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            $_SESSION['ativo'] = $user_data['ativo'];
            $_SESSION['nivel_priv'] = $user_data['nivel_priv'];

            if ($_SESSION['ativo'] == '1') {
                // Usuário está ativo, redireciona para a página apropriada com base no nível de privilégio
                if ($_SESSION['nivel_priv'] == '0') {
                    header('Location: indexFuncionario.php');
                    exit();
                } else if ($_SESSION['nivel_priv'] == '1') {
                    header('Location: index.php');
                    exit();
                }
            } else {
                // Usuário não está ativo
                header('Location: login.php');
                exit();
            }
        } else {
            // Usuário não encontrado
            header('Location: login.php');
            exit();
        }
    } else {
        // Erro na consulta
        header('Location: login.php');
        exit();
    }
} else {
    // Não acessa
    header('Location: login.php');
    exit();
}
?>
