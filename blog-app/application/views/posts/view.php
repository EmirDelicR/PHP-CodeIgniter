<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?= $post['created_at'] ?></small>
<img class="img-responsive" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?> " alt="<?= $post['post_image']; ?>">
   
<div class="post-body">
    <?php echo $post['body']; ?>
</div>

<?php if($this->session->userdata('user_id') == $post['user_id']): ?>
    <hr>
    <a class="btn btn-default pull-left" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
    <?php echo form_open('posts/delete/'.$post['id']); ?>
        <input type="submit" name="" value="Delete" class="btn btn-danger">
    </form>
<?php endif; ?>

<hr>
<h3>Comments</h3>
<?php if($comments): ?>
    <?php foreach($comments as $comment): ?>
        <div class="well">
            <h5><?= $comment['body'] ?> [by <strong><?= $comment['username'] ?></strong>]</h5>
        </div>
    <?php endforeach ?>
<?php else : ?>
    <p>No comments to display</p>
<?php endif; ?>

<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$post['id']); ?>
    <div class="form-group">    
        <label>Name</label>
        <input type="text" name="name" class="form-controle">
    </div>
     <div class="form-group">    
        <label>Email</label>
        <input type="email" name="email" class="form-controle">
    </div>
     <div class="form-group">    
        <label>Body</label>
        <textarea rows="3" cols="4"  name="body" class="form-controle"> </textarea>
    </div>
    <input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>