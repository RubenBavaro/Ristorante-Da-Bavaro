<?php
$ricette = [
    [
        "nome" => "Spaghetti alle vongole",
        "img" => "https://www.giallozafferano.it/images/242-24236/Spaghetti-alle-vongole_450x300_sp.jpg",
        "allergeni" => ["Crostacei", "Glutine"]
    ],
    [
        "nome" => "Risotto ai funghi",
        "img" => "https://www.giallozafferano.it/images/170-17085/Risotto-ai-funghi_450x300.jpg",
        "allergeni" => []
    ],
    [
        "nome" => "Pizza Margherita",
        "img" => "https://www.giallozafferano.it/images/238-23809/Pizza-Margherita_450x300_sp.jpg",
        "allergeni" => ["Glutine", "Lattosio"]
    ],
    [
        "nome" => "Tagliata di manzo",
        "img" => "https://www.giallozafferano.it/images/215-21544/Tagliata-di-manzo-con-rucola-e-pomodorini_450x300.jpg",
        "allergeni" => []
    ],
    [
        "nome" => "Tiramisù",
        "img" => "https://www.giallozafferano.it/images/237-23742/Tiramisu_450x300.jpg",
        "allergeni" => ["Uova", "Lattosio"]
    ],
    [
        "nome" => "Pancake",
        "img" => "https://media-assets.lacucinaitaliana.it/photos/620fbf1088f5a214a3ad3dda/1:1/w_1600,c_limit/empty",
        "allergeni" => ["Uova", "Lattosio", "Glutine"]
    ]
];

$nome = htmlspecialchars(trim($_POST["nome"] ?? ""));
$piatto = htmlspecialchars(trim($_POST["piatto"] ?? ""));
$allergie = $_POST["allergie"] ?? [];
$ip_cliente = $_SERVER["REMOTE_ADDR"];

$ricetta_scelta = null;
foreach ($ricette as $r) {
    if ($r["nome"] === $piatto) {
        $ricetta_scelta = $r;
        break;
    }
}

$conflitti = [];
if ($ricetta_scelta) {
    foreach ($allergie as $a) {
        if (in_array($a, $ricetta_scelta["allergeni"])) {
            $conflitti[] = $a;
        }
    }
}
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

                <?php if (!empty($piatto) && $ricetta_scelta): ?>
                    <p>Hai scelto di assaggiare: <b><?= $ricetta_scelta["nome"] ?></b>. Ottima scelta!</p>
                    <img src="<?= $ricetta_scelta["img"] ?>" class="img-fluid rounded mb-3 shadow-sm" alt="<?= $ricetta_scelta["nome"] ?>">
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

                <?php if (!empty($conflitti)): ?>
                    <div class="alert alert-danger">
                        ⚠️ Attenzione! Il piatto scelto contiene ingredienti che potrebbero causarti problemi:
                        <ul>
                            <?php foreach ($conflitti as $c): ?>
                                <li><?= htmlspecialchars($c) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        Ti consigliamo di scegliere un piatto alternativo.
                    </div>
                <?php endif; ?>

                <p class="text-muted"><i>Curiosità dalla nostra cucina digitale:</i> la tua richiesta arriva dall’indirizzo <b><?= $ip_cliente ?></b>.</p>
            </div>
        </div>
    </div>
</body>
</html>
