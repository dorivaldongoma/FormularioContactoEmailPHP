<?php
function limparString($entrada): string {
    return strtolower(trim(htmlspecialchars(stripslashes(strip_tags(filter_var($entrada, FILTER_SANITIZE_STRING))))));}

$nome = ucwords(limparString($_POST['nome']));
$email = limparString($_POST['email']);
$telefone = limparString($_POST['telefone']);
$site = limparString($_POST['site']);
$mensagem = limparString($_POST['mensagem']);
if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($site) && !empty($mensagem)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $receptor = "endereco_de_email_receptor"; //Digite o endereço de e-mail no qual você deseja receber todas as mensagens
        $assunto = "From: $nome <$email>";
        $corpo = "Nome: $nome\nEmail: $email\nContacto Telefónico: $telefone\nSite: $site\n\nMensagem:\n$mensagem\n\nSaudações,\n$nome.";
        $de = "From: $email";
        if(mail($receptor, $assunto, $corpo, $de)){
            echo "Sua mensagem foi enviada.";
        }else{
            echo "Ops, algo deu errado!";
        }
    }else{
        echo "Informe um E-mail válido!";
    }
}else{
    echo "Todos os campos são obrigatórios!";
}