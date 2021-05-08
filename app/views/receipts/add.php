<?php require_once APPROOT . "/views/inc/header.php" ?>
<<<<<<< HEAD
<a href="<?php echo URLROOT; ?>/receipts" class="btn btn-light"><i class="fa fa-backward"></i> ရှေ့စာမျက်နှာသို့</a>
=======
<a href="<?php echo URLROOT; ?>/receipts/receiptsToday" class="btn btn-light"><i class="fa fa-backward"></i> ရှေ့စာမျက်နှာသို့</a>
>>>>>>> 8b8454f9586b540e6939013394b3b85c8f97f5ea
<div class="card-body bg-light mt-3">
    <h4>ပစ္စည်းနံပါတ်များ</h4>
    </br>
    <div class="container">
        <div class="row">
            <?php foreach ($data['stocks'] as $key => $stock) : ?>
                <h5 class="ml-3"><span class="badge badge-warning" id='<?php echo $stock->stocks_shortcut_id;?>' data-name='<?php echo $stock->name;?>' data-customer_price='<?php echo $stock->customer_price;?>' data-non_customer_price='<?php echo $stock->non_customer_price;?>'><?php echo $stock->name . " = " . $stock->stocks_shortcut_id; ?></span></h5>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<form action="<?php echo URLROOT; ?>/receipts/add" method="post">
    <div class="mt-2 col-4">
        <select class="form-control form-select" aria-label="Default select example" name="customer_id" id="customer_id">
            <option selected value="0">အထမ်းရွေးရန်</option>
            <?php foreach ($data['customers'] as $key => $customer) : ?>
                <option value="<?php echo $customer->id;?>"><?php echo $customer->name;?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <table class="table table-bordered" id="invoiceTable">
                <thead>
                <tr style="background: cornsilk;">
                    <th scope="col">#</th>
                    <th scope="col"></th>
                    <th scope="col">အမျိုးအမည်</th>
                    <th scope="col">အရေအတွက်</th>
                    <th scope="col">နှုန်း</th>
                    <th scope="col">စုစုပေါင်း</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><input type="text" class="form-control stocks_shortcut_id" name="stock_id[]" /></td>
                        <td><span id="name1"></span></td>
                        <td><input type="text" class="form-control qty d-none" id="qty1" name="qty[]"/></td>
                        <td><span id="price1"></span></td>
                        <td><span id="total1" class="total"></span></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="margin-top:-17px;">
                <tbody>
                    <tr>
                        <td>စုစုပေါင်း</td>
                        <td><span id="allSum">0</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class= "text-right">
        <input type="submit" class="btn btn-danger" value="ခဏသိမ်းမည်" name="temp_save">
        <input type="submit" class="btn btn-success" value="သိမ်းမည်" name="save">
    </div>
</form>

<?php require_once APPROOT . "/views/inc/footer.php" ?>
<script>
    $(document).ready(function(){
        var ids;
        var customer_id;
        $(document).on("focus",".stocks_shortcut_id",function(e){
            ids = $(this).closest('tr').index() + 2;
            var td = '<tr><th scope="row">' + ids + '</th><td><input type="text" class="form-control stocks_shortcut_id" name="stock_id[]" /></td><td><span id="name' + ids + '"></span></td><td><input type="text" class="form-control qty d-none" id="qty' + ids + '" name="qty[]"/></td><td><span id="price' + ids + '"></span></td><td><span id="total' + ids + '" class="total"></span></td></tr>';
            if($(this).parent().parent().is(':last-child')){
                $('#invoiceTable tr:last').after(td);
            }
        });

        $(document).on("input",".stocks_shortcut_id",function(e){
            customer_id = $("#customer_id").val();
            if(customer_id >= 1){
                var id = $(this).val();
                var name = $("#" + id).data("name");
                var customer_price = $("#" + id).data("customer_price");
                var index = $(this).closest('tr').index() + 1;
                if(name != undefined){
                    $("#name" + index).text(name);
                    $("#price" + index).text(customer_price);
                    $("#qty" + index).removeClass('d-none');
                    $(".qty").trigger("input");
                    allSum();
                }else{
                    // alert("ပစ္စည်းနံပါတ်မှားယွင်းနေပါသည်...");
                    // $(this).val("");
                    $(this).focus();
                    $("#qty" + index).addClass('d-none');
                    $("#name" + index).text("");
                    $("#price" + index).text("");
                }
            }else{
                alert("အထမ်းအရင်ရွေးပါ...");
                $(this).val("");
                return false;
            }
        });

        $(document).on("input",".qty",function(e){
            var qty = $(this).val();
            var index = $(this).closest('tr').index() + 1;
            var customer_price = $("#price" + index).text();
            $("#total" + index).text(qty * customer_price);
            allSum();
        });
    });

    function allSum(){
        var sum = 0;
        $(".total").each(function() {
            sum += parseInt($(this).text());
        });
        $("#allSum").text(sum);
    }
</script>