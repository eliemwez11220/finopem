let tagArr = document.getElementsByTagName("input");
for (let i = 0; i < tagArr.length; i++) {
    tagArr[i].autocomplete = 'off';
}

function showPass() {
    let inputs = document.getElementsByClassName('password');
    let icon = document.getElementById('eyepass');
    //let passmsg = document.getElementById('passmsg');
    for (const input of inputs) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.add('fa-eye-slash');
            icon.classList.remove('fa-eye');
        } else if (input.type === 'text') {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}