// Get the form element
const form = document.getElementsByTagName("form")[0];
form.addEventListener("submit", submit);

function submit(event){
    event.preventDefault(); //need to have this!!!! else it wont work properly.
    errorChecking();
    form.submit();
}

function errorChecking(){

    const email = document.getElementById("email").value;
    console.log(email);
    const password = document.getElementById("pass").value;
    console.log(pass);

    //validate email
    const regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    const validEmail = regexEmail.test(email);

    //validate password
    const regexPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const validPass = regexPass.test(password);

    //valid or invalid email + password : show error alert
    if (!validEmail) {
        alert('Please enter a valid email address');
        email.focus();
        return;
    }

    if (!validPass) {
        alert('Please enter a valid password');
        password.focus();
        return;
    }
}
