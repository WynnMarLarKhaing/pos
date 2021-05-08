<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/customers">အထမ်းများ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/stocks">ပစ္စည်းစာရင်းများ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/receipts/receiptsToday">ယနေ့အရောင်း</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/receipts">အရောင်းစာရင်းများ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/receipts/add">ဘောင်ချာအသစ်ထည့်မယ်</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href=""> ကြိုဆိုပါတယ် <?php echo $_SESSION['user_name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">ထွက်မည်</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">မှတ်ပုံတင်မည်</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">ဝင်မည်</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>