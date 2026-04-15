<?php
/**
 * api_progresso.php — API de Progresso de Apostilas
 * GET  → retorna apostilas concluídas pelo usuário logado
 * POST → salva apostila como concluída (INSERT IGNORE)
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autenticação: usuário precisa estar logado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Não autenticado.']);
    exit;
}

$usuario_id = (int) $_SESSION['usuario_id'];

require_once __DIR__ . '/../config/conexao.php';

/* ─────────────────────────────────────────
   GET — retorna lista de apostila_id concluídas
───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare(
        "SELECT apostila_id FROM progresso_apostilas WHERE usuario_id = ?"
    );
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $concluidas = [];
    while ($row = $result->fetch_assoc()) {
        $concluidas[] = $row['apostila_id'];
    }
    $stmt->close();

    echo json_encode(['sucesso' => true, 'concluidas' => $concluidas]);
    exit;
}

/* ─────────────────────────────────────────
   POST — marca OU desmarca apostila
   acao=marcar   → INSERT IGNORE
   acao=desmarcar → DELETE
───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apostila_id = trim($_POST['apostila_id'] ?? '');
    $acao        = trim($_POST['acao']        ?? 'marcar');

    if (empty($apostila_id) || strlen($apostila_id) > 120) {
        http_response_code(400);
        echo json_encode(['sucesso' => false, 'mensagem' => 'apostila_id inválido.']);
        exit;
    }

    // Sanitiza: mantém apenas letras minúsculas, números, hífens e underscores
    $apostila_id = preg_replace('/[^a-z0-9_\-]/', '', strtolower($apostila_id));

    if ($acao === 'desmarcar') {
        // ── DESMARCAR ──
        $stmt = $conn->prepare(
            "DELETE FROM progresso_apostilas WHERE usuario_id = ? AND apostila_id = ?"
        );
        $stmt->bind_param('is', $usuario_id, $apostila_id);

        if ($stmt->execute()) {
            $stmt->close();
            echo json_encode(['sucesso' => true, 'acao' => 'desmarcar', 'apostila_id' => $apostila_id]);
        } else {
            $stmt->close();
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao remover progresso.']);
        }
    } else {
        // ── MARCAR (padrão) ──
        $stmt = $conn->prepare(
            "INSERT IGNORE INTO progresso_apostilas (usuario_id, apostila_id) VALUES (?, ?)"
        );
        $stmt->bind_param('is', $usuario_id, $apostila_id);

        if ($stmt->execute()) {
            $stmt->close();
            echo json_encode(['sucesso' => true, 'acao' => 'marcar', 'apostila_id' => $apostila_id]);
        } else {
            $stmt->close();
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao salvar progresso.']);
        }
    }
    exit;
}

/* ─────────────────────────────────────────
   Método não suportado
───────────────────────────────────────── */
http_response_code(405);
echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido.']);
