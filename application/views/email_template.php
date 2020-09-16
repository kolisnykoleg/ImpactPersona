<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impact Persona</title>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-1n4h{border-right: 2px solid #00b0f0;text-align:center;vertical-align:middle}
.tg .tg-qaw6{font-family:Verdana, Geneva, sans-serif !important;;font-size:14px;text-align:left;vertical-align:top}
.tg .tg-iao2{font-size:10px;text-align:left;vertical-align:top}
</style>

</head>
<body>
<p>Hi,</p>
<p>Please click on the link below to begin your DISC assessment. Complete all the questions in one sitting as you will not be able to save your responses and resume the assessment. If you have any questions, please don’t hesitate to contact me at charissa@impactpersona.com.au</p>


<table>
    <?php foreach ($assessments as $assessment): ?>
        <tr>
            <td><?= $assessment->Name ?>:</br></td>
            <td><a href="<?= base_url('survey/' . $assessment->URL . '/' . $transaction_key) ?>"><?= base_url('survey/' . $assessment->URL . '/' . $transaction_key) ?></a></td>

        </tr>
    <?php endforeach; ?>
</table>

<p>Yours sincerely,</p>

<table class="tg">
<thead>
  <tr>
    <th class="tg-1n4h"><img src="https://shop.impactpersona.com.au/assets/img/logo.png" alt="Impact Persona" width="52" height="59"></th>
    <th class="tg-qaw6"><span style="font-weight:bold">Charissa Lim</span><br><span style="font-weight:bold">Certified Behavioural Consultant</span><br>E: <a href="mailto:charissa@impactpersona.com.au" target="_blank" rel="noopener noreferrer">charissa@impactpersona.com.au</a><br>W: <a href="https://impactpersona.com.au">www.impactpersona.com.au</a><br>F: <a href="https://www.facebook.com/impactpersona">https://www.facebook.com/impactpersona</a><br></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-iao2" colspan="2">The content of this email is confidential and intended for the recipient specified in message only.<br>It is strictly forbidden to share any part of this message with any third party, without a written<br>consent of the sender. If you received this message by mistake, please reply to this message<br>and follow with its deletion, so that we can ensure such a mistake does not occur in the future.</td>
  </tr>
</tbody>
</table>

</body>
</html>
