@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h1>Product List</h1>
    <div id="product-list"></div>

    <script>
        // Fetch products and display
        axios.get('/api/v1/products')
            .then(response => {
                let productsHtml = '';
                response.data.forEach(product => {
                    productsHtml += `
                        <div class="product-card">
                            <img src="https://via.placeholder.com/150" alt="${product.name}">
                            <h3>${product.name}</h3>
                            <p>${product.description}</p>
                            <p>$${product.price}</p>
                            <button onclick="addToCart(${product.id}, 1)">Add to Cart</button>
                        </div>
                    `;
                });
                document.getElementById('product-list').innerHTML = productsHtml;
            });

        function addToCart(productId, quantity) {
            axios.post('/api/v1/cart/add', { product_id: productId, quantity: quantity })
                .then(response => {
                    alert(response.data.message);
                })
                .catch(error => {
                    alert(error.response.data.message);
                });
        }
    </script>
@endsection
