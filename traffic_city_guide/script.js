document.getElementById('updateTrafficBtn').addEventListener('click', function() {
    let location = prompt("Enter a location to view traffic:");
    if (location) {
        document.getElementById('traffic-map-frame').src = `https://www.google.com/maps/embed/v1/traffic?key=YOUR_GOOGLE_MAPS_API_KEY&q=${location}`;
    }
});

const priceRange = document.getElementById('price-range');
const priceValue = document.getElementById('price-value');

priceRange.addEventListener('input', function() {
    priceValue.textContent = `Price: $${priceRange.value} - $1,000,000`;
});

const diningPriceRange = document.getElementById('dining-price-range');
const diningPriceValue = document.getElementById('dining-price-value');

diningPriceRange.addEventListener('input', function() {
    diningPriceValue.textContent = `Price: $${diningPriceRange.value} - $200`;
});

document.getElementById('searchHousingBtn').addEventListener('click', function() {
    const location = document.getElementById('location').value;
    const price = priceRange.value;
    const bedrooms = document.getElementById('bedrooms').value;

    const housingListings = [
        { name: 'Luxury Apartment in Downtown', price: 850000, bedrooms: 2, image: 'house1.jpg' },
        { name: 'Cozy Studio in Suburb', price: 450000, bedrooms: 1, image: 'house2.jpg' },
        { name: 'Family Home in Uptown', price: 650000, bedrooms: 3, image: 'house3.jpg' },
    ];

    const filteredListings = housingListings.filter(listing => listing.price <= price && listing.bedrooms == bedrooms);

    let listingsHTML = '';
    filteredListings.forEach(listing => {
        listingsHTML += `
            <div class="listing">
                <img src="${listing.image}" alt="${listing.name}" class="listing-img">
                <div class="listing-info">
                    <h3>${listing.name}</h3>
                    <p>$${listing.price} | ${listing.bedrooms} Bedrooms</p>
                    <a href="#">View Listing</a>
                </div>
            </div>
        `;
    });

    document.getElementById('housing-options').innerHTML = listingsHTML;
});

document.getElementById('searchDiningBtn').addEventListener('click', function() {
    const cuisine = document.getElementById('cuisine').value;
    const price = diningPriceRange.value;
    const rating = document.getElementById('rating').value;

    const diningListings = [
        { name: 'La Bella Italia', cuisine: 'italian', price: 50, rating: 4.5, image: 'restaurant1.jpg' },
        { name: 'Curry House', cuisine: 'indian', price: 30, rating: 4.2, image: 'restaurant2.jpg' },
        { name: 'Sushi World', cuisine: 'chinese', price: 70, rating: 4.7, image: 'restaurant3.jpg' },
    ];

    const filteredDining = diningListings.filter(restaurant => restaurant.price <= price && restaurant.rating >= rating && restaurant.cuisine === cuisine);

    let diningHTML = '';
    filteredDining.forEach(restaurant => {
        diningHTML += `
            <div class="restaurant">
                <img src="${restaurant.image}" alt="${restaurant.name}" class="restaurant-img">
                <div class="restaurant-info">
                    <h3>${restaurant.name}</h3>
                    <p>${restaurant.cuisine} | $${restaurant.price}</p>
                    <p>Rating: ${restaurant.rating}/5</p>
                    <a href="#">View Details</a>
                </div>
            </div>
        `;
    });

    document.getElementById('dining-options').innerHTML = diningHTML;
});
