<!doctype html>
<html lang="en">
  <head>
    <title>Enquiry mail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
 <style>
 
 </style>
 
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                <h3> New Enquiry mail </h3>
                <p> Hey, {{$details['f_name']}} {{$details['l_name']}}</p>
                <p> Email address : {{$details['email']}} </p>
                 <p> Subject : {{$details['subject']}} </p>
                   <p> Message : {{$details['message']}} </p>
                <br/>
                <br/>
                <p> Best Regards</p>
                <p> Team, Emart Shopping </p>
            </div>
        </div>
    </div>
  </body>
</html>