<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="public/css/estilo-login.css"/>
      <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
      <title>Tela de login</title>
   </head>
   <body>
      <div class="main-content">
         <div class="container">
            <div class="header-title">
            <img src="public/img/logo.png" alt="Descrição da imagem" class="logo-image">
               <h1>Login</h1>
               <h4> Ir para o Network Online </h4>
               
               <br/>
            </div> 
            <form action="app/controllers/processar_login.php" method="post" class="form">
               <div class="input-box">
                  <label id="usu_nome" class="label">Nome de usuário:</label> 
                  <input type="text" name="usu_nome" placeholder="Nome de usuário" required>
               </div>
               <div class="input-box" data-validate = "Password is required">
                  <label id="usu_senha" class="label">Senha:</label>
                  <input type="password" name="usu_senha" placeholder="Senha" required>
               </div>
               <br/>
               <button type="submit" class="teams-login-button" value="Login" id="loginButton" name="SendLogin">Entrar</button>
            </form>
         </div>
      </div>  
   </body>
</html>
