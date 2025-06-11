<?php
require_once 'index.php';

// Teste básico
$teste = send_email(
    "Teste PHP 8.0 - TecPoint", 
    "<h1>Email funcionando!</h1><p>Teste realizado em " . date('d/m/Y H:i') . "</p>", 
    "contato@tecpoint.net.br"
);

if($teste) {
    echo "✅ Email enviado com sucesso!";
} else {
    echo "❌ Erro ao enviar email";
}
?>
