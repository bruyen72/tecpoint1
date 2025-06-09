<?php
// teste.php - Versão mínima para PHP 5.6
header('Content-Type: text/plain');

echo "Site funcionando!\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Timestamp: " . date('Y-m-d H:i:s') . "\n";

// Teste de escrita
if(is_writable('.')) {
    echo "Permissao de escrita: OK\n";
} else {
    echo "Permissao de escrita: ERRO\n";
}
?>
