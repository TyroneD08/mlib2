<?php
include __DIR__ . '/views/header.php';
require_once('../source/database.php');

$query = "
SELECT 
    tracks.titel AS track_titel,
    tracks.duur,
    tracks.afbeelding,
    albums.titel AS album_titel,
    albums.jaar,
    artiesten.naam AS artiest_naam
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
       <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>



  <hr class="col-1 my-4">

  <h2>Liedjes van Laufey</h2>
  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>Cover</th>
        <th>Titel</th>
        <th>Duur</th>
        <th>Album</th>
        <th>Jaar</th>
        <th>Artiest</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td>
            <?php if (!empty($row['afbeelding'])): ?>
              <img src="<?= htmlspecialchars($row['afbeelding']) ?>" 
                   alt="Cover" style="width:50px; height:50px; object-fit:cover; border-radius:5px;">
            <?php else: ?>
              <span>No cover</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['track_titel']) ?></td>
          <td><?= htmlspecialchars($row['duur']) ?></td>
          <td><?= htmlspecialchars($row['album_titel']) ?></td>
          <td><?= htmlspecialchars($row['jaar']) ?></td>
          <td><?= htmlspecialchars($row['artiest_naam']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

