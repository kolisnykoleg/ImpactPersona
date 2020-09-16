<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Tahoma, sans-serif;
        }

        p {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        sup {
            font-size: 50%;
            vertical-align: text-top;
        }

        .header {
            margin-bottom: 50px;
        }

        .header td {
            padding: 2px 10px;
            vertical-align: top;
        }

        .header-logo {
            width: 30%;
        }

        .header-logo img {
            width: 60px;
        }

        .header-meta {
            width: 40%;
            font-size: 60%;
            text-align: center;
        }

        .header-primary {
            width: 30%;
            font-weight: bold;
            text-align: center;
        }

        .header-primary p + p {
            margin-top: 0.5em;
        }

        .parties {
            margin-bottom: 50px;
        }

        .parties th {
            width: 12%;
            padding: 2px 10px;
            text-align: right;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            vertical-align: top;
        }

        .parties td {
            padding: 2px 10px;
            border-bottom: 1px solid #000;
            vertical-align: top;
        }

        .calculation-title {
            color: white;
            background-color: black;
            width: 100%;
            padding: 15px 10px;
            font-weight: bold;
        }

        .calculation {
            margin-bottom: 50px;
        }

        .calculation th {
            color: white;
            padding: 5px 10px;
            border: 1px solid black;
        }

        .calculation td {
            padding: 5px 10px;
            border: 1px solid black;
        }

        .calculation thead th {
            background-color: #333;
            padding: 15px 10px;
            text-align: left;
        }

        .calculation thead .calculation-value {
            text-align: center;
        }

        .calculation tfoot th {
            padding: 0;
            text-align: right;
            border: none;
        }

        .calculation-value {
            width: 20%;
            text-align: center;
        }

        .calculation tfoot .calculation-total {
            background-color: black;
            width: 15%;
            padding: 2px 10px;
            font-size: 80%;
            border: 1px solid black;
            white-space: nowrap;
        }

        .footer {
            margin-bottom: 20px;
            border-bottom: 1px solid black;
        }

        .footer th {
            background-color: black;
            color: white;
            padding: 15px 10px;
            text-align: left;
            border: 1px solid black;
        }

        .footer td {
            border: 1px solid black;
        }

        .footer tbody td {
            background-color: #1b75bc;
            color: white;
            padding: 5px 10px;
        }

        .footer tfoot td {
            padding: 5px 10px;
            font-size: 70%;
        }
    </style>
</head>
<body>
<table class="header">
    <thead></thead>
    <tbody>
    <tr>
        <td class="header-logo">
            <img src="data:image/png;base64,<?= base64_encode(file_get_contents(FCPATH . 'assets/img/logo.png')); ?>" alt=""/>
        </td>
        <td class="header-meta">
            <p>The Trustee for RGB Solutions</p>
            <p>
                <strong>ABN: 56 762 463 213</strong>
            </p>
            <p>PO Box 5220 Eagleby, QLD, 4207, Australia</p>
        </td>
        <td class="header-primary">
            <p><u>RECEIPT</u></p>
            <p><?= $date ?></p>
            <p>Reference: <?= $transaction_key ?></p>
        </td>
    </tr>
    </tbody>
    <tfoot></tfoot>
</table>

<table class="parties">
    <thead></thead>
    <tbody>
    <tr>
        <th>To:</th>
        <td>
            <p><?= $name ?></p>
            <p><?= $address ?></p>
        </td>
    </tr>
    <tr>
        <th>From:</th>
        <td>
            <p>The Trustee for RGB Solutions Trading as Impact Persona</p>
            <p>charissa@impactpersona.com.au</p>
        </td>
    </tr>
    </tbody>
    <tfoot></tfoot>
</table>

<div class="calculation-title">
    Impact Persona – DISC Assessment & Profile
</div>

<table class="calculation">
    <thead>
    <tr>
        <th colspan="2">Description:</th>
        <th class="calculation-value">Price EX GST</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($assessments as $assessment): ?>
    <tr>
        <td colspan="2"><?= $assessment->Name ?></td>
        <td class="calculation-value">$<?= $assessment->Price ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th></th>
        <th class="calculation-total">Total (EX GST):</th>
        <td class="calculation-value">$<?= $total ?></td>
    </tr>
    </tfoot>
</table>

<table class="footer">
    <thead>
    <tr>
        <th>Payment Method: PayPal / Braintree Payments</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>PAYPAL *RGBS $<?= $total ?></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td>
            Please Note: The following line will appear on your credit or debit
            card statement.
        </td>
    </tr>
    </tfoot>
</table>
</body>
</html>

