


document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("contact-form").addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    function validateForm() {
        return checkEmails() && checkDate();
    }

    function checkEmails() {
        let email = document.getElementById("email").value;
        let confirmEmail = document.getElementById("confirm-email").value;

        // Check if email ends with @aston.ac.uk
        let emailPattern = /^[a-zA-Z0-9._%+-]+@aston\.ac\.uk$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid Aston University email (must end with @aston.ac.uk).");
            return false;
        }

        // Check if both email inputs match
        if (email !== confirmEmail) {
            alert("Email addresses do not match. Please re-enter.");
            return false;
        }

        return true;
    }

    function checkDate() {
        let selectedDate = new Date(document.getElementById("appointment-date").value);
        let today = new Date();

        // Ensure appointment date is in the future
        if (selectedDate <= today) {
            alert("Please select a future date for the appointment.");
            return false;
        }

        return true;
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let recipeBoxes = document.querySelectorAll(".recipe-box");
    
    recipeBoxes.forEach(box => {
        let recipe = box.querySelector(".recipe");
        if (recipe) {
            recipe.style.display = "none";
        }

        box.addEventListener("click", function(event) {
            // Prevent click event from bubbling up
            event.stopPropagation();
            
            let isVisible = recipe.style.display === "block";

            // Hide all other recipes before toggling the clicked one
            document.querySelectorAll(".recipe").forEach(r => r.style.display = "none");
            
            if (recipe) {
                recipe.style.display = isVisible ? "none" : "block";
            }
        });
    });

    // Hide recipes when clicking outside
    document.addEventListener("click", function() {
        document.querySelectorAll(".recipe").forEach(r => r.style.display = "none");
    });
});


