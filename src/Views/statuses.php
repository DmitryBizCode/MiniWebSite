<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Statuses</title>
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Lead Statuses</h1>

    <form method="get" action="/statuses" class="mb-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="date_from" class="form-label">From</label>
                <input type="datetime-local" id="date_from" name="date_from" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="date_to" class="form-label">To</label>
                <input type="datetime-local" id="date_to" name="date_to" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Status</th>
            <th>FTD</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($statuses as $lead): ?>
            <tr>
                <td><?= htmlspecialchars($lead['id']) ?></td>
                <td><?= htmlspecialchars($lead['email']) ?></td>
                <td><?= htmlspecialchars($lead['status']) ?></td>
                <td><?= htmlspecialchars($lead['ftd']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <a href="/" class="btn btn-secondary">Back to Form</a>
    </div>
</div>

</body>
</html>
