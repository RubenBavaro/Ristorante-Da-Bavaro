<?php
$nome = htmlspecialchars(trim($_POST["nome"] ?? ""));
$piatto = htmlspecialchars(trim($_POST["piatto"] ?? ""));
$allergie = isset($_POST["allergie"]) ? $_POST["allergie"] : [];
$ip_cliente = $_SERVER['REMOTE_ADDR'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ristorante Da Bavaro - Scheda Ordine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-8">
            <div class="card shadow p-4">
                <h1 class="text-center mb-4">🍝 Ristorante Da Bavaro</h1>
                <h2 class="mb-3">La tua scheda ordine</h2>

                <?php if (!empty($nome)): ?>
                    <p>Ciao <b><?= $nome ?></b>, benvenuto da Bavaro! 🍷</p>
                <?php else: ?>
                    <p>Ciao ospite speciale, benvenuto da Bavaro! 🍷</p>
                <?php endif; ?>

                <?php if (!empty($piatto)): ?>
                    <p>Hai scelto di assaggiare: <b><?= $piatto ?></b>. Ottima scelta!</p>
                <?php else: ?>
                    <p>Non hai scelto un piatto… nessun problema, il nostro chef ti sorprenderà! 👨‍🍳</p>
                <?php endif; ?>

                <?php if (!empty($allergie)): ?>
                    <p>Abbiamo segnato le tue allergie, cucineremo con la massima attenzione:</p>
                    <ul class="list-group mb-3">
                        <?php foreach ($allergie as $a): ?>
                            <li class="list-group-item list-group-item-warning"><?= htmlspecialchars($a) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="alert alert-success">Nessuna allergia segnalata. Il nostro menù è tutto a tua disposizione! ✅</p>
                <?php endif; ?>

                <p class="text-muted"><i>Curiosità dalla nostra cucina digitale:</i> la tua richiesta arriva dall’indirizzo <b><?= $ip_cliente ?></b>.</p>
            </div>
        </div>
    </div>
</body>
</html>
