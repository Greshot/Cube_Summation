<div>
    <ul>
        <strong>Whoops!</strong> Hubo algunos problemas con la información introducida.<br><br>
        @foreach($errors as $error)
            <li>{!!$error!!}</li>
        @endforeach
    </ul>
</div>