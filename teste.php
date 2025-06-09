<?php
// index_simples.php - Teste básico UOL Host
session_start();

echo "<!DOCTYPE html>";
echo "<html><head><title>TecPoint - Teste</title></head><body>";
echo "<h1>Site TecPoint Funcionando!</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Servidor: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</p>";
echo "<p>Data/Hora: " . date('d/m/Y H:i:s') . "</p>";

// Teste de permissões
$upload_dir = __DIR__ . '/static/uploads';
echo "<h2>Teste de Permissões:</h2>";
echo "<p>Pasta uploads existe: " . (is_dir($upload_dir) ? 'SIM' : 'NÃO') . "</p>";
echo "<p>Pasta uploads gravável: " . (is_writable($upload_dir) ? 'SIM' : 'NÃO') . "</p>";

// Teste de criação de arquivo
$test_file = $upload_dir . '/test.txt';
if (file_put_contents($test_file, 'teste')) {
    echo "<p>✅ Criação de arquivo: SUCESSO</p>";
    unlink($test_file);
} else {
    echo "<p>❌ Criação de arquivo: FALHOU</p>";
}

echo "<hr>";
echo "<p><a href='/diagnostico-uolhost.php'>Ver Diagnóstico Completo</a></p>";
echo "<p><a href='/teste.php'>Ver Teste PHP</a></p>";
echo "</body></html>";
?>
