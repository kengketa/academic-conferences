<!DOCTYPE html>
<html>
<head>
    <title>Application Updated</title>
</head>
<body>
<h1>Dear </h1>
<p>มีการประชุมวิชาการที่ท่านต้องพิจารณา</p>
<ul>
    <li>ชื่อการประชุมวิชาการ: {{ $application->name }}</li>
    <li>ผู้เสนอ: {{$application->proposedBy->name}}</li>
</ul>
<a href="{{route('dashboard.applications.edit',$application->id)}}">
    กดsdkfjhds
</a>
</body>
</html>
