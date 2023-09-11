let submit_form_button = document.querySelector('#submit_form_btn'); // Submit form button
let logout_form_button = document.querySelector('#logout_btn'); // Logout form button
var main_url = 'http://localhost';
var can_submit_form = true;
var can_logout = true;

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

// Submit form method
let submit_form = (state, city, d_o_e, d_o_r, t_o_e, t_o_r, guardian_name, guardian_phone_number) => {
    can_submit_form = false;

    if (state && city && d_o_e && d_o_r && t_o_e && t_o_r && guardian_name && guardian_phone_number){
        let sanitized_state = sanitize_data(state); // Sanitized state
        let sanitize_city = sanitize_data(city); // Sanitized city
        let sanitize_doe = sanitize_data(d_o_e); // Sanitized d.o.e
        let sanitize_dor = sanitize_data(d_o_r); // Sanitized d.o.r
        let sanitize_toe = sanitize_data(t_o_e); // Sanitized t.o.e
        let sanitize_tor = sanitize_data(t_o_r); // Sanitized t.o.r
        let sanitize_gn = sanitize_data(guardian_name); // Sanitized gn
        let sanitize_gpn = sanitize_data(guardian_phone_number); // Sanitized gpn

        if (/^ *$/.test(sanitized_state)){
            can_submit_form = true;
            render_modal('red', 'Error', 'State is missing!'); // Display modal
        } else {
            if (/^ *$/.test(sanitize_city)){
                can_submit_form = true;
                render_modal('red', 'Error', 'City is missing!'); // Display modal
            } else {
                if (/^ *$/.test(sanitize_doe)){
                    can_submit_form = true;
                    render_modal('red', 'Error', 'Date of exit is missing!'); // Display modal
                } else {
                    if (/^ *$/.test(sanitize_dor)){
                        can_submit_form = true;
                        render_modal('red', 'Error', 'Date of return is missing!'); // Display modal
                    } else {
                        if (/^ *$/.test(sanitize_toe)){
                            can_submit_form = true;
                            render_modal('red', 'Error', 'Time of exit is missing!'); // Display modal
                        } else {
                            if (/^ *$/.test(sanitize_tor)){
                                can_submit_form = true;
                                render_modal('red', 'Error', 'Time of return is missing!'); // Display modal
                            } else {
                                if (/^ *$/.test(sanitize_gn)){
                                    can_submit_form = true;
                                    render_modal('red', 'Error', 'Guardian is missing!'); // Display modal
                                } else {
                                    if (/^ *$/.test(sanitize_gpn)){
                                        can_submit_form = true;
                                        render_modal('red', 'Error', 'Guardian phone number is missing!'); // Display modal
                                    } else {
                                        document.getElementById('spinner').style.display = 'inline-block';
                                        document.getElementById('login_txts').style.display = 'none';

                                        // Constructed request object
                                        let request = {
                                            method: 'POST',
                                            body: new URLSearchParams({
                                                state: sanitized_state,
                                                city: sanitize_city,
                                                doe: sanitize_doe,
                                                dor: sanitize_dor,
                                                toe: sanitize_toe,
                                                tor: sanitize_tor,
                                                gn: sanitize_gn,
                                                gpn: sanitize_gpn
                                            })
                                        }
                                        //--------------------------------

                                        fetch(`${main_url}/promise_project/api/student/form.php`, request)
                                            .then((res) => res.json()) // Return response in JSON format
                                            .then(data => {
                                                if (data.status === 'invalid_state'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid state!'); // Display modal
                                                } else if (data.status === 'invalid_city'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid city!'); // Display modal
                                                } else if (data.status === 'invalid_doe'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid date of exit!'); // Display modal
                                                } else if (data.status === 'invalid_dor'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid date of return!'); // Display modal
                                                } else if (data.status === 'invalid_toe'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid time of exit!'); // Display modal
                                                } else if (data.status === 'invalid_tor'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid time of return!'); // Display modal
                                                } else if (data.status === 'invalid_gn'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid guardian name!'); // Display modal
                                                } else if (data.status === 'invalid_gpn'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid guardian phone number!'); // Display modal
                                                } else if (data.status === 'invalid_gpn'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('red', 'Error', 'Invalid guardian phone number!'); // Display modal
                                                } else if (data.status === 'form_submitted_successfully'){
                                                    document.getElementById('spinner').style.display = 'none';
                                                    document.getElementById('login_txts').style.display = 'inline-block';
                                                    can_submit_form = true;
                                                    render_modal('green', 'Successfull', 'Form submitted successfully!'); // Display modal
                                                }
                                            })
                                            .catch(err => {
                                                document.getElementById('spinner').style.display = 'none';
                                                document.getElementById('login_txts').style.display = 'inline-block';
                                                can_submit_form = true;
                                                render_modal('red', 'Error', 'An error just occured!'); // Display modal
                                            })
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        can_submit_form = true;
        render_modal('red', 'Error', 'Fields can\'t be empty!'); // Display modal
    }
}
//--------------------------------

// Logout method
let logout = () => {
    can_submit_form = false;
    
    if (can_logout === true){
        can_logout = false;
        document.getElementById('spinner_2').style.display = 'inline-block';
        document.getElementById('login_txts_2').style.display = 'none';
    
        fetch(`${main_url}/promise_project/api/logout.php`)
            .then((res) => res.json()) // Return response in JSON format
            .then(data => {
                if (data.status === 'error_occured'){
                    document.getElementById('spinner_2').style.display = 'none';
                    document.getElementById('login_txts_2').style.display = 'inline-block';
                    can_submit_form = true;
                    render_modal('red', 'Error', 'An error just occured!'); // Display modal
                } else if (data.status === 'successfull'){
                    window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index home page
                }
            })
            .catch(err => {
                document.getElementById('spinner_2').style.display = 'none';
                document.getElementById('login_txts_2').style.display = 'inline-block';
                can_submit_form = true;
                can_logout = true;
                render_modal('red', 'Error', 'An error just occured!'); // Display modal
            })
    }
}
//--------------------------------

// Detect anytime the user clicks the submit form button
submit_form_button.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent the html form from refreshing after the submit form button is clicked

    if (can_submit_form === true){
        let state = document.querySelector('#form_state').value; // State
        let city = document.querySelector('#form_city').value; // City
        let d_o_e = document.querySelector('#form_date_of_exit').value; // D.o.e
        let d_o_r = document.querySelector('#form_date_of_return').value; // D.o.r
        let t_o_e = document.querySelector('#form_time_of_exit').value; // T.o.e
        let t_o_r = document.querySelector('#form_time_of_return').value; // T.o.r
        let guardian_name = document.querySelector('#form_guardian_name').value; // Guardian name
        let guardian_phone_number = document.querySelector('#form_guardian_number').value; // Guardian number

        submit_form(state, city, d_o_e, d_o_r, t_o_e, t_o_r, guardian_name, guardian_phone_number); // Attempt to submit form
    }
});
//-------------------------------------------

// Detect anytime the user clicks the logout form button
logout_form_button.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent the html form from refreshing after the submit form button is clicked

    if (can_submit_form === true){
        logout(); // Attempt to logout the user
    }
});
//-------------------------------------------