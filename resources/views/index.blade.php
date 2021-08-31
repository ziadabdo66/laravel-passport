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
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">User name</th>
            <th scope="col">Email</th>

            <th scope="col">City</th>
            <th scope="col">Photo</th>
            <th scope="col">Delete</th>
            <th scope="col">Update</th>
        </tr>
        </thead>
        <tbody>

          @isset($tourisms)
              @foreach($tourisms as $tourism)
                  <tr class="tourism{{$tourism->id}}">
                      <td>{{$tourism->id}}</td>
                  <td>{{$tourism->username}}</td>
                  <td>{{$tourism->email}}</td>
                  <td>{{$tourism->city}}</td>
                  <td><img width="100px" height="100px" src="{{$tourism->photo}}"></td>
                  <td><button tour_id="{{$tourism->id}}" id="but_del" type="button" class="btn btn-danger">Delete</button></td>
                  <td><a href="{{route('ajaxDuplicate',$tourism->id)}}"><button  type="button" class="btn btn-success">duplicate</button></a></td><td><a href="{{route('ajaxUpdate',$tourism->id)}}"><button  type="button" class="btn btn-success">Update</button></a></td>

                 </tr>
                @endforeach
            @endisset

        </tbody>
    </table>
    <p id="msg"></p>

    </body>
</html>
<script>
    $(document).on('click','#but_del',function (e){


        e.preventDefault();
        var id=$('#but_del').attr('tour_id');
        $.ajax({
            type:'POST',
            url:"{{route('ajaxDelete')}}",
            data: {
                "_token":"{{csrf_token()}}",
                "id":id
            },


            success:function(data) {
                $("#msg").html(data.message);
                $('.tourism'+data.id).remove();
            }
        });


    });



</script>
