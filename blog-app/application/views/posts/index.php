<h3>Welcome to <?php echo $title ?></h3>

<?php foreach($posts as $post): ?>
    <h3><?= $post['title'] ?></h3>
    <div class="row">
        <div class="col-md-3">
            <img class="img-responsive" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?> " alt="<?= $post['post_image']; ?>">
        </div>
        <div class="col-md-9">
            <p><?= word_limiter($post['body'], 50); ?></p>
            <small class="post-date">Posted on: <?= $post['created_at'] ?> in <strong><?= $post['name']; ?></strong></small><br/><br/>
            <p><a class="btn btn-info" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read more</a></p>
        </div>
    </div>
<?php endforeach ?>