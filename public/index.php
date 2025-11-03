<?php
include __DIR__ . '/views/header.php';
require_once('../source/database.php');

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
JOIN albums ON tracks.album_id = albums.id
JOIN artiesten ON albums.artiest_id = artiesten.id
WHERE artiesten.naam = 'Laufey';
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Songs</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <hr class="col-1 my-4">

  <h2>Liedjes van Laufey</h2>

  <div class="d-flex flex-wrap">
      <?php while ($single = $result->fetch_assoc()): ?>
          <?php include __DIR__ . '/views/card.php'; ?>
      <?php endwhile; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
