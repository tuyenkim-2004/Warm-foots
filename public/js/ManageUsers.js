 document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll('.edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                const email = this.getAttribute('data-email');
                const password = this.getAttribute('data-password'); 

                document.getElementById('user_id').value = userId;
                document.getElementById('username').value = username;
                document.getElementById('email').value = email;
                document.getElementById('password').value = password;
            });
        });
    });