<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
		
		<meta charset="UTF-8">
        <title>PHP</title>

        <!-- CSS -->
        <?php include('partes/css.php'); ?>
        <!-- Fim CSS -->

    </head>

    <body>
        <div class="tela-login"> 
            <h2 class="titulo-login">Seja Bem-vindo(a)</h2>
        
            <form method="POST" action="php/validaLogin.php">
            
                <p>
                    <input type="email" id="iEmail" placeholder="E-mail" name="Email" required>
                </p>

                <p>
                    <input type="password" id="iSenha" placeholder="Senha" name="Senha" required>
                </p>

                <button class="botao-logar" type="submit">Logar</button>
                <a href="esqueci-senha.php" style="color:rgb(255, 255, 255);">
                    Esqueci minha senha
                </a>



            </form>

        </div>

        <div class="imagem"></div>

    </body>

</html>