document.getElementById('navbar-icon').addEventListener('click', function() {
    const leftPanel = document.getElementById('left-panel');
    const logo = document.getElementById('logo');

    logo.classList.toggle('hidden'); // Ẩn logo
    leftPanel.classList.toggle('narrow'); // Thu nhỏ phần bên trái
});