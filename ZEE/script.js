document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    let cart = [];

    // Check if there's an existing cart in local storage
    const savedCart = localStorage.getItem("cart");
    if (savedCart) {
        cart = JSON.parse(savedCart);
        displayCart();
    }

    // Add product to cart
    addToCartButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const name = button.getAttribute("data-name");
            const price = parseFloat(button.getAttribute("data-price"));
            const item = { name, price };
            cart.push(item);

            // Save the updated cart to local storage
            localStorage.setItem("cart", JSON.stringify(cart));

            displayCart();
        });
    });

    // Display cart items and update total
    function displayCart() {
        cartItems.innerHTML = "";
        let total = 0;
        cart.forEach((item) => {
            const li = document.createElement("li");
            li.innerText = `${item.name} - $${item.price.toFixed(2)}`;
            cartItems.appendChild(li);
            total += item.price;
        });
        cartTotal.innerText = total.toFixed(2);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const notification = document.getElementById("notification");

    let cart = [];

    // Check if there's an existing cart in local storage
    const savedCart = localStorage.getItem("cart");
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }

    // Function to show and hide the notification
    function showNotification() {
        notification.style.display = "block";
        setTimeout(() => {
            notification.classList.add("show");
            setTimeout(() => {
                notification.classList.remove("show");
                setTimeout(() => {
                    notification.style.display = "none";
                }, 1000);
            }, 3000);
        }, 100);
    }

    // Add product to cart
    addToCartButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const name = button.getAttribute("data-name");
            const price = parseFloat(button.getAttribute("data-price"));
            const item = { name, price };
            cart.push(item);

            // Save the updated cart to local storage
            localStorage.setItem("cart", JSON.stringify(cart));

            // Show the notification
            showNotification();
        });
    });
});
