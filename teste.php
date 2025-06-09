<?php
// teste.php
header('Content-Type: text/plain');

echo "=== TESTE UOL HOST WINDOWS ===\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";
echo "Timestamp: " . date('Y-m-d H:i:s') . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Path: " . __FILE__ . "\n";

// Teste de escrita
if(is_writable('.')) {
    echo "Permissao de escrita: ✅ OK\n";
    
    // Teste de criação de arquivo
    if(file_put_contents('test_write.txt', 'teste')) {
        echo "Criacao de arquivo: ✅ OK\n";
        unlink('test_write.txt'); // Remove arquivo de teste
    } else {
        echo "Criacao de arquivo: ❌ ERRO\n";
    }
} else {
    echo "Permissao de escrita: ❌ ERRO\n";
}

// Teste de funções necessárias
echo "Funcao file_get_contents: " . (function_exists('file_get_contents') ? '✅' : '❌') . "\n";
echo "Funcao json_decode: " . (function_exists('json_decode') ? '✅' : '❌') . "\n";
echo "Funcao exec: " . (function_exists('exec') ? '✅' : '❌') . "\n";
echo "Funcao shell_exec: " . (function_exists('shell_exec') ? '✅' : '❌') . "\n";

echo "\n=== TESTE CONCLUÍDO ===\n";
?>
