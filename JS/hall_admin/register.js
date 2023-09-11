let signup_button = document.querySelector('#signup_btn'); // Signup button
var main_url = 'http://localhost';
var can_register = true;

// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var close_modal = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
close_modal.onclick = function() {
    modal.style.display = "none";
}
//-----------------------------------------

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//-----------------------------------------

// Display error message through modal
let render_modal = (color, head_txt, box_txt) => {
    document.getElementById('m_head').style.background = color;
    document.getElementById('m_foot').style.background = color;
    document.getElementById('head_txt').innerText = head_txt;
    document.getElementById('box_txt').innerText = box_txt;
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}
//-----------------------------------------

// Register user method
let register_user = (name, phone_number, email, password, conf_password) => {
    can_register = false;

    if (name && phone_number && email && password && conf_password){
        let sanitized_name = sanitize_data(name); // Sanitized name
        let sanitized_phone_num = sanitize_data(phone_number); // Sanitized phone number
        let sanitized_email = sanitize_data(email); // Sanitized email
        let sanitized_password = sanitize_data(password); // Sanitized password
        let sanitized_conf_password = sanitize_data(conf_password); // Sanitized confirm password

        if (/^ *$/.test(sanitized_name)){
            can_register = true;
            render_modal('red', 'Error', 'Name is missing!'); // Display modal
        } else {
            if (/^ *$/.test(sanitized_password)){
                can_register = true;
                render_modal('red', 'Error', 'Password is missing!'); // Display modal
            } else {
                if (/^ *$/.test(sanitized_conf_password)){
                    can_register = true;
                    render_modal('red', 'Error', 'Confirm password is missing!'); // Display modal
                } else {
                    if (/^ *$/.test(sanitized_phone_num)){
                        can_register = true;
                        render_modal('red', 'Error', 'Phone number is missing!'); // Display modal
                    } else {
                        if (/^ *$/.test(sanitized_email)){
                            can_register = true;
                            render_modal('red', 'Error', 'Email is missing!'); // Display modal
                        } else {
                            if (sanitized_name.length > 500 || sanitized_name.length === 0){
                                can_register = true;
                                render_modal('red', 'Error', 'Name should not be longer than 500!'); // Display modal
                            } else {
                                if (sanitized_password === sanitized_conf_password){
                                    if (sanitized_password.length >= 5 && sanitized_password.length <= 10){
                                        if (sanitized_phone_num.length > 15 || sanitized_phone_num.length === 0){
                                            can_register = true;
                                            render_modal('red', 'Error', 'Phone number is invalid!'); // Display modal
                                        } else {
                                            if (sanitized_email.length > 230 || sanitized_email.length === 0 || validate_email(sanitized_email) === false){
                                                can_register = true;
                                                render_modal('red', 'Error', 'Email is invalid!'); // Display modal
                                            } else {
                                                document.getElementById('spinner').style.display = 'inline-block';
                                                document.getElementById('login_txts').style.display = 'none';

                                                // Constructed request object
                                                let request = {
                                                    method: 'POST',
                                                    body: new URLSearchParams({
                                                        name: sanitized_name,
                                                        password: sanitized_password,
                                                        phone_number: sanitized_phone_num,
                                                        email: sanitized_email,
                                                    })
                                                }
                                                //--------------------------------

                                                fetch(`${main_url}/promise_project/api/hall_admin/register.php`, request)
                                                    .then((res) => res.json()) // Return response in JSON format
                                                    .then(data => {
                                                        if (data.status === 'error'){
                                                            document.getElementById('spinner').style.display = 'none';
                                                            document.getElementById('login_txts').style.display = 'inline-block';
                                                            can_register = true;
                                                            render_modal('red', 'Error', 'Missing credentials!'); // Display modal
                                                        } else if (data.status === 'invalid_name'){
                                                            document.getElementById('spinner').style.display = 'none';
                                                            document.getElementById('login_txts').style.display = 'inline-block';
                                                            can_register = true;
                                                            render_modal('red', 'Error', 'Name is invalid!'); // Display modal
                                                        } else if (data.status === 'invalid_password'){
                                                            document.getElementById('spinner').style.display = 'none';
                                                            document.getElementById('login_txts').style.display = 'inline-block';
                                                            can_register = true;
                                                            render_modal('red', 'Error', 'Password is invalid!'); // Display modal
                                                        } else if (data.status === 'invalid_phone_number'){
                                                            document.getElementById('spinner').style.display = 'none';
                                                            document.getElementById('login_txts').style.display = 'inline-block';
                                                            can_register = true;
                                                            render_modal('red', 'Error', 'Phone number is invalid!'); // Display modal
                                                        } else if (data.status === 'invalid_email'){
                                                            document.getElementById('spinner').style.display = 'none';
                                                            document.getElementById('login_txts').style.display = 'inline-block';
                                                            can_register = true;
                                                            render_modal('red', 'Error', 'Email is invalid!'); // Display modal
                                                        } else if (data.status === 'account_already_exists'){
                                                            document.getElementById('spinner').style.display = 'none';
                                                            document.getElementById('login_txts').style.display = 'inline-block';
                                                            can_register = true;
                                                            render_modal('red', 'Error', 'Account already exists!'); // Display modal
                                                        } else if (data.status === 'account_created_successfully'){
                                                            window.location.href = main_url + '/promise_project/hall_admin/dashboard/index.php'; // Redirect hall admin to the dashboard page
                                                        }
                                                    })
                                                    .catch(err => {
                                                        document.getElementById('spinner').style.display = 'none';
                                                        document.getElementById('login_txts').style.display = 'inline-block';
                                                        can_register = true;
                                                        render_modal('red', 'Error', 'An error just occured!'); // Display modal
                                                    })
                                            }
                                        }
                                    } else {
                                        can_register = true;
                                        render_modal('red', 'Error', 'Password is invalid!'); // Display modal
                                    }
                                } else {
                                    can_register = true;
                                    render_modal('red', 'Error', 'Password must match!'); // Display modal
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        can_register = true;
        render_modal('red', 'Error', 'Fields can\'t be empty!'); // Display modal
    }
}
//--------------------------------

// Detect anytime the user clicks the signup button
signup_button.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent the html form from refreshing after the signup button is clicked

    if (can_register === true){
        let name = document.querySelector('#signup_name').value; // Name
        let password = document.querySelector('#signup_password').value; // Password
        let phone_number = document.querySelector('#signup_phone_number').value; // Phone number
        let conf_password = document.querySelector('#signup_password_conf').value; // Confirm password
        let email = document.querySelector('#signup_email').value; // Email

        register_user(name, phone_number, email, password, conf_password); // Attempt to register the user
    }
});
//-------------------------------------------