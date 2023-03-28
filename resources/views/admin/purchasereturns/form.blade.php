<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Returns</title>
    <style>
        #doc {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            font-size: 10px;
            border-collapse: collapse;
            margin-bottom: 30px;
        }


        #doc td,
        #emp th {
            border: 1px solid #919191;
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
    <h2 style="text-align: center; "><strong>PURCHASE RETURN SLIP</strong></h2>










<p style="font-family:arial; font-size:15px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;PRS No.: _____________</p>
<p style="font-family:arial; font-size:15px;">SITE/CLIENT: ________________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;DATE: _____________ </p>


    <p style="font-family:arial; font-size:15px;">ADDRESS:&nbsp; &nbsp; ________________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;   PO No. / DR No.: _____________<</p>




    <table id="doc">
            <tr>
                <th style="text-align: center; background-color:#5480e9">ITEM NO.</th>
                <th style="text-align: center; background-color:#5480e9">QTY</th>
                <th style="text-align: center; background-color:#5480e9">UOM</th>
<th style="text-align: center; background-color:#5480e9">DESCRIPTION</th>
                <th style="text-align: center; background-color:#5480e9">MODEL</th>
 <th style="text-align: center; background-color:#5480e9">SERIAL NO.</th>




            </tr>
            @foreach ($purchase_returns as $purchase_return)
                <tr>
                    <td>{{ $purchase_return->id }}</td>
                    <td>{{ $purchase_return->quantity }}</td>
                    <td>{{ $purchase_return->uom }}</td>
                    <td>{{ $purchase_return->itemdescription }}</td>
                    <td>{{ $purchase_return->model }}</td>
                    <td>{{ $purchase_return->serialnumber }}</td>


                </tr>
            @endforeach
    </table>
    <footer style="margin-top:10px;">


        <p><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp;&nbsp;Prepared by:&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Released by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Returned by:&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;Received by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approved
                    by:&nbsp;&nbsp;</span></span></p>


        <p style="text-align: center;">&nbsp;&nbsp; __________&nbsp;&nbsp;&nbsp; __________&nbsp;&nbsp;&nbsp;&nbsp;
            __________&nbsp;&nbsp;&nbsp; __________&nbsp;&nbsp;&nbsp; __________&nbsp;
            &nbsp;&nbsp;__________&nbsp;&nbsp;</p>


    </footer>
</body>


</html>


