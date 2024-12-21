<!DOCTYPE html>
<html>
<head>
    <title>Admission Letter</title>
</head>
<body>
    <h1>Admission Letter</h1>
    <p>Dear {{ $student->name }},</p>
    <p>Congratulations! You have been admitted to our institution.</p>
    <p><strong>Details:</strong></p>
    <ul>
        <li>Student ID: {{ $student->index_number }}</li>
        <li>Phone: {{ $student->phone }}</li>
        <li>Admission Date: {{ $student->admission_date }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>
