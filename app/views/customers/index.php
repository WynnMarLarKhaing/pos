<?php require_once APPROOT . "/views/inc/header.php" ?>
<?php flash('post_message'); ?>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>အထမ်းများ</h3>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/customers/add" class="btn btn-success pull-right">
                လူအသစ်ထည့်မယ်
            </a>
        </div>
    </div>

    <div class="table table-responsive table-striped table-bordered">
        <table id="customers">
            <tr>
                <th>အမှတ်စဉ်</th>
                <th>အမည်</th>
                <th>ဖုန်း</th>
                <th>လိပ်စာ</th>
                <th></th>
            </tr>
            <?php foreach ($data['customers'] as $key => $post) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $post->name; ?></td>
                    <td><?php echo $post->phone; ?></td>
                    <td><?php echo $post->address; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $post->postId; ?>" class="small-btn btn btn-primary pull-left mr-2">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form class="pull-left" action="<?php echo URLROOT; ?>/customers/delete/<?php echo $post->postId; ?>" method="post">
                            <button type="submit" class="small-btn btn btn-danger mr-2"><i class='fa fa-trash'></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php require_once APPROOT . "/views/inc/footer.php" ?>