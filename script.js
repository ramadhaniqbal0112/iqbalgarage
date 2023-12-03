// syntax halaman index
function removeClass() {
    var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    var element = document.getElementById('firstElement');

    var navMenu = document.getElementById('navMenu');
    var humbergerMenu = document.getElementById('humbergerMenu');

    var firstFooter = document.getElementById('firstFooter');
    var secondFooter = document.getElementById('secondFooter');

    if (screenWidth < 420) {
        element.classList.remove('container');
        element.classList.add('container-fluid');
    } else {
        element.classList.add('container-fluid');
        element.classList.add('container');
    }

    if (screenWidth < 767) {
        firstFooter.classList.add('justify-content-center');
        secondFooter.classList.remove('justify-content-around');
        secondFooter.classList.add('justify-content-center');
    } else {
        firstFooter.classList.remove('justify-content-center');
        secondFooter.classList.remove('justify-content-center');
        secondFooter.classList.add('justify-content-around');
    }

}
window.onload = removeClass;
window.onresize = removeClass;
// **********************************************************************************************

// syntax halaman login & register
const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        // Function untuk registrasi
        function validateForm(event) {
            event.preventDefault();

            var rName = document.getElementById("rName").value;
            var rEmail = document.getElementById("rEmail").value;
            var rPassword = document.getElementById("rPassword").value;
            var rRepeatPassword = document.getElementById("rRepeatPassword").value;


            if (rName.trim() === "" || rEmail.trim() === "" || rPassword.trim() === "" ||
                rRepeatPassword.trim() === "" || rPassword != rRepeatPassword || rPassword.length < 8) {
                // checking name
                if (rName.trim() === "") {
                    document.getElementById("rAlertName").innerHTML = "Name is required";
                } else {
                    document.getElementById("rAlertName").innerHTML = "";
                }
                // checking email
                if (rEmail.trim() === "") {
                    document.getElementById("rAlertEmail").innerHTML = "Email is required";
                } else {
                    document.getElementById("rAlertEmail").innerHTML = "";
                }
                // checking password
                if (rPassword.trim() === "") {
                    document.getElementById("rAlertPassword").innerHTML = "Create your password";
                } else if (rPassword.length < 8) {
                    document.getElementById("rAlertPassword").innerHTML = "Minimum 8 characters";
                } else {
                    document.getElementById("rAlertPassword").innerHTML = "";
                }
                // checking repeat password
                if (rRepeatPassword.trim() === "") {
                    document.getElementById("rAlertRepeatPassword").innerHTML = "Repeat your password";
                } else if (rPassword != rRepeatPassword) {
                    document.getElementById("rAlertRepeatPassword").innerHTML = "Passwords are not the same";
                } else {
                    document.getElementById("rAlertRepeatPassword").innerHTML = "";
                }

                return false;
            }

            document.getElementById("regisForm").submit();
        }

        function validateFormLogin(event) {
            event.preventDefault();

            var lEmail = document.getElementById("lEmail").value;
            var lPassword = document.getElementById("lPassword").value;

            if (lEmail.trim() === "" || lPassword.trim() === "") {
                // checking email login
                if (lEmail.trim() === "") {
                    document.getElementById("lAlertEmail").innerHTML = "Fill in your email";
                } else {
                    document.getElementById("lAlertEmail").innerHTML = "";
                }
                // checking password login
                if (lPassword.trim() === "") {
                    document.getElementById("lAlertPassword").innerHTML = "Fill in your password";
                } else {
                    document.getElementById("lAlertPassword").innerHTML = "";
                }
                return false;
            }
            document.getElementById("loginForm").submit();
        }

// *****************************************************************************************************************************
