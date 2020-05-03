<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Form</title>
</head>
<body>

    <form action="loginsubmit" method="post">
        @csrf   {{-- token pathako --}}
      
        Email :
        <input type="text" name="title" ><br><br>
        Password :
        <input type="password" name="body" placeholder="Password Here......"><br>
    

        <input type="submit" name="submit" value="Create">
 </form>

    
</body>
</html>
    