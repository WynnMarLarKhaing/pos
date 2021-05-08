<?php require_once APPROOT . "/views/inc/header.php" ?>
    <div class="container">   
        <div class="row mb-3">
            <div class="col-md-6">
                <h3>ပစ္စည်းများ</h3>
            </div>
            <div class="col-md-6">
                <a href="<?php echo URLROOT; ?>/stocks/add" class="btn btn-success pull-right">
                ပစ္စည်းအသစ်ထည့်မယ်
                </a>
            </div>
        </div>

        <table id="stocks" class="table table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th width="10%">အမှတ်စဉ်</th>
                    <th width="30%">ပစ္စည်းအမည်</th>
                    <th width="20%">ပစ္စည်းနံပါတ်</th>
                    <th width="20%">အထမ်းစျေး</th>
                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['stocks'] as $key => $post) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $post->name; ?></td>
                        <td><?php echo $post->stocks_shortcut_id; ?></td>
                        <td><?php echo $post->customer_price; ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/stocks/edit/<?php echo $post->id; ?>" class="small-btn btn btn-primary pull-left mr-2">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form class="pull-left" action="<?php echo URLROOT; ?>/stocks/delete/<?php echo $post->id; ?>" method="post">
                                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

<?php require_once APPROOT . "/views/inc/footer.php" ?>

<script>
$(document).ready(function (){
	// $.extend( $.fn.dataTable.defaults, {
	// 	language: { url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json" }
	// });

	$("#foo-table").DataTable();
	$("#stocks").DataTable();
});
</script>