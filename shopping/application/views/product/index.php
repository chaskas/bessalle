
<?php foreach ($products as $product): ?>

        <h3><?php echo $product['name'] ?></h3>
        <div class="main">
                <?php echo $product['id'] ?>
        </div>

<?php endforeach ?>