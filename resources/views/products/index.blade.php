@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8" data-animate>
            <h1 class="text-3xl font-display font-bold text-gray-900 mb-2">All Products</h1>
            <p class="text-gray-600">Discover our amazing collection of products</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
                    
                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Categories</h4>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                            <label class="flex items-center">
                                <input type="checkbox" name="category" value="{{ $category->slug }}" 
                                       class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                                       onchange="applyFilters()">
                                <span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Price Range</h4>
                        <div class="space-y-2">
                            <input type="number" id="min_price" placeholder="Min Price" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                            <input type="number" id="max_price" placeholder="Max Price" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Sort By</h4>
                        <select id="sort" onchange="applyFilters()" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                            <option value="latest">Latest</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                            <option value="name">Name: A to Z</option>
                            <option value="popular">Most Popular</option>
                        </select>
                    </div>

                    <!-- Clear Filters -->
                    <button onclick="clearFilters()" 
                            class="w-full btn-secondary text-sm py-2">
                        Clear Filters
                    </button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <!-- Search Bar -->
                <div class="mb-6" data-animate>
                    <form action="{{ route('products.search') }}" method="GET" class="flex gap-4">
                        <div class="flex-1">
                            <input type="text" name="q" value="{{ request('q') }}" 
                                   placeholder="Search products..." 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        <button type="submit" class="btn-primary px-6">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Results Count -->
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-gray-600">
                        Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} 
                        of {{ $products->total() }} products
                    </p>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
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
                            
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-50 transition-colors duration-200"
                                        onclick="addToCart({{ $product->id }})">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $product->rating)
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500 ml-1">({{ $product->review_count }})</span>
                                </div>
                            </div>
                            
                            <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors duration-200">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $product->short_description }}</p>
                            
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

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
                @else
                <div class="text-center py-12" data-animate>
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function applyFilters() {
    const categories = Array.from(document.querySelectorAll('input[name="category"]:checked'))
        .map(cb => cb.value);
    const minPrice = document.getElementById('min_price').value;
    const maxPrice = document.getElementById('max_price').value;
    const sort = document.getElementById('sort').value;

    const params = new URLSearchParams();
    
    if (categories.length > 0) {
        params.append('category', categories[0]); // For simplicity, using first category
    }
    if (minPrice) params.append('min_price', minPrice);
    if (maxPrice) params.append('max_price', maxPrice);
    if (sort) params.append('sort', sort);

    window.location.href = '{{ route("products.index") }}?' + params.toString();
}

function clearFilters() {
    window.location.href = '{{ route("products.index") }}';
}

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
@endsection 