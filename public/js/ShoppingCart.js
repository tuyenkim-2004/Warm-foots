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
// const deleteFromCart = (productid, cartid) => {
//     window.location.href = `/Warm-foots/ShoppingCartController/removeToCart?proId=${productid}&cartId=${cartid}`;
// };


document.addEventListener('DOMContentLoaded', function () {
    // Tăng/giảm số lượng sản phẩm
    const quantityControls = document.querySelectorAll('.quantity-controls');

    quantityControls.forEach(control => {
        const decreaseBtn = control.querySelector('#decrease');
        const increaseBtn = control.querySelector('#increase');
        const quantityInput = control.querySelector('#quantity');

        // Sự kiện nút giảm
        decreaseBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value, 10) || 1;
            if (currentValue > 1) {
                const newValue = currentValue - 1;
                quantityInput.value = newValue;
                updateCartQuantity(control.closest('tr'), newValue); // Gửi yêu cầu cập nhật số lượng
            }
        });

        // Sự kiện nút tăng
        increaseBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value, 10) || 1;
            const newValue = currentValue + 1;
            quantityInput.value = newValue;
            updateCartQuantity(control.closest('tr'), newValue); // Gửi yêu cầu cập nhật số lượng
        });
    });

    // Xóa sản phẩm
    document.querySelectorAll('.icon-delete').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const productId = row.getAttribute('data-product-id');
            const cartId = row.getAttribute('data-cart-id');
    
            if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
                deleteFromCart(productId, cartId)
                    .then(() => {
                        row.remove(); // Xóa sản phẩm khỏi giao diện
                        return getTotalPrice(); // Lấy tổng giá trị mới
                    })
                    .then(totalPrice => {
                        updateTotalPrice(totalPrice); // Cập nhật tổng giá trị hiển thị
                    })
                    .catch(error => {
                        alert('Có lỗi xảy ra khi xóa sản phẩm: ' + error.message);
                    });
            }
        });
    });
    
});
const deleteFromCart = (productId, cartId) => {
    return fetch(`/Warm-foots/ShoppingCartController/removeToCart?proId=${productId}&cartId=${cartId}`, {
        method: 'GET',
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to delete item');
            }
            return response.json();
        })
        .then(data => {
            if (data.status !== 'success') {
                throw new Error(data.message);
            }
        });
};
// Hàm cập nhật số lượng sản phẩm trong giỏ hàng
function updateQuantity(button, change) {
    const row = button.closest('.quantity-controls'); // Lấy dòng chứa thông tin sản phẩm
    const quantityInput = row.querySelector('.quantity-display'); // Input hiển thị số lượng
    let currentQuantity = parseInt(quantityInput.value, 10); // Số lượng hiện tại

    // Tính toán số lượng mới
    const newQuantity = currentQuantity + change;

    // Không cho phép số lượng nhỏ hơn 1
    if (newQuantity < 1) return;

    // Cập nhật số lượng hiển thị trong giao diện
    quantityInput.value = newQuantity;

    // Gọi hàm gửi yêu cầu cập nhật số lượng lên server
    updateCartQuantity(row, newQuantity);
}

// Hàm gửi yêu cầu cập nhật số lượng sản phẩm
const updateCartQuantity = (row, quantity) => {
    const productId = row.getAttribute('data-product-id'); // Lấy product_id từ thuộc tính HTML
    const cartId = row.getAttribute('data-cart-id'); // Lấy cart_id từ thuộc tính HTML

    // Gửi yêu cầu đến server
    fetch('/Warm-foots/ShoppingCartController/updateQuantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&cart_id=${cartId}&quantity=${quantity}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateTotalPrice(data.totalPrice); // Cập nhật giá trị tổng trong giao diện
            } else {
                alert('Có lỗi xảy ra khi cập nhật số lượng: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
            alert('Không thể cập nhật số lượng. Thử lại sau.');
        });
};
const getTotalPrice = () => {
    return fetch('/Warm-foots/ShoppingCartController/getTotalPrice', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                return data.totalPrice; // Trả về tổng giá trị nếu thành công
            } else {
                throw new Error('Failed to get total price: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching total price:', error);
            return null; // Trả về null nếu có lỗi
        });
};


// Hàm cập nhật giá trị tổng trong giao diện
const updateTotalPrice = (newTotalPrice) => {
    const totalElement = document.querySelector('.total'); // Chọn phần tử hiển thị giá tổng
    totalElement.textContent = `$${newTotalPrice}`; // Cập nhật giá trị mới
};



    document.querySelectorAll('.icon-delete').forEach(button => {
        button.addEventListener('click', function() {
            // Xóa hàng chứa nút delete
            const row = this.closest('tr');
            if (row) {
                row.remove();
                
            }
        });
    });
