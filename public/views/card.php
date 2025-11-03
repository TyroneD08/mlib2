<div class="card m-2" style="width: 200px;">
    <?php if (!empty($single['image'])): ?>
    <div class="card-img">
        <img class="card-img-top" src="<?php echo $single['image'] ?>" alt="<?php echo $single['title'] ?>" style="height:150px;object-fit:cover;">
    </div>
    <?php endif; ?>
    <div class="card-header">
        <h4 class="my-0 font-weight-normal"><?php echo $single['title'] ?></h4>
    </div>
    <div class="card-body">
        <p>Album: <?php echo $single['album'] ?></p>
        <p>Jaar: <?php echo $single['jaar'] ?></p>
        <p>Artiest: <?php echo $single['artist'] ?></p>
        <p>Genre: <?php echo $single['genre'] ?></p>
        <p>Duur: <?php echo $single['duur'] ?></p>
        <a href="/single.php?singleid=<?php echo $single['id'] ?>" class="btn btn-sm btn-outline-secondary">Bekijk</a>
    </div>
</div>
