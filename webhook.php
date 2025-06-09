<?php
// webhook.php - Compatível com PHP 5.6 UOL Host
header('Content-Type: application/json');

// Configurações básicas
$logFile = 'webhook.log';
$repoPath = dirname(__FILE__); // Pasta atual

// Função de log
function writeLog($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND | LOCK_EX);
}

// Inicia o log
writeLog("Webhook iniciado");

try {
    // Método de requisição
    $method = $_SERVER['REQUEST_METHOD'];
    writeLog("Método: $method");
    
    if ($method === 'POST') {
        // Recebe dados
        $input = file_get_contents('php://input');
        writeLog("Dados recebidos: " . strlen($input) . " bytes");
        
        // Decodifica JSON
        $data = json_decode($input, true);
        
        if ($data && isset($data['ref'])) {
            $branch = $data['ref'];
            writeLog("Branch: $branch");
            
            // Verifica se é a branch principal
            if ($branch === 'refs/heads/main' || $branch === 'refs/heads/master') {
                writeLog("Deploy iniciado para branch principal");
                
                // Comando git pull (básico)
                $output = array();
                $return_var = 0;
                
                // Muda para diretório do projeto
                chdir($repoPath);
                
                // Executa git pull
                exec('git pull 2>&1', $output, $return_var);
                
                writeLog("Git pull resultado: " . implode(' | ', $output));
                
                $response = array(
                    'status' => 'success',
                    'message' => 'Deploy executado',
                    'output' => $output,
                    'return_code' => $return_var
                );
            } else {
                $response = array(
                    'status' => 'ignored',
                    'message' => 'Branch ignorada'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Dados inválidos'
            );
        }
    } else {
        // GET request - status
        $response = array(
            'status' => 'ready',
            'message' => 'Webhook ativo',
            'php_version' => phpversion(),
            'timestamp' => date('Y-m-d H:i:s')
        );
    }
    
    writeLog("Resposta: " . json_encode($response));
    echo json_encode($response);
    
} catch (Exception $e) {
    writeLog("ERRO: " . $e->getMessage());
    
    $error_response = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
    
    echo json_encode($error_response);
}

// Resposta HTTP 200
http_response_code(200);
writeLog("Webhook finalizado");
?>
