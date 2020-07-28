<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ImpactPersona</title>
    <style></style>
</head>
<body>
<table>
    <?php foreach ($assessments as $assessment): ?>
        <tr>
            <td><?= $assessment->Name ?></td>
            <td><?= base_url('survey/' . $assessment->URL . '/' . $transaction_key) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
