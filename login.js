const wrapper = document.querySelector(".wrapper");
const loginLink = document.querySelector(".login-link");
const registerLink = document.querySelector(".register-link");

// For forget password
function message() {
    alert("Remember your password brother!");
}


function clearErrors(){
    errors = document.getElementsByClassName('error');
    for(let item of errors) {
        item.innerHTML = "";
    }
}

function setError(id, error) {
    document.getElementById(id).innerHTML = error;
}

// Form Validation

function validateForm() {
    let returnval = true;
    clearErrors();

    let username = document.forms['registerForm']["username"].value;
    if (username.length<5){
        setError("user_error", "*Length of name is too short");
        returnval = false;
    }

    if (username.length == 0){
        setError("user_error", "*Length of name cannot be zero!");
        returnval = false;
    }

    var email = document.forms['registerForm']["email"].value;
    if (email.length>15){
        setError("email_error", "*Email length is too long");
        returnval = false;
    }

    var password = document.forms['registerForm']["password"].value;
    if (password.length < 6){
        setError("pass_error", "*Password should be atleast 6 characters long!");
        returnval = false;
    }

    var cpassword = document.forms['registerForm']["cpassword"].value;
    if (cpassword != password){
        setError("cpass_error", "*Password and Confirm password should match!");
        returnval = false;
    }

    let terms = document.forms['registerForm']["terms"];
    if (!terms.checked) {
        setError("check_error", "*You must agree to the terms and conditions.");
        returnval = false;
    }

    return returnval;
}

registerLink.addEventListener("click", () => {
    wrapper.classList.add('active');
});

loginLink.addEventListener("click", () => {
    wrapper.classList.remove('active');
});

