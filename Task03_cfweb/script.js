// ============================================
// TASK03: CAFE WEBSITE - JAVASCRIPT FEATURES
// ============================================

// ============================================
// 1. VARIABLES SECTION
// ============================================

// Using const for values that won't change
const CAFE_NAME = "Brew Haven Cafe";
const OPENING_HOUR = "6:00 AM";
const CLOSING_HOUR = "10:00 PM";
const CAFE_LOCATION = "123 Coffee Street";

// Using let for values that will change
let dailyOrders = 0;
let cafeRating = 4.8;
let isOpen = true;

// Display initial variable values on page load
window.addEventListener('DOMContentLoaded', function() {
    displayVariables();
    setupEventListeners();
});

// Function to display variables on webpage
function displayVariables() {
    document.getElementById('cafeName').textContent = CAFE_NAME;
    document.getElementById('dailyOrders').textContent = dailyOrders;
    document.getElementById('rating').textContent = cafeRating.toFixed(1) + " ⭐";
    document.getElementById('hours').textContent = `${OPENING_HOUR} - ${CLOSING_HOUR}`;
    
    // Log variables to console (Mandatory Coverage)
    console.log("=== VARIABLES SECTION ===");
    console.log("Using const (cannot reassign):");
    console.log("CAFE_NAME:", CAFE_NAME);
    console.log("OPENING_HOUR:", OPENING_HOUR);
    console.log("CLOSING_HOUR:", CLOSING_HOUR);
    console.log("\nUsing let (can reassign):");
    console.log("dailyOrders:", dailyOrders);
    console.log("cafeRating:", cafeRating);
    console.log("isOpen:", isOpen);
}

// Function to increment orders (demonstrating let reassignment)
function incrementOrders() {
    dailyOrders++; // Reassigning let variable
    displayVariables();
    alert(`Order #${dailyOrders} processed! Thank you for your purchase!`);
}

// Function to update rating (demonstrating let reassignment)
function updateRating() {
    cafeRating = (Math.random() * 0.5 + 4.5).toFixed(1); // New rating between 4.5-5.0
    displayVariables();
    alert(`Rating updated to ${cafeRating} ⭐`);
}

// Attempting to reassign const (Test Case - will cause error)
function testConstReassignment() {
    console.log("\n=== TESTING CONST REASSIGNMENT ===");
    console.log("Attempting to reassign CAFE_NAME (const)...");
    try {
        CAFE_NAME = "New Name"; // This will fail
    } catch (error) {
        console.error("❌ Error: Cannot reassign const variable", error);
    }
    console.log("✅ const prevents reassignment - this is working correctly!");
    alert("Check console (F12) to see const reassignment attempt!");
}

// ============================================
// 2. FUNCTIONS SECTION
// ============================================

// Menu pricing data
const menuPrices = {
    espresso: 3.50,
    latte: 4.50,
    cappuccino: 5.00,
    pastry: 3.00
};

// Function Declaration - Basic calculation
function getItemPrice(item) {
    return menuPrices[item] || 0;
}

// Function Expression - Calculate total with quantity
const calculateTotalPrice = function(item, quantity) {
    const price = getItemPrice(item);
    return price * quantity;
};

// Arrow Function - Apply discount
const applyDiscountArrow = (total) => {
    return (total * 0.9).toFixed(2); // 10% discount
};

// Arrow Function with multiple operations
const getItemDetails = (item) => {
    const price = getItemPrice(item);
    const itemName = item.charAt(0).toUpperCase() + item.slice(1);
    return { name: itemName, price: price };
};

// Function to calculate and display total
function calculateTotal() {
    const selectedItem = document.getElementById('menuSelect').value;
    const quantity = parseInt(document.getElementById('quantity').value) || 1;

    if (!selectedItem) {
        alert("Please select an item from the menu!");
        return;
    }

    // Using function declaration
    const itemPrice = getItemPrice(selectedItem);
    
    // Using function expression
    const total = calculateTotalPrice(selectedItem, quantity);

    const resultBox = document.getElementById('priceResult');
    resultBox.innerHTML = `
        <strong>Order Summary:</strong><br>
        Item: ${selectedItem.toUpperCase()}<br>
        Price per item: $${itemPrice.toFixed(2)}<br>
        Quantity: ${quantity}<br>
        <strong>Total: $${total.toFixed(2)}</strong>
    `;
    resultBox.classList.add('active');

    console.log("=== FUNCTIONS SECTION ===");
    console.log("Function Declaration (getItemPrice):", itemPrice);
    console.log("Function Expression (calculateTotalPrice):", total);
    console.log("Item details:", getItemDetails(selectedItem));
}

