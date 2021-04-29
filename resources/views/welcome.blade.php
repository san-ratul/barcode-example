@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table id="mtable" class="table table-bordered table-striped"
                style="margin-bottom: 1rem;">
                <thead style="background-color: #000; color: #fff; ">
                    <tr>
                        <th style="width: 160px">Product</th>
                        <th style="width: 350px">Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody id="mtable">

                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="total_price">Total Price *</label>
                <input id="total_price" type="text" name="total_price" class="form-control">
            </div>
            <!-- /.form-group -->
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="Paid Amount">Paid Amount</label>
                <input type="text" id="paid_amount" name="paid_amount" class="form-control">
            </div>
            <!-- /.form-group -->
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="Due Amount">Due Amount</label>
                <input type="text" name="due_amount" class="form-control">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col -->
    </div>
</div>

@endsection

@section('scripts')

{{-- barcode scanner script --}}
<script src="{{ asset('js/jquery.scannerdetection.js') }}"></script>
<script>
    $(document).ready(function() {
        productsStore = {!! json_encode(App\Product::get()) !!};
    });
    $counter = 0;
    function addrow(pid, pname, desc, price) {
        var i = ++$counter;
        // console.log(price);
        var tr = '<tr class="products">' +
            '<td>' +
            '<input type="hidden" name="product_id[]" value="' + pid + '">' +
            '<p class="product_name">' + pname + '</p>' +
            '</td>' +
            '<td>'+desc.substring(0, 150)+'...</td>' +
            '<td><input class="form-control input-value" min="1"  type="number" name="quantity[]" id="quantity" value="1"></td>' +
            '<td><input class="form-control" min="0"  type="number" name="price[]" id="price" value="' + price + '"/></td>' +
            '</tr>';
        $('tbody').append(tr);
    };

    $(document).scannerDetection({
        timeBeforeScanTest: 200, // wait for the next character for upto 200ms
        startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
        endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
        avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
        onComplete: function(barcode, qty) {
            var keyword = barcode.toLowerCase();
            pid = null;
            productsStore.map(product => {
                let id = product.barcode.toString().toLowerCase();
                if (id.includes(keyword)) {
                    $('#product_search').val('');
                    pid = product.id;
                    pname = product.name;
                    price = product.price;
                    desc = product.desc;
                }
            })
            if (pid != null) {
                addrow(pid, pname, desc, price);
            }
        } // main callback function
    });
</script>

@endsection
