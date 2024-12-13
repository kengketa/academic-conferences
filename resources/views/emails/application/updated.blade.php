<!DOCTYPE html>
<html>
<head>
    <title>Application Updated</title>
</head>
<body>
<h1>Dear </h1>
<p>You need to consider</p>
<ul>
    <li>ชื่อการประชุมวิชาการ: {{ $application->name }}</li>
    <li>ผู้เสนอ: {{$application->proposedBy->name}}</li>
</ul>
</body>
</html>
