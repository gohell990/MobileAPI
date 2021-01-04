<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <div class='container'>
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email">

            </div>
            <div class="input-group">
                <div>
                    <label>password:</label>
                    <input type="text" class="form-control" name="password">
                </div>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

    <div></div>
    <div>
        <form action="{{ route('me') }}" method="POST">
            {{ csrf_field() }}
            <div>
                <?php
                    $token = $_SESSION("_token");
                ?>
                <button type="submit" name="submit">ME</button>
            </div>
        </form>
    </div>

    
</body>
</html>