// Function using arrow function for discount
function applyDiscount() {
    const selectedItem = document.getElementById('menuSelect').value;
    const quantity = parseInt(document.getElementById('quantity').value) || 1;

    if (!selectedItem) {
        alert("Please select an item first!");
        return;
    }

    const total = calculateTotalPrice(selectedItem, quantity);
    const discountedTotal = applyDiscountArrow(total); // Arrow function call

    const resultBox = document.getElementById('priceResult');
    resultBox.innerHTML = `
        <strong>Order with 10% Discount:</strong><br>
        Original Total: $${total.toFixed(2)}<br>
        Discount (10%): -$${(total - discountedTotal).toFixed(2)}<br>
        <strong>Final Price: $${discountedTotal}</strong>
    `;
    resultBox.classList.add('active');

    console.log("Arrow Function (applyDiscountArrow):", discountedTotal);
}

// ============================================
// 3. OBJECTS & METHODS SECTION
// ============================================

// Customer object
let currentCustomer = null;

// Function to create a customer object with methods
function createCustomer() {
    const name = document.getElementById('customerName').value;
    const drink = document.getElementById('favoriteDrink').value;
    const points = parseInt(document.getElementById('loyaltyPoints').value) || 0;

    if (!name || !drink) {
        alert("Please fill in all fields!");
        return;
    }

    // Creating a customer object with properties and methods
    currentCustomer = {
        // Properties
        name: name,
        favoriteDrink: drink,
        loyaltyPoints: points,
        memberSince: new Date().getFullYear(),

        // Method 1: Update customer information using this keyword
        updateProfile: function(newDrink) {
            this.favoriteDrink = newDrink;
            console.log(`${this.name}'s favorite drink updated to ${newDrink}`);
            return `Profile updated! New favorite: ${newDrink}`;
        },

        // Method 2: Add loyalty points using this keyword
        addPoints: function(pointsToAdd) {
            this.loyaltyPoints += pointsToAdd;
            return `${pointsToAdd} points added! Total: ${this.loyaltyPoints} points`;
        },

        // Method 3: Get customer summary using this keyword
        getSummary: function() {
            return `Name: ${this.name}\nFavorite Drink: ${this.favoriteDrink}\nLoyalty Points: ${this.loyaltyPoints}\nMember Since: ${this.memberSince}`;
        },

        // Method 4: Calculate discount based on points
        getDiscount: function() {
            if (this.loyaltyPoints >= 100) return 20; // 20% discount
            if (this.loyaltyPoints >= 50) return 10;  // 10% discount
            return 0;
        },

        // Method 5: Triggered by user event
        placeOrder: function(item) {
            const discount = this.getDiscount();
            return `Order placed by ${this.name}!\nItem: ${item}\nDiscount: ${discount}%`;
        }
    };

    const resultBox = document.getElementById('customerResult');
    resultBox.innerHTML = `
        <strong>✅ Customer Profile Created!</strong><br>
        Name: ${currentCustomer.name}<br>
        Favorite Drink: ${currentCustomer.favoriteDrink}<br>
        Loyalty Points: ${currentCustomer.loyaltyPoints}<br>
        Member Since: ${currentCustomer.memberSince}
    `;
    resultBox.classList.add('active');

    console.log("=== OBJECTS & METHODS SECTION ===");
    console.log("Customer Object:", currentCustomer);
    console.log("Using 'this' keyword in methods - Profile Summary:");
    console.log(currentCustomer.getSummary());
}

// Function to add loyalty points (method triggered by event)
function addLoyaltyPoints() {
    if (!currentCustomer) {
        alert("Please create a customer profile first!");
        return;
    }

    const message = currentCustomer.addPoints(10);
    const resultBox = document.getElementById('customerResult');
    resultBox.innerHTML = `<strong>✅ ${message}</strong>`;
    resultBox.classList.add('active');

    console.log("Method (addPoints) triggered by user event");
    console.log("Updated customer:", currentCustomer);
}

