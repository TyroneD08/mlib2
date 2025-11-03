<div class="card m-2" style="width: 200px;">
    <?php if (!empty($single['image'])): ?>
        <div class="card-img">
            <img class="card-img-top" src="<?php echo htmlspecialchars($single['image']); ?>" 
                 alt="<?php echo htmlspecialchars($single['title']); ?>" 
                 style="height:150px;object-fit:cover;">
        </div>
    <?php endif; ?>
    
    <div class="card-header">
        <h4 class="my-0 font-weight-normal"><?php echo htmlspecialchars($single['title']); ?></h4>
    </div>

    <div class="card-body">
        <p>Album: <?php echo htmlspecialchars($single['album']); ?></p>
        <p>Jaar: <?php echo htmlspecialchars($single['jaar']); ?></p>
        <p>Artiest: <?php echo htmlspecialchars($single['artist']); ?></p>
        <p>Genre: <?php echo htmlspecialchars($single['genre']); ?></p>
        <p>Duur: <?php echo htmlspecialchars($single['duur']); ?></p>

        <a href="single.php?single=<?php echo $single['id']; ?>" 
           class="btn btn-sm btn-outline-secondary">
           Bekijk
        </a>
    </div>
</div>
