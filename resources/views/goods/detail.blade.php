<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($attr as $k=>$v)
        <button> {{$v['attr_name']}}</button>
        @foreach($v['attr_v'] as $k1=>$v1)
            <button class="attr" id="attr_{{$v1['id']}}" data-id="{{$v1['id']}}">{{$v1['title']}}</button>
        @endforeach
        <hr>
    @endforeach

    <hr>
    价格： <input type="text" id="price">
    库存： <input type="text" id="store">
    <script src="/js/jquery-1.12.4.min.js"></script>

    <script>
        var goods_id = "{{$goods_id}}";
        var attr_path = "";
        $(".attr").click(function (e) {
            attr_path += $(this).attr("data-id") + ',';
            $.ajax({
                url: '/goods/getPrice?id='+ goods_id + '&attr_path=' + attr_path,
                type: 'get',
                dataType: 'json',
                success:function(d)
                {
                    console.log(d);
                    $("#price").val(d.price);
                    $("#store").val(d.store);
                }
            });
        })





    </script>
</body>
</html>




