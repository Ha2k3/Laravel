<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Document</title> 
       
</head>
<body>
    <br>
    <form class="container" method="post">
        @csrf
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Name:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Name input" name="name">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Age:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Age input" name="age">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Date:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Date input" name="date">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Phone:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Phone input" name="phone">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Web:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Web input" name="web">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Address:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Address input" name="address">
          </div>
          <button type="submit" class="btn btn-primary">Ok</button>
          <div>
            @include ('block.erro')
          </div>
          <div class="display-infor">
                @if(isset($user))
                <p>Name: {{$user['name']}}</p>
                <p>Age: {{$user['age']}}</p>
                <p>Date: {{$user['date']}}</p>
                <p>Phone: {{$user['phone']}}</p>
                <p>Web: {{$user['web']}}</p>
                <p>Address: {{$user['address']}}</p>
                @endif
          </div>
      </form>
</body>
</html>