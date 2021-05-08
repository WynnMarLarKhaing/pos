<?php require_once APPROOT . "/views/inc/header.php" ?>
<a href="<?php echo URLROOT; ?>/customers" class="btn btn-light"><i class="fa fa-backward"></i> ရှေ့စာမျက်နှာသို့</a>
<div class="card-body bg-light mt-3">
    <h3>လူအသစ်ထည့်ရန်</h3>
    </br>
    <form action="<?php echo URLROOT; ?>/customers/add" method="post">
        <div class="form-group">
            <label for="name">အမည်<sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?></span>
        </div>
        <div class="form-group">
            <label for="name">ပစ္စည်းအမည်(ဇော်ဂျီ)<sup>*</sup></label>
            <input type="text" name="name_zawgyi" class="form-control form-control-lg">
        </div>
        <div class="form-group">
            <label for="phone">ဖုန်း<sup>*</sup></label>
            <input type="text" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
            <span class="invalid-feedback"> <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?></span>
        </div>
        <div class="form-group">
            <label for="address">လိပ်စာ<sup>*</sup></label>
            <input type="text" name="address" class="form-control form-control-lg" value="<?php echo $data['address']; ?>">
        </div>
        <input type="submit" class="btn btn-success" value="သိမ်းမည်">
    </form>
</div>
<?php require_once APPROOT . "/views/inc/footer.php" ?>