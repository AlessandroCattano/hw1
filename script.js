function show(event) {
    event.stopPropagation();
    mobileLinks.classList.toggle('show');
}

function hide() {
    mobileLinks.classList.remove('show');
}

function showModal() {
    document.body.classList.add('no-scroll');
    LoginModal.classList.add('show');
}

function hideModal() {
    const oldAlerts = LoginModal.querySelectorAll('.modals #error-div');
    for (let i = 0; i < oldAlerts.length; i++) {
        oldAlerts[i].remove();
    }
    document.body.classList.remove('no-scroll');
    LoginModal.classList.remove('show');
    RegisterModal.classList.remove('show');
}

function ChangeModal() {
    const oldAlert = LoginModal.querySelector('#error-div');
    if (oldAlert) oldAlert.remove();
    LoginModal.classList.remove('show');
    RegisterModal.classList.add('show');
}

function backtologin() {
    const oldAlert = RegisterModal.querySelector('#error-div');
    if (oldAlert) oldAlert.remove();
    LoginModal.classList.add('show');
    RegisterModal.classList.remove('show');
}

function Check(json){
    if (json.success) {
        console.log("Success:", json.success);
        window.location.href = "index.php";
    } else {
        console.log("Error:", json.error);
        let error_div = document.querySelector('#error-div');
        if(error_div){
            error_div.textContent=json.error;
        }else if(json.reg === undefined){
            let body = document.querySelector('form[name="login-form"] .modal-body');
            error_div = body.querySelector('#error-div');
            if(!error_div){
                const newerrordiv = document.createElement('div');
                newerrordiv.id="error-div";
                newerrordiv.textContent= json.error;
                body.appendChild(newerrordiv);
            } else {
                error_div.textContent = json.error;
            }
        }else if(json.login === undefined){
            let body = document.querySelector('form[name="registration-form"] .modal-body');
            error_div = body.querySelector('#error-div');
            if(!error_div){
                const newerrordiv = document.createElement('div');
                newerrordiv.id="error-div";
                newerrordiv.textContent= json.error;
                body.appendChild(newerrordiv);
            } else {
                error_div.textContent = json.error;
            }
        }   
    }
}

function onResponse(response) {
    return response.json();
}

function lvalidation(event) {
    event.preventDefault();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    let text = null;
    let boolean = false;

    const oldAlert = LoginModal.querySelector('#error-div');
    if (oldAlert) oldAlert.remove();

    if (lform.email.value.length == 0 ||
        lform.password.value.length == 0) {
        text = "sono presenti campi vuoti";
        boolean = true;
    }
    if (!boolean && !emailRegex.test(lform.email.value)) {
        text = "formato errato della mail";
        boolean = true;
    } 
    if (!boolean && !passwordRegex.test(lform.password.value)) {
        text = "formato password errato";
        boolean = true;
    }
    if (boolean) {
        const alertdiv = document.createElement("div");
        alertdiv.id = "error-div";
        alertdiv.textContent = text;
        const modalFooter = LoginModal.querySelector('.modal-body');
        modalFooter.appendChild(alertdiv);
    } else {
        fetch("login.php", {
            method: 'post', 
            body: new FormData(lform) }
        ).then(onResponse).then(Check);
    }
}

function rvalidation(event) {
    event.preventDefault();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    let text = null;
    let boolean = false;

    const oldAlert = RegisterModal.querySelector('#error-div');
    if (oldAlert) oldAlert.remove();

    if (rform.name.value.length == 0 ||
        rform.surname.value.length == 0 ||
        rform.email.value.length == 0 ||
        rform.password.value.length == 0) {
        text = "sono presenti campi vuoti";
        boolean = true;
    }
    if (!boolean && !emailRegex.test(rform.email.value)) {
        text = "formato errato della mail";
        boolean = true;
    }
    if (!boolean && !passwordRegex.test(rform.password.value)) {
        text = "formato password errato";
        boolean = true;
    }
    if (boolean) {
        const alertdiv = document.createElement("div");
        alertdiv.id = "error-div";
        alertdiv.textContent = text;
        const modalFooter = RegisterModal.querySelector('.modal-body');
        modalFooter.appendChild(alertdiv);
    } else {
        fetch("validation.php", { 
            method: 'post', 
            body: new FormData(rform)
        }).then(onResponse).then(Check);
    }
}

const burgerMenu = document.querySelector('#burger-menu');
const mobileLinks = document.querySelector('#mobile-links');
burgerMenu.addEventListener('click', show);
document.addEventListener('click', hide);

const user = document.querySelectorAll('.user');
for (let i = 0; i < user.length; i++) {
    user[i].addEventListener('click', showModal);
}

const RegisterModal = document.querySelector('#register-modal');
const LoginModal = document.querySelector('#login-modal');
const closeModal = document.querySelectorAll('.modal-close');
for (i = 0; i < closeModal.length; i++) {
    closeModal[i].addEventListener('click', hideModal);
}
const changeModal = document.querySelector('#change-modal');
changeModal.addEventListener('click', ChangeModal);
const back = document.querySelector('#back');
back.addEventListener('click', backtologin);

const lform = document.forms['login-form'];
lform.addEventListener('submit', lvalidation);
const rform = document.forms['registration-form'];
rform.addEventListener('submit', rvalidation);

