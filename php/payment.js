document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('paymentForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission
        if (validateForm()) {
            this.submit(); // If form is valid, submit it
        }
    });

    // Format card number with space after every 4 digits
    document.getElementById('card_number').addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
        this.value = value;
    });

    // Format expiry date with slash after month
    document.getElementById('expiry').addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/^(\d{2})(\d{0,4})$/, '$1/$2');
        this.value = value;
    });

    // Allow only numeric input for CVV
    document.getElementById('cvv').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 3);
    });
});

function validateForm() {
    var cardNumber = document.getElementById('card_number').value;
    var expiry = document.getElementById('expiry').value;
    var cvv = document.getElementById('cvv').value;

    // Basic validation for card number, expiry, and CVV
    if (cardNumber.length !== 19) {
        alert('Please enter a valid 16-digit card number.');
        return false;
    }
    if (!/^\d{2}\/\d{4}$/.test(expiry)) {
        alert('Please enter a valid expiry date (MM/YYYY).');
        return false;
    }
    if (cvv.length !== 3) {
        alert('Please enter a valid 3-digit CVV.');
        return false;
    }
    return true;
}