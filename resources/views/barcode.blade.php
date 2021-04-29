
@extends('app')

@section('styles')
    <style>
    .barcode_parent {
        width: 90%;
        overflow: hidden;
        margin: 0px auto;
    }
    .barcode_parent div{
        margin: 0px auto;
        height: 45px !important;
    }
    .table.sum-table td{
        border: none;
    }
    </style>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title FormTitle">Product Barcodes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-md-3 text-center">
                                        <h5>{{$product->name}}</h5>
                                        <div class="barcode_parent">
                                            {!! DNS1D::getBarcodeHTML($product->barcode, 'C39',1) !!}
                                        </div>
                                        <p>{{$product->barcode}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
