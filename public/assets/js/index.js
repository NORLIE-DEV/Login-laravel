const showPassword = document.querySelector("#showpassword");
const myPassword = document.querySelector("#password");

showPassword.addEventListener("click", function () {
   // alert(2);
    if (myPassword.type === "password") {
        myPassword.type = "text";
    } else {
        myPassword.type = "password";
    }
});
