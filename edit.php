<?php
    include_once('config.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuario WHERE idUsuario=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $idusuario = $user_data['idUsuario'];
                $login = $user_data['login'];
                $senha = $user_data['senha'];
                $idFunc = $user_data['Funcionario_Pessoa_idPessoa'];
                $idPessoa = $user_data['Leitor_Pessoa_idPessoa'];
                $nivel_priv = $user_data['nivel_priv'];
                $ativo = $user_data['ativo']; 
            }
        }
        else
        {
            header('Location: sistema.php');
        }
    }
    else
    {
        header('Location: sistema.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>
<body>
    <a href="sistema.php">Voltar</a>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Usuarios</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="login" id="login" class="inputUser" value=<?php echo $login;?> required>
                    <label for="login" class="labelInput">login</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="senha" id="senha" class="inputUser" value=<?php echo $senha;?> required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="Funcionario_Pessoa_idPessoa" id="idfunc" class="inputUser" value=<?php echo $idFunc;?> required>
                    <label for="idfunc" class="labelInput">Id do Funcionario</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="idPessoa" id="idPessoa" class="inputUser" value=<?php echo $idPessoa;?> required>
                    <label for="idPessoa" class="labelInput">Id da Pessoa</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="nivel_priv" id="nivel_priv" class="inputUser" value=<?php echo $nivel_priv;?> required>
                    <label for="nivel_priv" class="labelInput">Nivel de Privilegio</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="ativo" id="ativo" class="inputUser" value=<?php echo $ativo;?> required>
                    <label for="ativo" class="labelInput">Ativo ou não</label>
                </div>
            
                <br><br>
				<input type="hidden" name="idUsuario" value=<?php echo $idusuario;?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>