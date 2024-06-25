<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/css/pos.css')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>ThemeLooks Pos</title>
</head>

<body>
@include('template.pos.pos_includes.header')
@yield('content');

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
    getCartData()
    $(document).on('click','.addToCart',function(){
        const product_id = $(this).data('product_id');
        $.ajax({
            url:"{{route('pos.add.cart')}}",
            method:'get',
            data:{
                id:product_id
            },
            success:function(response){

                if(response.success) {
                     getCartData();
                     console.log(response.success);
                }else if(response.error) {
                    console.log( response.error);
                }else{
                    console.log(response);
                }
            }
        });
    });

    function getCartData(){
        $.ajax({
            url:'{{route('pos.get.cart.data')}}',
            method:'get',
            success:function (response){
                $('.subTotal').html(response['subtotal']);
                $('.discount').html(response['discount']);
                $('.tax').html(response['tax']);
                $('.total').html(response['total']);
                $('.table_body').html(response['table'])
            }

        });
    }

    $(document).on('click','.deleteData',function(){
        const cart_id = $(this).data('cart_id');
        $.ajax({
            url:'{{route('pos.delete.data')}}',
            method:'get',
            data:{
                id:cart_id
            },
            success:function (response){
                if(response.success) {
                    getCartData();
                    console.log(response.success);
                }else if(response.error) {
                    console.log( response.error);
                }else{
                    console.log(response);
                }
            }
        });
    });

    $(document).on('keyup','.productQuantity',function(){

        const quantity = $(this).val();
        const cart_id = $(this).data('cart_id');

        $.ajax({
            url:'{{route('pos.change.quantity')}}',
            method:'get',
            data:{
                quantity:quantity,
                cart_id:cart_id,
            },
            success:function(response){
                if(response.success) {
                    getCartData();
                    console.log(response.success);
                }else if(response.error) {
                    console.log( response.error);
                }else{
                    console.log(response);
                }
            }
        });
    });

    $(document).on('click','.emptyCart',function(){
       $.ajax({
           url:'{{route('pos.empty.cart')}}',
           method:'get',
           success:function (response){
               if(response.success) {
                   getCartData();
                   console.log(response.success);
               }else if(response.error) {
                   console.log( response.error);
               }else{
                   console.log(response);
               }
           }
       })
    })

    $(document).on('click','.placeOrder',function(){
        $.ajax({
            url:'{{route('order.create')}}',
            method:'get',
            success:function(response){
                if(response.success) {
                    getCartData();
                    console.log(response.success);
                }else if(response.error) {
                    console.log( response.error);
                }else{
                    console.log(response);
                }
            }
        })
    })

    $("body").on("keyup", ".productSearch", function() {
        let text = $(".productSearch").val();
        // alert(category_id);
        // console.log(text);

        if (text.length > 0) {

            $.ajax({
                data: {
                    search: text
                }
                , url: "{{ route('pos.product.search') }}"
                , method: 'get'
                , beforSend: function(request) {
                    return request.setReuestHeader('X-CSRF-Token', ("meta[name='csrf-token']"))

                }
                , success: function(result) {
                    if (result) {
                        $(".request__product").html(result);
                        $(".productShow").addClass('d-none');

                    }else{
                        $('.request__product').html("No results found.");
                    }
                }

            }); // end ajax
        } // end if
        if (text.length < 1) $(".request__product").html(""); $(".productShow").removeClass('d-none');
    });

</script>

</body>
</html>


