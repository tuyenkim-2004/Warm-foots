//  const quantityInput = document.getElementById('quantity');
//     let quantity = 1;

//     document.getElementById('increase').addEventListener('click', () => {
//         quantity++;
//         quantityInput.value = quantity;
//     });

//     document.getElementById('decrease').addEventListener('click', () => {
//         console.log("njvgg")
//         if (quantity > 1) {
//             quantity--;
//             quantityInput.value = quantity;
//         }
//     });
const deleteFromCart = (productid, cartid) => {
    window.location.href = `/Warm-foots/ShoppingCartController/removeToCart?proId=${productid}&cartId=${cartid}`;
};


document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các nhóm quantity-controls
    const quantityControls = document.querySelectorAll('.quantity-controls');

    quantityControls.forEach(control => {
        // Lấy các thành phần liên quan trong control
        const decreaseBtn = control.querySelector('#decrease');
        const increaseBtn = control.querySelector('#increase');
        const quantityInput = control.querySelector('#quantity');

        // Sự kiện cho nút giảm
        decreaseBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Sự kiện cho nút tăng
        increaseBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
        });
    });
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
