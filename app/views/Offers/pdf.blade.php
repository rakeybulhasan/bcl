<div class="invoice-container rounded-container peel-shadows">

    <div class="status-viewed tooble-cursor">

    </div>

        <div class="t01-01" id="inv">


            <div class="inv_title invoice">
                Offer Information
            </div>

            <div id="inv_top">
                <div id="inv_address">
                    <div class="inv_from">

                    </div><br/><br/>
                    <div id="inv_to">

                    </div>
                </div>

                <div id="inv_logo">
                    <div class="inv_from">

                        <br>
                        <div class="inv_abn"></div>
                    </div>
                    <table  cellspacing="0" cellpadding="4" id="inv_box">
                        <tbody>
                        <tr>
                            <th>Offer Title #:
                            </th>
                            <td>{{ $offerdata->title }}</td>
                        </tr>
                        <tr>
                            <th>Description #:
                            </th>
                            <td>{{ $offerdata->description }}</td>
                        </tr>
                        <tr>
                            <th>Client Name #:
                            </th>
                            <td>{{ $offerdata->client->first_name.' '.$offerdata->client->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{$offerdata->created_at}}</td>
                        </tr>
                        </tbody></table>
                </div>

                <div class="inv_topspace">

                </div>


            </div>

            <div class="inv_items_container">

                <table cellspacing="0" cellpadding="2" width="100%" id="inv_items">
                    <tbody>
                    <tr>
                        <th>
                            Category Name
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Commission
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th class="end">
                            Line Total&nbsp;($)
                        </th>
                    </tr>
                <?php $sum=0;?>
                    @foreach ($offerdata->offerproducts as $value)
                         <tr>
                            <td class="inv_col_desc">{{($value->category->category_name !='') ? $value->category->category_name : $value->category-> product -> product_name}}</td>
                            <td class="inv_col_cost">{{$value->price}}</td>
                            <td class="inv_col_qty">{{(($value->price * $value->quantity) * $value->commission/100)}}</td>
                            <td class="inv_col_qty">{{$value->quantity}}</td>
                            <td class="inv_col_qty">{{$value->line_total }}</td>
                         </tr>
                    <?php $sum+= $value->line_total?>
                    @endforeach
                    <tr>
                        <td class="inv_col_desc"></td>
                        <td class="inv_col_cost"></td>
                        <td class="inv_col_qty"></td>
                        <td class="inv_col_qty"></td>
                        <td class="inv_col_qty"><strong>{{$sum}}</strong></td>
                    </tr>
                    </tbody></table>


            </div>
            <br>



            <div class="invoice-brand">
            </div>

            <div class="tearoff">


                <div style="clear: both;"></div>
            </div>
        </div>


        <div class="clearb"></div>

  
</div>


<style>
    .rounded-container {
        border: 1px solid #CCCCCC;
        border-radius: 5px 5px 5px 5px;
        margin-bottom: 20px;
        position: relative;
    }
    .invoice-container {
        clear: both;
        padding: 54px 40px 150px;
        z-index: 0;
    }
    #inv.t01-01, .attachment-header {
        font-family: Arial,"Arial Unicode","Arial Unicode MS",Helvetica,sans-serif;
        font-size: 11px;
        line-height: 14px;
        margin: 0 auto;
        padding-top: 20px;
        position: relative;
        width: 630px;
    }

    .t01-01 .inv_title {
        color: #EEEEEE;
        font-size: 28px;
        font-weight: bold;
        line-height: 26px;
        position: absolute;
        text-align: center;
        text-transform: uppercase;
        width: 630px;
        z-index: 0;
    }
    .t01-01 #inv_top {
        margin-bottom: 20px;
    }
    #inv.t01-01, .attachment-header {
        font-family: Arial,"Arial Unicode","Arial Unicode MS",Helvetica,sans-serif;
        font-size: 11px;
        line-height: 14px;
    }
    .t01-01 #inv_address {
        float: left;
        font-size: 13px;
        position: relative;
        width: 50%;
        word-wrap: break-word;
        z-index: 10;
    }

    .t01-01 #inv_address > .inv_from, .t01-01 #inv_logo > .inv_from {
        height: auto;
        min-height: 125px;
    }
    .t01-01 #inv_logo {
        float: right;
        text-align: right;
        width: 50%;
        margin: 0 0 0 350px;
    }
    .t01-01 .inv_abn {
        font-weight: bold;
        padding: 5px 0;
        text-align: right;
    }

    .t01-01 #inv_box {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #000000 #000000 -moz-use-text-color;
        border-image: none;
        border-style: solid solid solid solid;
        border-width: 1px 1px 1px 1px;
        text-align: left;
        width: 280px;
    }

    .t01-01 .inv_topspace {
        clear: both;
        height: 15px;
    }

    #inv.t01-01 > .inv_items_container {
        height: auto;
        min-height: 180px;
    }
    .t01-01 .inv_items_container {
        border-left: 1px solid #000000;
        border-right: 1px solid #000000;
        border-bottom: 1px solid #000000;
        height: 180px;
        padding-bottom: 20px;
        position: relative;
    }
    .t01-01 #inv_items, .t01-01 #inv_time {
        margin-bottom: 20px;
    }

    .t01-01 #inv_items th, .t01-01 #inv_time th {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background-color: #CCCCCC;
        border-color: #000000 #000000 -moz-use-text-color;
        border-image: none;
        border-style: solid solid solid solid;
        border-width: 1px 1px 1px 1px;
        height: 25px;
        text-align: center;
    }


    .t01-01 #inv_totals {
        border: 1px solid #000000;
        margin: 0 0 0 350px;
    }
    .t01-01 #inv_totals table {
        border: 1px solid #000000;
        width: 100%;

    }

    .t01-01 #inv_totals table th {
        font-weight: normal;
        text-align: right;
    }
    thead th, tbody tr th {
        text-align: left;
    }
    .t01-01 #inv_totals table td {
        padding-right: 8px;
        text-align: right;
    }
    .t01-01 #inv_totals table .total {

        font-weight: bold;
    }

    .t01-01 #inv_totals table .balance {
        background-color: #CCCCCC;
        border-top: 3px double #000000;
        font-weight: bold;
        height: 30px;
    }
</style>

