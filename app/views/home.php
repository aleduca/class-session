<?php partials('header.php'); ?>
<h2>Upload new Image</h2>

<?php if($user->image): ?>
  <div class="card card-user" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title"><?php echo $user->firstName; ?> <?php echo $user->lastName; ?></h5>
      <h6 class="card-subtitle mb-2 text-body-secondary">
      <img src="<?php echo $user->image; ?>" class="img-thumbnail" alt="avatar">
      </h6>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
  </div>
<?php endif ?>

<form action="/upload" method="post" enctype="multipart/form-data">
  <input type="file" name="file">
  <button type="submit">Upload</button>
</form>
<?php partials('footer.php'); ?>