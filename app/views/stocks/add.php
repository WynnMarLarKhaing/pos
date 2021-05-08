<?php require_once APPROOT . "/views/inc/header.php" ?>
<a href="<?php echo URLROOT; ?>/stocks" class="btn btn-light"><i class="fa fa-backward"></i> ရှေ့စာမျက်နှာသို့</a>
<div class="card-body bg-light mt-3">
    <h3>ပစ္စည်းအသစ်ထည့်ရန်</h3>
    </br>
    <form action="<?php echo URLROOT; ?>/stocks/add" method="post">
        <div class="form-group">
            <label for="name">ပစ္စည်းအမည်<sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?></span>
        </div>
        <div class="form-group">
            <label for="name">ပစ္စည်းအမည်(ဇော်ဂျီ)<sup>*</sup></label>
            <input type="text" name="name_zawgyi" class="form-control form-control-lg">
        </div>
        <div class="form-group">
            <label for="stocks_shortcut_id">ပစ္စည်းနံပါတ်<sup>*</sup></label>
            <input type="text" name="stocks_shortcut_id" class="form-control form-control-lg <?php echo (!empty($data['stocks_shortcut_id_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['stocks_shortcut_id']; ?>">
            <span class="invalid-feedback"> <?php echo (!empty($data['stocks_shortcut_id_err'])) ? 'is-invalid' : ''; ?></span>
        </div>
        <div class="form-group">
            <label for="customer_price">အထမ်းစျေး<sup>*</sup></label>
            <input type="text" name="customer_price" class="form-control form-control-lg" value="<?php echo $data['customer_price']; ?>">
        </div>
        <div class="form-group">
            <label for="non_customer_price">ကြားပေါက်စျေး<sup>*</sup></label>
            <input type="text" name="non_customer_price" class="form-control form-control-lg" value="<?php echo $data['non_customer_price']; ?>">
        </div>
        <input type="submit" class="btn btn-success" value="သိမ်းမည်">
    </form>
</div>
<?php require_once APPROOT . "/views/inc/footer.php" ?>