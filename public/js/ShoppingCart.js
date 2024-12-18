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


    document.querySelectorAll('.icon-delete').forEach(button => {
        button.addEventListener('click', function() {
            // Xóa hàng chứa nút delete
            const row = this.closest('tr');
            if (row) {
                row.remove();
            }
        });
    });
