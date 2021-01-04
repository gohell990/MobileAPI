<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <div class='container'>
    <form action="{{ route('add') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class='form-group'>
        <label>Name:</label>
        <input type="text" class="form-control" placeholder="enter name" name="name">
    </div>
        <div class='input-group'>
            <div class='custom-file'>
            <input type='file' name='image' class='custom-file-input'>
            <label class="custom-file-label">Choose File</label>
            </div>
        </div>
        <button type="submit" name="submit" >Upload</button>
    </form>
    </div>

    <div></div>
    <!-- <div>
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email">

            </div>
            <div class="input-group">
                <div>
                    <label>password:</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div> -->
</body>
</html>