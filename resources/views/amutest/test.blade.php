<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>
    </head>
    <body>
        <div class="container">
            <div>
                需要查找的分类名称是：{{$class_name}}
                <hr>
            </div>
            <div class="content">
            <form action="{{url('openapi/codeConfirm')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                @foreach ($imgData as $img)
                    <img src="{{$img->pic}}" alt="">
                    <input type="checkbox" value="{{$img->id}}" name="checkvalue[]">
                @endforeach
                <input type="submit" value="确认">
            </form>
            </div>
        </div>
    </body>
</html>
