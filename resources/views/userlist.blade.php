<table>
    <th>
        Name
    </th>
    <th>
        Email
    </th>
   
    @foreach($user as $u)
    <tr>
        {{$u->name}}
        
    </tr>
    <tr>
        {{$u->email}}
        <br>
    </tr>
    @endforeach
</table>

