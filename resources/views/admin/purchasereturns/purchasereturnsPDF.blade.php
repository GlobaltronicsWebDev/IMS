<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Return Items List</title>
    <style>
        #doc {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;

        }

        #doc td,
        #emp th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #doc th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #ddd;
        }

        .pdf-btn {
            margin-top: 30px;
            text-align: center;

        }

        .btn-primary {
            color: black;
            background-color: white;
            border-color: aquamarine;
        }

        .btn-primary:hover {
            color: white;
            background-color: aquamarine;
            border-color: white;
        }

            {
            font-size: 15px;
        }

        footer {
            text-align: center;
            align-items: center;
            padding: 5px;
            position: absolute;
            bottom: 0;
            margin-left: 12px;
            margin-right: 12px;
            border: 3px solid;
            border-style: double;

            align-content: center;
            align-self: center;
            left: 0;
            right: 0;
            float: center;

        }
    </style>
</head>

<body>
    <h2 style="text-align: center;"><img src="{{public_path("uploads/formlogo.png")}}" width="400" height="75">
    </h2>
    <hr />
    <p style="text-align: center; font-size:10px;">349 Ortigas Avenue, Brgy. Wack-wack, Mandaluyong City</p>
    <p style="text-align: center; font-size:10px;">TEL No. (02)721-2878/721-2585 Fax No. 411-1820</p>
    <h2 style="text-align: center; "><strong>PURCHASE RETURNS LIST</strong></h2>




    <table id="doc">
        <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th style="text-align: center;">Location</th>
                <th style="text-align: center;">Checkout Date</th>
                <th style="text-align: center;">Client</th>

                <th style="text-align: center;">SKU</th>
                <th style="text-align: center;">Product Code</th>
                <th style="text-align: center;">Model</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: center;">UOM</th>
                <th style="text-align: center;">Item Description</th>
                <th style="text-align: center;">Serial No.</th>
                <th style="text-align: center;">DR No.</th>
                <th style="text-align: center;">PRS No.</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($purchase_returns as $purchase_return)
                <tr>
                    <td>{{ $purchase_return->id }}</td>
                    <td>{{ $purchase_return->location }}</td>
                    <td>{{ $purchase_return->checkoutdate }}</td>
                    <td>{{ $purchase_return->client }}</td>
                    <td>{{ $purchase_return->sku }}</td>
                    <td>{{ $purchase_return->productcode }}</td>
                    <td>{{ $purchase_return->model }}</td>
                    <td>{{ $purchase_return->quantity }}</td>
                    <td>{{ $purchase_return->uom }}</td>
                    <td>{{ $purchase_return->itemdescription }}</td>
                    <td>{{ $purchase_return->serialnumber }}</td>
                    <td>{{ $purchase_return->drnumber }}</td>
                    <td>{{ $purchase_return->rsnumber }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
