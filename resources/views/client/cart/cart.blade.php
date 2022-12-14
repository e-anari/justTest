@extends('layouts.app')

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>Invoice Design <small>Sample user invoice design</small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <section class="content invoice">
            <!-- title row -->
            <div class="row">
                <div class="  invoice-header">
                    <h1>
                        <i class="fa fa-globe"></i> Invoice.
                        <small class="pull-right">Date: 16/08/2016</small>
                    </h1>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Iron Admin, Inc.</strong>
                        <br>795 Freedom Ave, Suite 600
                        <br>New York, CA 94107
                        <br>Phone: 1 (804) 123-9876
                        <br>Email: ironadmin.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>John Doe</strong>
                        <br>795 Freedom Ave, Suite 600
                        <br>New York, CA 94107
                        <br>Phone: 1 (804) 123-9876
                        <br>Email: jon@ironadmin.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b>
                    <br>
                    <br>
                    <b>Order ID:</b> 4F3S8J
                    <br>
                    <b>Payment Due:</b> 2/22/2014
                    <br>
                    <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="  table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Title</th>
                                <th>Serial #</th>
                                <th style="width: 59%">Description</th>
                                <th>Cost</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartList as $one)
                            @if ($one['product'])
                            <tr>
                                <td>
                                    <select>
                                        @foreach(range(1,$one['product']->inventory) as $item)
                                        <option value="{{$item}}" @if ($item==$one['quantity']) selected @endif>
                                            {{$item}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{$one['product']->title}}</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome gerry
                                    Richardson helvetica tousled street art master testosterone trophy
                                    driving gloves handsome gerry Richardson
                                </td>
                                <td>{{$one['product']->price}}</td>
                                <td>{{$one['product']->price * $one['quantity']}}</td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="images/visa.png" alt="Visa">
                    <img src="images/mastercard.png" alt="Mastercard">
                    <img src="images/american-express.png" alt="American Express">
                    <img src="images/paypal.png" alt="Paypal">
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning
                        heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo
                        ifttt zimbra.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <p class="lead">Amount Due 2/22/2014</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <?php 
                                    $subtotal = $cartList->sum(function($item){
                                        return $item['product']->price * $item['quantity'];
                                    });
                                    ?>
                                    <td>{{$subtotal}}</td>

                                </tr>
                                <tr>
                                    <th>Tax (9.3%)</th>
                                    <td>$10.34</td>
                                </tr>
                                <tr>
                                    <th>Shipping:</th>
                                    <td>$5.80</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>$265.24</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class=" ">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit
                        Payment</button>
                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i>
                        Generate PDF</button>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection