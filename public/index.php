<?php

declare(strict_types=1);

// Listado provisional para enseñárselo a negocio. Lee la respuesta guardada directamente.
$tareas = json_decode(file_get_contents(__DIR__ . '/../fixtures/ruteo-tasks.json'), true);

usort($tareas, fn ($a, $b) => strcmp($b['updated'], $a['updated']));

$estado = $_GET['estado'] ?? null;
?>
<html>
<head>
<title>tareas</title>
<style>
body { font-family: "Times New Roman", serif; text-align: center; }
table { width: 1400px; border: 3px solid black; margin: auto; }
td { padding: 1px; border: 1px solid #999; font-size: 11px; }
th { background: yellow; }
.DONE { color: green; }
.IN_PROGRESS { color: orange; }
</style>
</head>
<body>
<h1>TAREAS RUTEO</h1>
<p><?= count($tareas) ?> tareas</p>
<p>Filtrar: <a href="?estado=PENDING">Pendientes</a> | <a href="?estado=IN_PROGRESS">En curso</a> | <a href="?estado=DONE">Hechas</a></p>
<table>
<tr><th>ID</th><th>Estado</th><th>Tipo</th><th>Técnico</th><th>Fecha</th></tr>
<?php foreach ($tareas as $t): ?>
<tr>
<td><?= $t['task_id'] ?></td>
<td class="<?= $t['state'] ?>"><?= $t['state'] ?></td>
<td><?= $t['action_type'] ?></td>
<td><?= $t['station']['name'] ?></td>
<td><?= $t['user']['full_name'] ?></td>
<td><?= $t['truck'] ?></td>
<td><?= $t['updated'] ?></td>
</tr>
<?php endforeach ?>
</table>
</body>
</html>