// Function to display customer summary
function displayCustomerSummary() {
    if (!currentCustomer) {
        alert("Please create a customer profile first!");
        return;
    }

    const discount = currentCustomer.getDiscount();
    const summary = currentCustomer.getSummary();

    const resultBox = document.getElementById('customerResult');
    resultBox.innerHTML = `
        <strong>📋 Customer Summary:</strong><br>
        <pre>${summary}</pre>
        Eligible Discount: ${discount}%
    `;
    resultBox.classList.add('active');
}

// ============================================
// 4. POP-UP BOXES SECTION
// ============================================

// Alert Pop-up - Display notification
function showAlertPromotion() {
    const discount = Math.floor(Math.random() * 30) + 10; // Random discount 10-40%
    alert(`🎉 SPECIAL OFFER!\n\n${discount}% OFF on all beverages today!\n\nValid from 2PM to 4PM`);
    
    const resultBox = document.getElementById('popupResult');
    resultBox.innerHTML = `<strong>✅ Alert shown:</strong> ${discount}% discount notification`;
    resultBox.classList.add('active');

    console.log("=== POP-UP BOXES SECTION ===");
    console.log("alert() used for promotion notification");
}

// Confirm Pop-up - Yes/No decision
function showConfirmBooking() {
    const userResponse = confirm("Would you like to book a table for 2 people tomorrow at 7:00 PM?");
    
    const resultBox = document.getElementById('popupResult');
    if (userResponse) {
        resultBox.innerHTML = `
            <strong>✅ Booking Confirmed!</strong><br>
            Your table has been reserved for 2 people.<br>
            Date: Tomorrow<br>
            Time: 7:00 PM<br>
            Confirmation code: #BR${Math.floor(Math.random() * 10000)}
        `;
    } else {
        resultBox.innerHTML = `<strong>❌ Booking Cancelled</strong><br>You can book anytime through our website.`;
    }
    resultBox.classList.add('active');

    console.log("confirm() used for table booking decision");
    console.log("User Response:", userResponse);
}

// Prompt Pop-up - Get user input
function showPromptFeedback() {
    const feedback = prompt("How would you rate your experience at Brew Haven Cafe?\n\nPlease enter a comment:");
    
    const resultBox = document.getElementById('popupResult');
    if (feedback !== null && feedback.trim() !== "") {
        resultBox.innerHTML = `
            <strong>✅ Thank you for your feedback!</strong><br>
            Your comment: "${feedback}"<br>
            We appreciate your feedback and will use it to improve our service!
        `;
    } else if (feedback === null) {
        resultBox.innerHTML = `<strong>❌ Feedback cancelled</strong><br>You can share your feedback anytime!`;
    } else {
        resultBox.innerHTML = `<strong>⚠️ Please enter a comment</strong><br>Your feedback is valuable to us!`;
    }
    resultBox.classList.add('active');

    console.log("prompt() used for user feedback input");
    console.log("User Feedback:", feedback);
}

// ============================================
// 5. EVENTS SECTION
// ============================================

