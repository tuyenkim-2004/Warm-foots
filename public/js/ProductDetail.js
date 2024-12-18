 const quantityInput = document.getElementById('quantity');
    let quantity = 1;

    document.getElementById('increase').addEventListener('click', () => {
        quantity++;
        quantityInput.value = quantity;
    });

    document.getElementById('decrease').addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
        }
    });