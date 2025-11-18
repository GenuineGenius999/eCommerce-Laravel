import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

// Make Alpine available globally
window.Alpine = Alpine;

// Register Alpine plugins
Alpine.plugin(focus);
Alpine.plugin(collapse);

// Start Alpine
Alpine.start();

// Custom animations and interactions
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with data-animate attribute
    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Parallax effect for hero section
    const hero = document.querySelector('.hero-parallax');
    if (hero) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            hero.style.transform = `translateY(${rate}px)`;
        });
    }

    // Product image hover effects
    document.querySelectorAll('.product-image').forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Cart counter animation
    const cartCounter = document.querySelector('.cart-counter');
    if (cartCounter) {
        cartCounter.addEventListener('animationend', function() {
            this.classList.remove('animate-bounce-in');
        });
    }
});

// Shopping cart functionality
window.cart = {
    items: [],
    total: 0,
    
    addItem(product) {
        const existingItem = this.items.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.items.push({
                ...product,
                quantity: 1
            });
        }
        
        this.updateTotal();
        this.updateCartUI();
        this.animateCartCounter();
    },
    
    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.updateTotal();
        this.updateCartUI();
    },
    
    updateQuantity(productId, quantity) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(0, quantity);
            if (item.quantity === 0) {
                this.removeItem(productId);
            }
        }
        this.updateTotal();
        this.updateCartUI();
    },
    
    updateTotal() {
        this.total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },
    
    updateCartUI() {
        const cartCount = document.querySelector('.cart-count');
        const cartTotal = document.querySelector('.cart-total');
        
        if (cartCount) {
            const totalItems = this.items.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
        }
        
        if (cartTotal) {
            cartTotal.textContent = `$${this.total.toFixed(2)}`;
        }
    },
    
    animateCartCounter() {
        const counter = document.querySelector('.cart-counter');
        if (counter) {
            counter.classList.add('animate-bounce-in');
        }
    }
};

// Search functionality
window.search = {
    query: '',
    results: [],
    
    async searchProducts(query) {
        this.query = query;
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 300));
        
        // Mock results - in real app, this would be an API call
        this.results = [
            { id: 1, name: 'Premium Wireless Headphones', price: 199.99, image: '/images/headphones.jpg' },
            { id: 2, name: 'Smart Fitness Watch', price: 299.99, image: '/images/watch.jpg' },
            { id: 3, name: 'Ultra HD Camera', price: 599.99, image: '/images/camera.jpg' }
        ].filter(product => 
            product.name.toLowerCase().includes(query.toLowerCase())
        );
    }
}; 