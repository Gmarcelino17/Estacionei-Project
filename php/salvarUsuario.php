<?php
include('funcoes.php');

$empresa     = $_POST["nEmpresa"];
$nome        = $_POST["nNome"];
$login       = $_POST["nLogin"];
$senha       = $_POST["nSenha"];
$tipoUsuario = $_POST["nTipoUsuario"]; 
$funcao      = $_GET["funcao"];
$idUsuario   = $_GET["codigo"];

$ativo = (isset($_POST["nAtivo"]) && $_POST["nAtivo"] == "on") ? "S" : "N";

include("conexao.php");

// Verifica se é Inclusão
if($funcao == "I"){

    $idUsuario = proxid_usuario(); // <- Corrigido nome da função

    $sql = "INSERT INTO usuario (id_usuario, id_empresa, nome, email, senha, flg_ativo, idTipoUsuario) "
         . "VALUES ($idUsuario, $empresa, '$nome', '$login', md5('$senha'), '$ativo', $tipoUsuario);";

} elseif($funcao == "A"){

    // Monta parte da senha condicionalmente
    $setSenha = ($senha != '') ? "senha = md5('$senha'), " : '';

    $sql = "UPDATE usuario SET "
         . "idTipoUsuario = $tipoUsuario, "
         . "nome = '$nome', "
         . "email = '$login', "
         . $setSenha
         . "flg_ativo = '$ativo' "
         . "WHERE id_usuario = $idUsuario;";

} elseif($funcao == "D"){

    $sql = "DELETE FROM usuario WHERE id_usuario = $idUsuario;";
}

$result = mysqli_query($conn, $sql);
mysqli_close($conn);

// Upload de imagem
if($_FILES['Foto']['tmp_name'] != ""){

    $extensao = pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
    $novoNome = md5($_FILES['Foto']['name']).'.'.$extensao;

    $diretorio = '../dist/img/';
    if(!is_dir($diretorio)){
        mkdir($diretorio, 0755, true);
    }

    move_uploaded_file($_FILES['Foto']['tmp_name'], $diretorio.$novoNome);

    $dirImagem = 'dist/img/'.$novoNome;

    include("conexao.php");
    $sql = "UPDATE usuario SET foto = '$dirImagem' WHERE id_usuario = $idUsuario;";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
}

header("location: ../usuarios.php");
?>