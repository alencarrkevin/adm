<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

//Criptografar a senha
//echo password_hash("123456a", PASSWORD_DEFAULT);
?>

<h1>Área Restrita</h1>

<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<form method="POST" action="" id="form-login">
    <?php
    $user = "";
    if (isset($valorForm['user'])) {
        $user = $valorForm['user'];
    }
    ?>
    <label>Usuário: </label>
    <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user; ?>"><br><br>

    <?php
    $password = "";
    if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
    }
    ?>
    <label>Senha: </label>
    <input type="password" name="password" id="password" placeholder="Digite a senha" value="<?php echo $password; ?>"><br><br>

    <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
</form>
<p><a href="<?php echo URLADM; ?>new-user/index">Cadastrar</a></p>

Usuário: kevinalencar2019@gmail.com<br>
Senha: 123456a