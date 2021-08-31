<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body>
    <form class="row g-2" id="formData" >
        @csrf
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input value="{{$tourism->email}}" type="email" class="form-control" id="inputEmail4" name="email">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input value="{{$tourism->password}}" type="text" class="form-control" id="inputPassword4" name="password">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">user name</label>
            <input value="{{$tourism->username}}" type="text" class="form-control" id="inputUserName" placeholder="zzzzz" name="username">
        </div>

        <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input value="{{$tourism->city}}" type="text" class="form-control" id="inputCity" name="city">
        </div>

        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">photo</label>
            <input class="form-control" type="file" id="" name="photo">
        </div>

<input type="hidden" value="{{$tourism->id}}" name="id">
        <div class="col-12">
            <button id="btn_form" class="btn btn-primary">Sign in</button>
        </div>
    </form>
    <p id="msg"></p>

    </body>
</html>
<script>
    $(document).on('click','#btn_form',function (e){

        e.preventDefault();
        var formDta=new FormData($('#formData')[0]);
        $.ajax({
            type:'POST',
            enctype:'multipart/form-data',
            url:"{{route('ajaxEdit')}}",
            data: formDta,
            processData:false,
            contentType:false,
            cache:false,

            success:function(data) {
                $("#msg").html(data.message);
            }
        });


    });



</script>
