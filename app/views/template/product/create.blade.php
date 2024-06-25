@extends('layouts.master');
@section('content')
    <p class="custom_text">Product Add Section</p>
    <form action="{{route('product.store')}}" method="post"enctype="multipart/form-data">
        @csrf
        <div class="row p-5 product_section">
            <div class="col-md-6 col-sm-12">
                <label for="name">Product Name:</label>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="text" class="form-control" id="name" name="name"><br><br>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="product_unit">Product Unit:</label><br>
                <select class="form-select" id="product_unit" name="product_unit">
                    <option value="kg">KG</option>
                    <option value="litter">Litter</option>
                    <option value="Pieces">Pieces</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="product_unit_value">Product Unit Value:</label>
                @error('product_unit_value')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="number" class="form-control" id="product_unit_value" name="product_unit_value"><br><br>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="selling_price">Selling Price:</label>
                @error('selling_price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="number" class="form-control" id="selling_price" name="selling_price"><br><br>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="purchase_price">Purchase Price:</label>
                @error('purchase_price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="number" class="form-control" id="purchase_price" name="purchase_price"><br><br>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="discount">Discount</label><br>
                <input type="number" class="form-control" id="discount" name="discount"><br><br>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="tax">Tax(%):</label>
                @error('tax')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="number" class="form-control" id="tax" name="tax"><br><br>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="image">Image:</label>
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"></p>
                <p><img id="output" width="200" /></p>
            </div>
        </div>

        <div class="d-flex justify-content-end p-3">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection

<script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
</script>
