<?php require_once APPROOT . "/views/inc/header.php" ?>
    
    <div class="container">   
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Stocks</h1>
            </div>
            <div class="col-md-6">
                <a href="<?php echo URLROOT; ?>/stocks/add" class="btn btn-success pull-right">
                    <i class="fa fa-pencil"></i>Add Stock
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="customers">
                <tr>
                    <th>NO</th>
                    <th>NAME</th>
                    <th>CUSTOMER PRICE</th>
                    <th>NO CUSTOMER PRICE</th>
                    <th></th>
                </tr>
                <?php foreach ($data['stocks'] as $key => $post) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                        <td>Germany</td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $post->postId; ?>" class="small-btn btn btn-primary pull-left mr-2">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form class="pull-left" action="<?php echo URLROOT; ?>/customers/delete/<?php echo $post->postId; ?>" method="post">
                                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

<?php require_once APPROOT . "/views/inc/footer.php" ?>