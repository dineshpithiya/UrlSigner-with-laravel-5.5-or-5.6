<!DOCTYPE html>
<html>
<head>
    <title>T</title>
</head>
<body>
<table border="1">
    @foreach($chipid as $key=>$value)
    <tr>
        <td>{{$key}}</td>
        <td>{{$value->idchipid}}</td>
        <td><a href="{{UrlSigner::sign(url('edit-chip/'.$value->idchipid), Carbon\Carbon::now()->addHours(2) )}}">Edit</a></td>
    </tr>
    @endforeach
</table>
</body>
</html>