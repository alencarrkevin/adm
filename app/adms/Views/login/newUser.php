<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>

<h1>Novo Usuário</h1>

<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<form method="POST" action="" id="form-new-user">    
    <?php
    $name = "";
    if (isset($valorForm['name'])) {
        $name = $valorForm['name'];
    }
    ?>
    <label>Nome: </label>
    <input type="text" name="name" id="name" required placeholder="Digite o nome completo" value="<?php echo $name; ?>"><br><br>
    
    <?php
    $email = "";
    if (isset($valorForm['email'])) {
        $email = $valorForm['email'];
    }
    ?>
    <label>E-mail: </label>
    <input type="text" name="email" id="email" required placeholder="Digite o seu melhor e-mail" value="<?php echo $email; ?>"><br><br>

    <?php
    $password = "";
    if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
    }
    ?>
    <label>Senha: </label>
    <input type="password" name="password" id="password" required placeholder="Digite a senha"  value="<?php echo 
     $password; ?>"><br><br>

    <button type="submit" name="SendNewUser" value="Cadastrar">Cadastrar</button>
</form>
<p><a href="<?php echo URLADM; ?>">Clique aqui</a> para acessar</p>
