<?php

    session_start();

// Dados do form
    $login = $_POST['Email'];
    $senha = $_POST['Senha'];
    $_SESSION['teste'] = $login;
    /*var_dump("Nome recebido: ".$nome.
            "Login recebido".$login.
            "Senha recebida".$senha);
    die();*/
// Abrir a conexão
    include("conexao.php");

// Executar
$sql = "SELECT * FROM usuario
        WHERE email = '".$login."'
        AND flg_ativo = 'S'
        AND senha = '".($senha)."';"; 
$result = mysqli_query($conn, $sql);

// Fechar conexão
mysqli_close($conn);
// Validar retorno
if(mysqli_num_rows($result) >0){
    foreach($result as $campo){
        $_SESSION['Senha'] = $campo['senha'];
    }
    header("location: ../painel.php");
    
    //var_dump("Acesso OK");
}else {
    $_SESSION['erro'] = "Login ou senha inválidos."; // Define a mensagem de erro na sessão
    header("location: ../index.php"); // Redireciona de volta para a página de login
    exit;
}
?>
