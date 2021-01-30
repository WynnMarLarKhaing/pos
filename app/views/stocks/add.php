<?php require_once APPROOT . "/views/inc/header.php" ?>
<a href="<?php echo URLROOT; ?>/customers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card-body bg-light mt-3">
    <h2>Add Stock</h2>
    <p>Create a stock with this form</p>
    <form action="<?php echo URLROOT; ?>/stocks/add" method="post">
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>
<?php require_once APPROOT . "/views/inc/footer.php" ?>