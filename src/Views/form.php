<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Form</title>
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input/build/css/intlTelInput.css">
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input/build/js/intlTelInput.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Lead Form</h1>

    <form id="leadForm" action="/submit" method="post">
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
            <div id="firstNameError" class="text-danger" style="display: none;">Please enter a valid first name (only letters, including Cyrillic).</div>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
            <div id="lastNameError" class="text-danger" style="display: none;">Please enter a valid last name (only letters, including Cyrillic).</div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
            <div id="phoneError" class="text-danger" style="display: none;">Please enter a valid phone number (e.g. +1234567890).</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div id="emailError" class="text-danger" style="display: none;">Please enter a valid email address.</div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>

    <div class="text-center mt-3">
        <a href="/statuses" class="btn btn-secondary">View Statuses</a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const phoneInput = document.getElementById("phone");
        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function (callback) {
                fetch('https://ipinfo.io/json?')
                    .then(response => response.json())
                    .then(data => callback(data.country ? data.country : 'us'))
                    .catch(() => callback('us'));
            },
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input/build/js/utils.js"
        });

        document.getElementById("leadForm").addEventListener("submit", function(event) {
            let valid = true;

            const firstName = document.getElementById("firstName");
            const lastName = document.getElementById("lastName");
            const nameRegex = /^[A-Za-zА-Яа-яІіЇїЄєҐґ]+$/;

            valid &= validateField(firstName, nameRegex, "firstNameError");
            valid &= validateField(lastName, nameRegex, "lastNameError");

            const phoneError = document.getElementById("phoneError");
            let phoneInputValue = phoneInput.value.trim();

            if (phoneInputValue === "") {
                phoneError.style.display = "block";
                phoneInput.classList.add("is-invalid");
                valid = false;
                console.log("Phone input is empty");
            } else {
                const selectedCountryData = iti.getSelectedCountryData();
                const fullPhoneNumber = `+${selectedCountryData.dialCode}${phoneInputValue.replace(/^0+/, '')}`;

                console.log("Selected country dial code:", selectedCountryData.dialCode);
                console.log("Phone input value:", phoneInputValue);
                console.log("Full phone number:", fullPhoneNumber);

                if (!/^\+\d{7,15}$/.test(fullPhoneNumber)) {
                    phoneError.style.display = "block";
                    phoneInput.classList.add("is-invalid");
                    valid = false;
                    console.log("Phone number is invalid");
                } else {
                    phoneError.style.display = "none";
                    phoneInput.classList.remove("is-invalid");
                    phoneInput.value = fullPhoneNumber;
                    console.log("Phone number is valid and set:", fullPhoneNumber);
                }
            }

            const email = document.getElementById("email");
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            valid &= validateField(email, emailRegex, "emailError");

            if (!valid) {
                event.preventDefault();
            }
        });

        function validateField(inputElement, regex, errorElementId) {
            const errorElement = document.getElementById(errorElementId);
            if (!regex.test(inputElement.value.trim())) {
                errorElement.style.display = "block";
                inputElement.classList.add("is-invalid");
                return false;
            } else {
                errorElement.style.display = "none";
                inputElement.classList.remove("is-invalid");
                return true;
            }
        }
    });

</script>

</body>
</html>
