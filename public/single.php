<?php
include __DIR__ . '/views/header.php';
require_once('../source/database.php');

if (!isset($_GET['single'])) {
    die('Geen single gevonden');
}

$single_id = (int) $_GET['single'];

$query = "
SELECT
    tracks.id,
    tracks.titel AS title,
    tracks.duur,
    tracks.afbeelding AS image,
    albums.titel AS album,
    albums.jaar,
    albums.genre AS genre,
    artiesten.naam AS artist
FROM tracks
LEFT JOIN albums ON tracks.album_id = albums.id
LEFT JOIN artiesten ON albums.artiest_id = artiesten.id
WHERE tracks.id = ?
";

$stmt = $connection->prepare($query);
$stmt->bind_param('i', $single_id);
$stmt->execute();
$result = $stmt->get_result();
$single = $result->fetch_assoc();
$stmt->close();

if (!$single) {
    die('Geen single gevonden met dit ID');
}
?>

<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($single['title']) ?></title>
  <style>
    body{font-family:Arial, sans-serif;margin:20px;}
    .single-wrap{display:flex;gap:20px;align-items:flex-start;flex-wrap:wrap;}
    .single-img{width:320px;height:320px;overflow:hidden;border-radius:8px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;}
    .single-img img{width:100%;height:100%;object-fit:cover;}
    .meta{max-width:640px;}
    .meta h1{margin:0 0 10px 0;font-size:28px;}
    .meta ul{list-style:none;padding:0;margin:10px 0;}
    .meta li{margin-bottom:6px;}
    .back{display:inline-block;margin-top:12px;padding:8px 12px;border:1px solid #ccc;border-radius:6px;text-decoration:none;color:#333;}
  </style>
</head>
<body>

<div class="single-wrap">
  <div class="single-img">
    <?php if (!empty($single['image'])): ?>
      <img src="<?= htmlspecialchars($single['image']) ?>" alt="<?= htmlspecialchars($single['title']) ?>">
    <?php else: ?>
      <span>Geen cover</span>
    <?php endif; ?>
  </div>

  <div class="meta">
    <h1><?= htmlspecialchars($single['title']) ?></h1>
    <ul>
      <li><strong>Artiest:</strong> <?= htmlspecialchars($single['artist'] ?? 'Onbekend') ?></li>
      <li><strong>Album:</strong> <?= htmlspecialchars($single['album'] ?? '—') ?></li>
      <li><strong>Jaar:</strong> <?= htmlspecialchars($single['jaar'] ?? '—') ?></li>
      <li><strong>Genre:</strong> <?= htmlspecialchars($single['genre'] ?? '—') ?></li>
      <li><strong>Duur:</strong> <?= htmlspecialchars($single['duur'] ?? '—') ?></li>
    </ul>
    <a class="back" href="index.php">Terug naar overzicht</a>
  </div>
</div>

</body>
</html>
