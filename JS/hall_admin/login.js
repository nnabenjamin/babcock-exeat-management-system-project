let login_button = document.querySelector('#login_btn'); // Login button
var main_url = 'http://localhost';
var can_login = true;

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

// Login user method
let login_user = (email, password) => {
    can_login = false;

    if (email && password){
        let sanitized_email = sanitize_data(email); // Sanitized email
        let sanitized_password = sanitize_data(password); // Sanitized password

        if (/^ *$/.test(sanitized_email)){
            can_login = true;
            render_modal('red', 'Error', 'Email is missing!'); // Display modal
        } else {
            if (/^ *$/.test(sanitized_password)){
                can_login = true;
                render_modal('red', 'Error', 'Password is missing!'); // Display modal
            } else {
                document.getElementById('spinner').style.display = 'inline-block';
                document.getElementById('login_txts').style.display = 'none';

                // Constructed request object
                let request = {
                    method: 'POST',
                    body: new URLSearchParams({
                        email: sanitized_email,
                        password: sanitized_password
                    })
                }
                //--------------------------------

                fetch(`${main_url}/promise_project/api/hall_admin/login.php`, request)
                    .then((res) => res.json()) // Return response in JSON format
                    .then(data => {
                        if (data.status === 'error'){
                            document.getElementById('spinner').style.display = 'none';
                            document.getElementById('login_txts').style.display = 'inline-block';
                            can_login = true;
                            render_modal('red', 'Error', 'Missing credentials!'); // Display modal
                        } else if (data.status === 'missing_email'){
                            document.getElementById('spinner').style.display = 'none';
                            document.getElementById('login_txts').style.display = 'inline-block';
                            can_login = true;
                            render_modal('red', 'Error', 'Email is missing!'); // Display modal
                        } else if (data.status === 'missing_password'){
                            document.getElementById('spinner').style.display = 'none';
                            document.getElementById('login_txts').style.display = 'inline-block';
                            can_login = true;
                            render_modal('red', 'Error', 'Password is missing!'); // Display modal
                        } else if (data.status === 'account_does_not_exist'){
                            document.getElementById('spinner').style.display = 'none';
                            document.getElementById('login_txts').style.display = 'inline-block';
                            can_login = true;
                            render_modal('red', 'Error', 'Account does not exist!'); // Display modal
                        } else if (data.status === 'login_successful'){
                            window.location.href = main_url + '/promise_project/hall_admin/dashboard/index.php'; // Redirect hall admin to the dashboard page
                        }
                    })
                    .catch(err => {
                        document.getElementById('spinner').style.display = 'none';
                        document.getElementById('login_txts').style.display = 'inline-block';
                        can_login = true;
                        render_modal('red', 'Error', 'An error just occured!'); // Display modal
                    })
            }
        }
    } else {
        can_login = true;
        render_modal('red', 'Error', 'Email and password is required!'); // Display modal
    }
}
//--------------------------------

// Detect anytime the user clicks the login button
login_button.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent the html form from refreshing after the login button is clicked

    if (can_login === true){
        let email = document.querySelector('#login_email').value; // Email
        let password = document.querySelector('#login_password').value; // Password

        login_user(email, password); // Attempt to login the user
    }
});
//-------------------------------------------