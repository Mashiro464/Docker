<?php
$host = getenv("DB_HOST") ?: "db";
$user = getenv("DB_USER") ?: "pokemonuser";
$pass = getenv("DB_PASSWORD") ?: "pokemonpass";
$db   = getenv("DB_NAME") ?: "pokemon";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error DB: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM pokedex ORDER BY id ASC");
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <title>Pokédex (MySQL)</title>
  <style>
    body{font-family:system-ui;margin:24px}
    table{border-collapse:collapse;width:520px}
    th,td{border:1px solid #ddd;padding:8px}
    th{background:#f3f3f3}
  </style>
</head>
<body>
  <h1>Pokédex (MySQL)</h1>
  <p>Datos cargados desde MySQL en Docker.</p>

  <table>
    <tr><th>ID</th><th>Nombre</th><th>Tipo 1</th><th>Tipo 2</th><th>Gen</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row["id"]) ?></td>
        <td><?= htmlspecialchars($row["name"]) ?></td>
        <td><?= htmlspecialchars($row["type1"]) ?></td>
        <td><?= htmlspecialchars($row["type2"] ?? "") ?></td>
        <td><?= htmlspecialchars($row["generation"]) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
<?php $conn->close(); ?>
