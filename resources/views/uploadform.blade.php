<!DOCTYPE html>
<html>
    <head>
        <title>Show Image</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    </head>

    <body>

        <div class="container">
            <div class="jumbotron">
                <h1>ANy TITLE</h1>
            <table class="table table-stripped table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    
                    </tr>
                </thead>
                <tbody>

                @foreach($images as $image)
                    <tr>
                    
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->name }}</td>
                    <td><img src="{{  asset('uploads/image/' . $image->image) }}" width="150px" height="100px" alt="Image"></td>
                    </tr>
                    <tr>
                
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>

    </body>
</html>