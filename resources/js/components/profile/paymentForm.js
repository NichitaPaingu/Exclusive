export function formatCard(){
    const cardNumberInput = document.getElementById('card_number');
    const expiryDateInput = document.getElementById('expiry_date');
    const cvvInput = document.getElementById('cvv');

    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', formatCardNumber);
    }
    if (expiryDateInput) {
        expiryDateInput.addEventListener('input', formatExpiryDate);
    }
    if (cvvInput) {
        cvvInput.addEventListener('input', formatCVV);
    }
};

function formatCardNumber(event) {
    const input = event.target;
    let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    if (value.length > 16) {
        value = value.slice(0, 16);
    }
    const formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    input.value = formattedValue;
}

function formatExpiryDate(event) {
    const input = event.target;
    let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    if (value.length > 4) {
        value = value.slice(0, 4);
    }
    const month = value.slice(0, 2);
    const year = value.slice(2);
    if (parseInt(month, 10) > 12) {
        value = `12${year}`;
    }
    const formattedValue = value.replace(/(\d{2})(?=\d)/g, '$1/');
    input.value = formattedValue;
}

function formatCVV(event) {
    const input = event.target;
    let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    if (value.length > 3) {
        value = value.slice(0, 3);
    }
    input.value = value;
}
