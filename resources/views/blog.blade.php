<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blog page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-primary text-center mt-3">laravel 10 multiple image store</h1>
        <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data" class="w-50 m-auto">
            @csrf
            Pick image :
            {{-- image variabel must be array type  --}}
            <input type="file" class="form-control mb-3" name="images[]" multiple id="">
            @error('images')
                <div class="text-sm  text-danger">{{ $message }}</div>
            @enderror
            Post Title :
            <input type="text" class="form-control  @error('title') border-red-500 @enderror" name="title"
                id="">
            @error('title')
                <div class="text-sm text-danger">{{ $message }}</div>
            @enderror
            <input type="submit" class="btn btn-success form-control w-25 mt-3" value="SAVE">
        </form>
    </div>
    <h1>blog posts</h1>
    <div class="container">
        <div class="row text-center">
            <div class="col-10 offset-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">title</th>
                            <th scope="col">image</th>
                            <th scope="col">del</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $post)
                            <tr>
                                <th scope="row">{{ $post->title }}</th>
                                <td>
                                    @foreach ($post->images as $img)
                                        <img src="{{ asset('/storage/' . $img) }}" alt=""
                                            class=" img-thumbnail " style="height:100px ; width:100px;">
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('image.destroy', $post->id) }}" method="POST">
                                        @csrf @method('delete')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
