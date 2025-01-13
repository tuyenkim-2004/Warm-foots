const quantityInput = document.querySelector(".quantity-display");
    let quantity = 1;

    document.getElementById('increase').addEventListener('click', () => {
        quantity++;
        quantityInput.value = quantity;
        document.getElementById("quantityInCart").value = quantityInput.value;
    });

    document.getElementById('decrease').addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
            document.getElementById("quantityInCart").value = quantityInput.value;
        }
    });