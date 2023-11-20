<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');// conexão com o banco de dados está aqui
    if(isset($_POST['update']))
    {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $idFunc = $_POST['Funcionario_Pessoa_idPessoa'];
        $idPessoa = $_POST['Leitor_Pessoa_idPessoa'];
        $nivel_priv = $_POST['nivel_priv'];
        $ativo = $_POST['ativo'];
        $idusuario = $_POST['idUsuario'];

        $sqlInsert = "UPDATE usuario
        SET login='$login',senha='$senha',Funcionario_Pessoa_idPessoa='$idFunc',Leitor_Pessoa_idPessoa='$idPessoa',nivel_priv='$nivel_priv',ativo='$ativo'
        WHERE idUsuario='$idusuario'";

        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: sistema.php');

?>