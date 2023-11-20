<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $idreserva = $_POST['idReserva'];
        $dataReserva = $_POST['data_reserva'];
        $idPessoa = $_POST['Leitor_Pessoa_idPessoa'];
        $idlivro = $_POST['Livro_idLivro'];
        $data_limite = $_POST['data_limite'];

        $result = mysqli_query($conexao, "INSERT INTO reserva(data_reserva, Leitor_Pessoa_idPessoa, Livro_idLivro, data_limite) 
VALUES ('$dataReserva', '$idPessoa', '$idlivro', '$data_limite')");

        

        header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Reserva</title>
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
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
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
    <a href="index.php">Voltar</a>
    <div class="box">
        <form action="formularioReserva.php" method="POST">
            <fieldset>
                <legend><b>Fórmulário para Reserva</b></legend>
                <br>
                <div class="inputBox">
                    <label for="data_reserva"><b>Data de Reserva:*</b></label>
                    <input type="date" name="data_reserva" id="data_reserva" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="Leitor_Pessoa_idPessoa" id="idPessoa" class="inputUser"  required>
                    <label for="Leitor_Pessoa_idPessoa" class="labelInput">Id da Pessoa*</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="Livro_idLivro" id="Livro_idLivro" class="inputUser"  required>
                    <label for="Livro_idLivro" class="labelInput">Id do Livro*</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="data_limite"><b>Data Limite:*</b></label>
                    <input type="date" name="data_limite" id="data_limite" required>
                </div>
            
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>