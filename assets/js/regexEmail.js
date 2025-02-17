        // JS za pravilan unos Email-a
        function validateEmail() {
            const emailField = document.getElementById('email-register');
            const email = emailField.value;
            const emailRegex = /[a-zA-z0-9]+\@[a-zA-z0-9]+\.[a-zA-z0-9]{1,3}/;
            return emailRegex.test(email);
        }

        // Validira da vidi da li je dobro uneto
        function validateForm(event) {
            const emailField = document.getElementById('email-register');
            const errorField = document.getElementById('email-error');

            if (!validateEmail()) {
                errorField.textContent = 'Please enter a valid email address';
                event.preventDefault();
            } else {
                errorField.textContent = '';
            }
        }