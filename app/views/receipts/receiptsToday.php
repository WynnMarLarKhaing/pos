<?php require_once APPROOT . "/views/inc/header.php" ?>
    <div class="container">   
        <div class="row mb-3">
            <div class="col-md-6 d-none">
                <h3>ယနေ့ဘောင်ချာစာရင်းများ</h3>
            </div>
            <div class="col-md-12">
                <div class="alert alert-dark" role="alert">
                ယနေ့ဘောင်ချာစုစုပေါင်း = <?php echo count($data['receipts']); ?>
                </div>
            </div>
            <div class="col-md-12">
                <a href="<?php echo URLROOT; ?>/receipts/add" class="btn btn-success pull-right">
                    <i class="fa fa-pencil"></i>ဘောင်ချာအသစ်ထည့်မယ်
                </a>
            </div>
        </div>

        <table id="receipts" class="table table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th width="10%">အမှတ်စဉ်</th>
                    <th width="15%">ဘောင်ချာနံပါတ်</th>
                    <th width="20%">ရောင်းသူအမည်</th>
                    <th width="15%">နေ့စွဲ</th>
                    <th width="15%"></th>
                    <th width="25%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['receipts'] as $key => $receipt) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $receipt->receipt_id; ?></td>
                        <td><?php echo $receipt->customer_name; ?></td>
                        <td><?php echo date_format(date_create($receipt->order_date),"Y-m-d H:i"); ?></td>
                        <td><span class="text-danger"><?php echo $receipt->save_type == 1 ? 'ဘောင်ချာဖွင့်နေဆဲ' : ''; ?></span></td>
                        <td>
                            <?php if($receipt->save_type != 1): ?>
                                <a href="<?php echo URLROOT; ?>/receipts/edit/<?php echo $receipt->receipt_id; ?>" class="small-btn btn btn-success pull-left mr-2">
                                    ကြည့်မယ်
                                </a>
                            <?php else: ?>
                                <a href="<?php echo URLROOT; ?>/receipts/edit/<?php echo $receipt->receipt_id; ?>" class="small-btn btn btn-primary pull-left mr-2">
                                    ပြင်မယ်
                                </a>
                            <?php endif; ?>
                            <form class="pull-left" action="<?php echo URLROOT; ?>/receipts/delete/<?php echo $receipt->id; ?>" method="post">
                                <button type="submit" class="btn btn-danger mr-2 d-none">ဖျက်မည်</button>
                            </form>
                            <a href="<?php echo URLROOT; ?>/receipts/download/<?php echo $receipt->receipt_id; ?>" class="small-btn btn btn-info pull-left mr-2">
                                <i class="fa fa-cloud-download"></i>
                            </a>
                            <a href="<?php echo URLROOT; ?>/receipts/print/<?php echo $receipt->receipt_id; ?>" class="small-btn btn btn-secondary pull-left mr-2">
                                <i class="fa fa-print"></i>
                            </a>
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

	$("#receipts").DataTable({
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    });
});
</script>