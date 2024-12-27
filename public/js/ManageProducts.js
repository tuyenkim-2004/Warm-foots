const editProductModal = document.getElementById('editProductModal');

editProductModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Nút đã được nhấn

    // Lấy thông tin từ nút
    const productId = button.getAttribute('data-id'); // Lưu product_id vào biến
    const productName = button.getAttribute('data-name');
    const productPrice = button.getAttribute('data-price');
    const productQuantity = button.getAttribute('data-quantity');
    const productBrand = button.getAttribute('data-brand');
    const productImage = button.getAttribute('data-image');

    // Điền thông tin vào các ô input
    editProductModal.querySelector('#product_id').value = productId; // Cập nhật product_id
    editProductModal.querySelector('#product_name').value = productName;
    editProductModal.querySelector('#product_price').value = productPrice;
    editProductModal.querySelector('#product_quantity').value = productQuantity;
    editProductModal.querySelector('#product_brand').value = productBrand;
    editProductModal.querySelector('#product_image').value = productImage;
});