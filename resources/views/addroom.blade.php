<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Room</title>
    <!-- Đường dẫn đến file CSS của Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .products {
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
        }

        .room img {
            flex-basis: calc(25% - 10px);
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            @csrf
            <div class="d-flex justify-content-between align-items-center">
                <h2>Quản lý phòng</h2>
                <button type="submit" class="btn btn-primary" name="sbm">Thêm mới phòng</button>
            </div>
            <div class="form">
                <div class="form-group">
                    <label for="roomname">Tên phòng</label>
                    <input type="text" class="form-control" name="roomname" placeholder="Tên phòng">
                </div>
                <div class="form-group">
                    <label for="des">Mô tả phòng</label>
                    <input type="text" class="form-control" name="des" placeholder="Mô tả phòng">
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" class="form-control" name="price" placeholder="Giá">
                </div>
                <div class="form-group">
                    <label for="img">Hình ảnh</label>
                    <input type="text" class="form-control" name="img" placeholder="Link ảnh">
                </div>
            </div>
        </form>
        <div class="products">
        <div class="row">
            @if(isset($rooms))
            @foreach ($rooms as $room)
            <div class="col-md-4">
                <div class="room-card">
                    <img src="{{ $room['image'] }}" alt="Room Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room['room_name'] }}</h5>
                        <p class="card-text">{{ $room['description'] }}</p>
                        <p class="card-text">Price: {{ $room['price'] }}</p>
                        <a href="#" class="btn btn-primary">Book now</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        </div>
    </div>

    <!-- Đường dẫn đến file JavaScript của Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>