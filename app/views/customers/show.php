<?php require_once APPROOT . "/views/inc/header.php" ?>
<a href="<?php echo URLROOT; ?>/customers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<h1><?php echo $data['post']->name; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->phone; ?> </p>

<?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark pull-left mr-3">Edit</a>

    <form class="pull-left" action="<?php echo URLROOT; ?>/customers/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif; ?>

<?php require_once APPROOT . "/views/inc/footer.php" ?>