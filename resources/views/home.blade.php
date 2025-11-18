@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white" data-animate>
                    <h1 class="text-4xl lg:text-6xl font-display font-bold mb-6 leading-tight">
                        Discover
                        <span class="text-gradient bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                            Amazing
                        </span>
                        Products
                    </h1>
                    <p class="text-xl lg:text-2xl mb-8 text-gray-100 leading-relaxed">
                        Experience the future of shopping with our curated collection of premium products.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('products.index') }}" 
                           class="btn-primary bg-white text-primary-600 hover:bg-gray-100">
                            Shop Now
                        </a>
                        <a href="#featured" 
                           class="btn-secondary border-2 border-white text-white hover:bg-white hover:text-primary-600">
                            Explore Featured
                        </a>
                    </div>
                </div>

                <div class="relative" data-animate>
                    <div class="w-full h-96 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 p-8">
                        <div class="grid grid-cols-2 gap-4 h-full">
                            <div class="space-y-4">
                                <div class="bg-white/20 rounded-lg p-4 animate-float">
                                    <div class="w-12 h-12 bg-white/30 rounded-lg mb-2"></div>
                                    <div class="h-2 bg-white/30 rounded w-3/4"></div>
                                </div>
                                <div class="bg-white/20 rounded-lg p-4 animate-float">
                                    <div class="w-12 h-12 bg-white/30 rounded-lg mb-2"></div>
                                    <div class="h-2 bg-white/30 rounded w-2/3"></div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-white/20 rounded-lg p-4 animate-float">
                                    <div class="w-12 h-12 bg-white/30 rounded-lg mb-2"></div>
                                    <div class="h-2 bg-white/30 rounded w-4/5"></div>
                                </div>
                                <div class="bg-white/20 rounded-lg p-4 animate-float">
                                    <div class="w-12 h-12 bg-white/30 rounded-lg mb-2"></div>
                                    <div class="h-2 bg-white/30 rounded w-1/2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-animate>
                <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-4">
                    Featured Products
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover our handpicked selection of premium products
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="card group" data-animate>
                    <div class="relative overflow-hidden rounded-t-xl">
                        <img src="https://via.placeholder.com/400x300?text={{ urlencode($product->name) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-48 object-cover product-image transition-transform duration-300">
                        
                        @if($product->is_on_sale)
                        <div class="absolute top-2 left-2 bg-accent-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                            -{{ $product->discount_percentage }}%
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                        </h3>
                        
                        <p class="text-sm text-gray-600 mb-4">{{ $product->short_description }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                @if($product->is_on_sale)
                                    <span class="text-lg font-bold text-accent-600">${{ number_format($product->sale_price, 2) }}</span>
                                    <span class="text-sm text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            
                            <button onclick="addToCart({{ $product->id }})"
                                    class="btn-primary text-sm py-2 px-4">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center" data-animate>
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast Shipping</h3>
                    <p class="text-gray-600">Free shipping on orders over $50.</p>
                </div>
                
                <div class="text-center" data-animate>
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality Guarantee</h3>
                    <p class="text-gray-600">All products are carefully selected and tested.</p>
                </div>
                
                <div class="text-center" data-animate>
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Our customer support team is always here to help.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
function addToCart(productId) {
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('.cart-count').textContent = data.cart_count;
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        document.body.removeChild(notification);
    }, 3000);
}
</script> 