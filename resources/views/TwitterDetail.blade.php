<html>
    <head>
        
              <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <input type="text" id="test">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>screen_name</th>
                    <th>location</th>
                    <th>Distance</th>
                    <th>Profile</th>
                    <th>text</th>
                <tr>
           </thead>
           <tbody>
           
            @if (!empty($statused))
                @foreach ($statused as $value)
              @if (empty($value->place))
               @continue
              @endif
                 <tr>
                    <td>{{ $value->user->name }}</td>               
                    <td>{{ $value->place->name }}</td> 
                    <td>{{ $value->created_at }}</td> 
                    <td> {{ $value->place->bounding_box->coordinates[0][0][1]  }} , {{ $value->place->bounding_box->coordinates[0][0][0]  }}</td>
                       <td><img src="{{ $value->user->profile_image_url }}"> </td> 
                    <td>{{ $value->text }}</td>
                  </tr>
                @endforeach
             @endif
         </tbody>
        </table>
    </body>
    <script>
$(document).ready(function(){
    

//        $.ajax({
//       type: "get",
//       url: "CheckRad",
//       dataType : "html",
//       data: {lat1 : "13.7224438",lon1 : "100.5362831",lat2 : "7.8611739",lon2 : "98.3700539",unit : "K"},
//       success: function (data, textStatus, jqXHR) {
//                alert(data);        
//        }
//    });
//    
});

    </script>
</html>