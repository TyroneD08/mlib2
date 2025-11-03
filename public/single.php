<?php
include __DIR__ . '/views/header.php';
require_once('../source/database.php');

$single_id = isset($_GET['singleid']) ? (int)$_GET['singleid'] : 1;

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
if (! $stmt) {
    die('Prepare failed: ' . $connection->error);
}
$stmt->bind_param('i', $single_id);
$stmt->execute();
$result = $stmt->get_result();

$single = $result->fetch_assoc();

$stmt->close();

if (! $single) {
    http_response_code(404);
    ?>
    <!doctype html>
    <html lang="nl">
    <head>
      <meta charset="utf-8">
      <title>Single niet gevonden</title>
      <style>body{font-family:Arial, sans-serif;padding:20px;}</style>
    </head>
    <body>
      <h1>404 — Single niet gevonden</h1>
      <p>Er is geen single met ID <?= htmlspecialchars($single_id) ?>.</p>
      <p><a href="index.php">Terug naar overzicht</a></p>
    </body>
    </html>
    <?php
    exit;
}
?>
<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($single['title']); ?></title>
  <style>
    body{font-family:Arial, sans-serif;margin:20px;}
    .single-wrap{display:flex;gap:20px;align-items:flex-start;}
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
      <img src="<?php echo htmlspecialchars($single['image']); ?>" alt="<?php echo htmlspecialchars($single['title']); ?>">
    <?php else: ?>
      <span>Geen cover</span>
    <?php endif; ?>
  </div>

  <div class="meta">
    <h1><?php echo htmlspecialchars($single['title']); ?></h1>
    <ul>
      <li><strong>Artiest:</strong> <?php echo htmlspecialchars($single['artist'] ?? 'Onbekend'); ?></li>
      <li><strong>Album:</strong> <?php echo htmlspecialchars($single['album'] ?? '—'); ?></li>
      <li><strong>Jaar:</strong> <?php echo htmlspecialchars($single['jaar'] ?? '—'); ?></li>
      <li><strong>Genre:</strong> <?php echo htmlspecialchars($single['genre'] ?? '—'); ?></li>
      <li><strong>Duur:</strong> <?php echo htmlspecialchars($single['duur'] ?? '—'); ?></li>
    </ul>
    <a class="back" href="index.php">Terug naar overzicht</a>
  </div>
</div>

</body>
</html>