function setupEventListeners() {
    // CLICK EVENT
    document.getElementById('clickBtn').addEventListener('click', function() {
        let clickCount = parseInt(this.dataset.clicks || 0) + 1;
        this.dataset.clicks = clickCount;
        
        const result = document.getElementById('clickResult');
        result.textContent = `✅ You've clicked ${clickCount} time(s)! Order #${clickCount} is being prepared... ☕`;
    });

    // HOVER EVENT (mouseover and mouseout)
    const hoverBox = document.getElementById('hoverBox');
    const hoverResult = document.getElementById('hoverResult');
    
    hoverBox.addEventListener('mouseover', function() {
        this.textContent = "🎉 Special Menu: Mocha, Iced Latte, Macchiato, Seasonal Blends!";
        hoverResult.textContent = "✅ Mouse entered - Special menu revealed!";
        hoverResult.style.color = "#8b4513";
    });

    hoverBox.addEventListener('mouseout', function() {
        this.textContent = "Hover over me to reveal the special menu!";
        hoverResult.textContent = "Mouse left the area";
        hoverResult.style.color = "#999";
    });

    // INPUT EVENT
    document.getElementById('searchInput').addEventListener('input', function(event) {
        const searchTerm = event.target.value.toLowerCase();
        const menuItems = ['espresso', 'latte', 'cappuccino', 'pastry', 'mocha', 'croissant', 'muffin'];
        
        let results = menuItems.filter(item => item.includes(searchTerm));
        
        const resultBox = document.getElementById('inputResult');
        if (searchTerm === '') {
            resultBox.textContent = 'Search results will appear here...';
        } else if (results.length > 0) {
            resultBox.innerHTML = `<strong>Found ${results.length} result(s):</strong> ${results.join(', ')}`;
        } else {
            resultBox.textContent = '❌ No items found matching "' + searchTerm + '"';
        }
    });

    // DOUBLE-CLICK EVENT
    document.getElementById('dblClickBtn').addEventListener('dblclick', function() {
        const surprises = [
            '🎁 Free Coffee with your next order!',
            '🎉 Buy 1 Get 1 Free on pastries!',
            '⭐ 50 Bonus Loyalty Points!',
            '🍰 Free dessert with any drink!',
            '☕ 2 hours of free WiFi + Charging!'
        ];
        
        const randomSurprise = surprises[Math.floor(Math.random() * surprises.length)];
        const resultBox = document.getElementById('dblClickResult');
        resultBox.innerHTML = `<strong>🎊 SURPRISE! 🎊</strong><br>${randomSurprise}`;
    });

    // CHANGE EVENT
    document.getElementById('menuSelect').addEventListener('change', function() {
        if (this.value) {
            const details = getItemDetails(this.value);
            console.log("Menu item selected:", details);
        }
    });

    // KEY PRESS EVENT
    document.getElementById('loyaltyPoints').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            createCustomer();
        }
    });

    console.log("=== EVENTS SECTION ===");
    console.log("All event listeners have been set up:");
    console.log("✓ Click event - Multiple button clicks");
    console.log("✓ Hover event (mouseover/mouseout) - Menu reveal");
    console.log("✓ Input event - Search functionality");
    console.log("✓ Double-click event - Surprise rewards");
    console.log("✓ Change event - Menu selection");
    console.log("✓ Key Press event - Enter to submit");
}

// ============================================
// ADDITIONAL INTERACTIVE FUNCTIONS
// ============================================

// Welcome message using function
function showWelcome() {
    const welcomeBox = document.getElementById('welcomeMessage');
    const hour = new Date().getHours();
    let greeting = '';

    if (hour < 12) {
        greeting = 'Good Morning! ☀️ Start your day with our freshly brewed coffee!';
    } else if (hour < 18) {
        greeting = 'Good Afternoon! ☕ Take a break and enjoy our cozy cafe.';
    } else {
        greeting = 'Good Evening! 🌙 Relax with our premium beverages.';
    }

    welcomeBox.innerHTML = `
        <h2>${greeting}</h2>
        <p>Welcome to ${CAFE_NAME}</p>
        <p>Open Daily: ${OPENING_HOUR} - ${CLOSING_HOUR}</p>
    `;
    welcomeBox.classList.add('active');
}

// Update cafe status
function updateCafeStatus() {
    isOpen = !isOpen;
    alert(`Cafe is now ${isOpen ? 'OPEN ✅' : 'CLOSED ❌'}`);
}

// Open menu (simple function)
function openMenu() {
    alert(`
BREW HAVEN CAFE MENU
====================
☕ Espresso - $3.50
☕ Latte - $4.50
☕ Cappuccino - $5.00
☕ Mocha - $5.50
🍰 Pastry - $3.00
🥐 Croissant - $3.50
🧁 Muffin - $2.50

Try our Features section for interactive ordering!
    `);
}

// Log final initialization message
console.log("\n🎉 Brew Haven Cafe - JavaScript Features Ready!");
console.log("All 5 main sections are active:");
console.log("1. ✓ Variables (let & const)");
console.log("2. ✓ Functions (declaration, expression, arrow)");
console.log("3. ✓ Objects & Methods (with 'this' keyword)");
console.log("4. ✓ Pop-up Boxes (alert, confirm, prompt)");
console.log("5. ✓ Events (click, hover, input, double-click, change, keypress)");
console.log("\nScroll down to explore each section and interact with the features!");
