<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/create'); ?>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea rows="4" cols="4" id="editor1" class="form-control" name="body" placeholder="Add Body" ></textarea>
  </div>
  <div class="form-group">
    <label>Category</label>
    <select class="form-control" name="category_id" >
      <?php foreach($categories as $category) : ?>
        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  
  
  <div class="form-group">
    <label for="exampleInputFile">Upload image</label>
    <input type="file" class="form-control-file" id="exampleInputFile"  name="userfile" size="20">
  </div>
  
  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>