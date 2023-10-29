// Get the form element
const form = document.getElementsByTagName("form")[0];
form.addEventListener("submit", submit);

function submit(event){
    event.preventDefault(); //need to have this!!!! else it wont work properly.
    errorChecking();
    form.submit();
}

function errorChecking(){

    const password = document.getElementById("pass").value;

    //validate password
    const regexPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const validPass = regexPass.test(password);

    // valid or invalid password : show error alert

    if (!validPass) {
        alert('Please enter a valid password');
        password.focus();
        return;
    }
}
