var main_url = 'http://localhost';
var search_field = document.querySelector('#search_bar_x');
var enable_search = false;
var accepting_request = false;
var rejecting_request = false;
var pending_requests = [];
var list_elem = document.querySelector('#gate_pass_requests');
var can_logout = true;
var data_fetched = false;
var user_id = null;
var request_id = null;
var logout_form_button = document.querySelector('#logout_btn');
var accept_request_btn = document.querySelector('#accept_request');
var leave_request_btn = document.querySelector('#leave_request');

// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var close_modal = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
close_modal.onclick = function() {
    if (accepting_request === true || rejecting_request === true){
        // Do nothing
    } else {
        modal.style.display = "none";
    }
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

const modal_x = document.querySelector(".modal_x"); // Accept request modal
const closeButton_x = document.querySelector(".close-button_x"); // Close button for accept request modal

function toggleModal() {
    modal_x.classList.toggle("show-modal");
}

closeButton_x.addEventListener('click', () => {
    document.getElementById('spinner').style.display = 'none';
    document.getElementById('btn_txts').style.display = 'inline-block';
    user_id = null;
    request_id = null;
    toggleModal();
})

// Detect when the user is typing into the search field
search_field.addEventListener('keyup', (event) => {
    if (enable_search === true){
        data_fetched = false;
        pending_requests = [];
        enable_search = false;
        let sanitized_search = sanitize_data(search_field.value); // Sanitized search

        if (/^ *$/.test(sanitized_search)){
            if (pending_requests.length > 0){
                list_elem.innerHTML = '';
                pending_requests.forEach(element => {
                    const node = document.createElement("div");
                    node.setAttribute("class", "mail");
                    node.setAttribute("id", "request_elem");
                    node.setAttribute("data-userid", element.id);
                    node.setAttribute("data-requestid", element.request_id);
                    node.setAttribute("data-destination_state", element.destination_state);
                    node.setAttribute("data-destination_city", element.destination_city);
                    node.setAttribute("data-date_of_exit", element.date_of_exit);
                    node.setAttribute("data-date_of_return", element.date_of_return);
                    node.setAttribute("data-time_of_exit", element.time_of_exit);
                    node.setAttribute("data-time_of_return", element.time_of_return);
                    node.setAttribute("data-guardian_name", element.guardian_name);
                    node.setAttribute("data-guardian_phone_number", element.guardian_phone_number);
                    node.setAttribute("data-date_requested", element.date_requested);
                    node.innerHTML = `
                        <div class="pfp">
                            <img src="./images/FTqHfUcUsAA4WYG.jfif" alt="">
                        </div>
                        <div class="mail-synopsis">
                            <h6 style="font-size: 0.97rem;">${element.name}</h6>
                            <p><span style="font-weight: 600;">${element.matric_no}</span> (<span style="font-weight: 600;">Date: ${element.date_requested}</span>)</p>
                        </div>
                    `;
                    list_elem.appendChild(node);
                });

                enable_search = true;
                data_fetched = true;
            } else if (pending_requests.length === 0){
                pending_requests = [];
                enable_search = false;
                data_fetched = false;

                list_elem.innerHTML =  `
                    <svg xmlns="http://www.w3.org/2000/svg" id="load_spinner" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto; margin-top: 13px;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <g transform="rotate(0 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(30 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(60 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(90 50 50)">s
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(120 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(150 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(180 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(210 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(240 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(270 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(300 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"/>
                        </rect>
                        </g><g transform="rotate(330 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"/>
                        </rect>
                        </g>
                    </svg>
                `;

                // Constructed request object
                let request = {
                    method: 'POST',
                    body: new URLSearchParams({
                        search: sanitized_search
                    })
                }
                //--------------------------------

                fetch(`${main_url}/promise_project/api/hall_admin/search_requests.php`, request)
                    .then((res) => res.json()) // Return response in JSON format
                    .then(data => {
                        if (data.status === 'successful'){
                            let array_data = data.result;
                            list_elem.innerHTML = '';
                            array_data.forEach(element => {
                                const node = document.createElement("div");
                                node.setAttribute("class", "mail");
                                node.setAttribute("id", "request_elem");
                                node.setAttribute("data-userid", element.id);
                                node.setAttribute("data-requestid", element.request_id);
                                node.setAttribute("data-destination_state", element.destination_state);
                                node.setAttribute("data-destination_city", element.destination_city);
                                node.setAttribute("data-date_of_exit", element.date_of_exit);
                                node.setAttribute("data-date_of_return", element.date_of_return);
                                node.setAttribute("data-time_of_exit", element.time_of_exit);
                                node.setAttribute("data-time_of_return", element.time_of_return);
                                node.setAttribute("data-guardian_name", element.guardian_name);
                                node.setAttribute("data-guardian_phone_number", element.guardian_phone_number);
                                node.setAttribute("data-date_requested", element.date_requested);
                                node.innerHTML = `
                                    <div class="pfp">
                                        <img src="./images/FTqHfUcUsAA4WYG.jfif" alt="">
                                    </div>
                                    <div class="mail-synopsis">
                                        <h6 style="font-size: 0.97rem;">${element.name}</h6>
                                        <p><span style="font-weight: 600;">${element.matric_no}</span> (<span style="font-weight: 600;">Date: ${element.date_requested}</span>)</p>
                                    </div>
                                `;
                                list_elem.appendChild(node);

                                pending_requests.push(element);
                            });
                            
                            enable_search = true;
                            data_fetched = true;
                        } else if (data.status === 'role_error'){
                            enable_search = false;
                            data_fetched = false;
                            pending_requests = [];
                            window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index page
                        } else if (data.status === 'invalid_search'){
                            list_elem.innerHTML =  `
                                <div id="error_placement">
                                    <img id="cancel_icon" src="images/no_data.png" alt="">
                                    <p id="error_text">An error occured!</p>
                                </div>
                            `;

                            enable_search = true;
                            pending_requests = [];
                            data_fetched = false;
                        } else if (data.status === 'no_data_available'){
                            list_elem.innerHTML =  `
                                <div id="error_placement">
                                    <img id="cancel_icon" src="images/no_data.png" alt="">
                                    <p id="error_text">No data found!</p>
                                </div>
                            `;

                            enable_search = true;
                            data_fetched = false;
                            pending_requests = [];
                        } else if (data.status === 'invalid'){
                            list_elem.innerHTML =  `
                                <div id="error_placement">
                                    <img id="cancel_icon" src="images/cancel.png" alt="">
                                    <p id="error_text">An error occured!</p>
                                </div>
                            `;

                            enable_search = true;
                            data_fetched = false;
                            pending_requests = [];
                        }
                    })
                    .catch(err => {
                        list_elem.innerHTML =  `
                            <div id="error_placement">
                                <img id="cancel_icon" src="images/cancel.png" alt="">
                                <p id="error_text">An error occured!</p>
                            </div>
                        `;

                        enable_search = true;
                        pending_requests = [];
                        data_fetched = false;
                    })
            }
        } else {
            pending_requests = [];
            enable_search = false;
            data_fetched = false;

            list_elem.innerHTML =  `
                <svg xmlns="http://www.w3.org/2000/svg" id="load_spinner" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto; margin-top: 13px;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <g transform="rotate(0 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(30 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(60 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(90 50 50)">s
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(120 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(150 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(180 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(210 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(240 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(270 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(300 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"/>
                    </rect>
                    </g><g transform="rotate(330 50 50)">
                    <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#000000">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"/>
                    </rect>
                    </g>
                </svg>
            `;

            // Constructed request object
            let request = {
                method: 'POST',
                body: new URLSearchParams({
                    search: sanitized_search
                })
            }
            //--------------------------------

            fetch(`${main_url}/promise_project/api/hall_admin/search_requests.php`, request)
                .then((res) => res.json()) // Return response in JSON format
                .then(data => {
                    if (data.status === 'successful'){
                        let array_data = data.result;
                        list_elem.innerHTML = '';
                        array_data.forEach(element => {
                            const node = document.createElement("div");
                            node.setAttribute("class", "mail");
                            node.setAttribute("id", "request_elem");
                            node.setAttribute("data-userid", element.id);
                            node.setAttribute("data-requestid", element.request_id);
                            node.setAttribute("data-destination_state", element.destination_state);
                            node.setAttribute("data-destination_city", element.destination_city);
                            node.setAttribute("data-date_of_exit", element.date_of_exit);
                            node.setAttribute("data-date_of_return", element.date_of_return);
                            node.setAttribute("data-time_of_exit", element.time_of_exit);
                            node.setAttribute("data-time_of_return", element.time_of_return);
                            node.setAttribute("data-guardian_name", element.guardian_name);
                            node.setAttribute("data-guardian_phone_number", element.guardian_phone_number);
                            node.setAttribute("data-date_requested", element.date_requested);
                            node.innerHTML = `
                                <div class="pfp">
                                    <img src="./images/FTqHfUcUsAA4WYG.jfif" alt="">
                                </div>
                                <div class="mail-synopsis">
                                    <h6 style="font-size: 0.97rem;">${element.name}</h6>
                                    <p><span style="font-weight: 600;">${element.matric_no}</span> (<span style="font-weight: 600;">Date: ${element.date_requested}</span>)</p>
                                </div>
                            `;
                            list_elem.appendChild(node);

                            pending_requests.push(element);
                        });
                        
                        enable_search = true;
                        data_fetched = true;
                    } else if (data.status === 'role_error'){
                        enable_search = false;
                        data_fetched = false;
                        pending_requests = [];
                        window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index page
                    } else if (data.status === 'invalid_search'){
                        list_elem.innerHTML =  `
                            <div id="error_placement">
                                <img id="cancel_icon" src="images/no_data.png" alt="">
                                <p id="error_text">An error occured!</p>
                            </div>
                        `;

                        enable_search = true;
                        pending_requests = [];
                        data_fetched = false;
                    } else if (data.status === 'no_data_available'){
                        list_elem.innerHTML =  `
                            <div id="error_placement">
                                <img id="cancel_icon" src="images/no_data.png" alt="">
                                <p id="error_text">No data found!</p>
                            </div>
                        `;

                        enable_search = true;
                        data_fetched = false;
                        pending_requests = [];
                    } else if (data.status === 'invalid'){
                        list_elem.innerHTML =  `
                            <div id="error_placement">
                                <img id="cancel_icon" src="images/cancel.png" alt="">
                                <p id="error_text">An error occured!</p>
                            </div>
                        `;

                        enable_search = true;
                        data_fetched = false;
                        pending_requests = [];
                    }
                })
                .catch(err => {
                    list_elem.innerHTML =  `
                        <div id="error_placement">
                            <img id="cancel_icon" src="images/cancel.png" alt="">
                            <p id="error_text">An error occured!</p>
                        </div>
                    `;

                    enable_search = true;
                    pending_requests = [];
                    data_fetched = false;
                })
        }
    }
});
//----------------------------------------------------------------

// Logout method
let logout = () => {
    if (can_logout === true){
        can_logout = false;
        fetch(`${main_url}/promise_project/api/logout.php`)
            .then((res) => res.json()) // Return response in JSON format
            .then(data => {
                if (data.status === 'error_occured'){
                    can_logout = true;
                    render_modal('red', 'Error', 'An error just occured!'); // Display modal
                } else if (data.status === 'successfull'){
                    window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index home page
                }
            })
            .catch(err => {
                can_logout = true;
                render_modal('red', 'Error', 'An error just occured!'); // Display modal
            })
    }
}
//--------------------------------

// Detect anytime the user clicks the logout form button
logout_form_button.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent the html form from refreshing after the submit form button is clicked

    if (can_logout === true){
        data_fetched = false;
        enable_search = false;
        pending_requests = [];
        logout(); // Attempt to logout the user
    }
});
//-------------------------------------------

document.querySelector('#gate_pass_requests').addEventListener('click', (e) => {
    if (data_fetched === true && pending_requests.length > 0 && enable_search === true){
        try {
            user_id = e.target.closest("#request_elem").dataset.userid;
            request_id = e.target.closest("#request_elem").dataset.requestid;
            document.querySelector("#dest_state").innerHTML = e.target.closest("#request_elem").dataset.destination_state;
            document.querySelector("#dest_city").innerHTML = e.target.closest("#request_elem").dataset.destination_city;
            document.querySelector("#d_o_e").innerHTML = e.target.closest("#request_elem").dataset.date_of_exit;
            document.querySelector("#d_o_r").innerHTML = e.target.closest("#request_elem").dataset.date_of_return;
            document.querySelector("#t_o_e").innerHTML = e.target.closest("#request_elem").dataset.time_of_exit;
            document.querySelector("#t_o_r").innerHTML = e.target.closest("#request_elem").dataset.time_of_return;
            document.querySelector("#guardian_name").innerHTML = e.target.closest("#request_elem").dataset.guardian_name;
            document.querySelector("#guardian_pn").innerHTML = e.target.closest("#request_elem").dataset.guardian_phone_number;
            document.querySelector("#requested_date").innerHTML = e.target.closest("#request_elem").dataset.date_requested;
            
            toggleModal();
        } catch (error) {
            if (error.message === `Cannot read properties of null (reading 'dataset')`){
                // Do nothing
            } else {
                console.log(error);
            }
        }
    }
})

accept_request_btn.addEventListener('click', () => {
    if (enable_search === true && data_fetched === true && pending_requests.length > 0){
        if (accepting_request === false && rejecting_request === false){
            enable_search = false;
            accepting_request = true;
            rejecting_request = false;
            document.getElementById('spinner').style.display = 'inline-block';
            document.getElementById('btn_txts').style.display = 'none';

            // Constructed request object
            let request = {
                method: 'POST',
                body: new URLSearchParams({
                    user_id: user_id,
                    request_id: request_id
                })
            }
            //--------------------------------

            fetch(`${main_url}/promise_project/api/hall_admin/accept_request.php`, request)
                .then((res) => res.json()) // Return response in JSON format
                .then(data => {
                    if (data.status === 'successful'){
                        pending_requests = [];
                        let array_data = data.result;
                        list_elem.innerHTML = '';
                        array_data.forEach(element => {
                            const node = document.createElement("div");
                            node.setAttribute("class", "mail");
                            node.setAttribute("id", "request_elem");
                            node.setAttribute("data-userid", element.id);
                            node.setAttribute("data-requestid", element.request_id);
                            node.setAttribute("data-destination_state", element.destination_state);
                            node.setAttribute("data-destination_city", element.destination_city);
                            node.setAttribute("data-date_of_exit", element.date_of_exit);
                            node.setAttribute("data-date_of_return", element.date_of_return);
                            node.setAttribute("data-time_of_exit", element.time_of_exit);
                            node.setAttribute("data-time_of_return", element.time_of_return);
                            node.setAttribute("data-guardian_name", element.guardian_name);
                            node.setAttribute("data-guardian_phone_number", element.guardian_phone_number);
                            node.setAttribute("data-date_requested", element.date_requested);
                            node.innerHTML = `
                                <div class="pfp">
                                    <img src="./images/FTqHfUcUsAA4WYG.jfif" alt="">
                                </div>
                                <div class="mail-synopsis">
                                    <h6 style="font-size: 0.97rem;">${element.name}</h6>
                                    <p><span style="font-weight: 600;">${element.matric_no}</span> (<span style="font-weight: 600;">Date: ${element.date_requested}</span>)</p>
                                </div>
                            `;

                            list_elem.appendChild(node);

                            pending_requests.push(element);
                        });

                        document.getElementById('spinner').style.display = 'none';
                        document.getElementById('btn_txts').style.display = 'inline-block';

                        toggleModal();

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        accepting_request = false;
                        rejecting_request = false;

                        render_modal('green', 'Success', 'Request accepted!'); // Display modal
                    } else if (data.status === 'role_error' || data.status === 'invalid_user'){
                        enable_search = false;
                        pending_requests = [];
                        window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index page
                    } else if (data.status === 'invalid' || data.status === 'invalid_user_id' || data.status === 'invalid_request_id'){
                        document.getElementById('spinner').style.display = 'none';
                        document.getElementById('btn_txts').style.display = 'inline-block';

                        accepting_request = false;
                        rejecting_request = false;

                        toggleModal();

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('red', 'Error', 'An error occured!'); // Display modal
                    } else if (data.status === 'request_does_not_exist'){
                        document.getElementById('spinner').style.display = 'none';
                        document.getElementById('btn_txts').style.display = 'inline-block';

                        accepting_request = false;
                        rejecting_request = false;

                        toggleModal();

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('red', 'Error', 'This request does not exist!'); // Display modal
                    } else if (data.status === 'successful_with_no_data'){
                        document.getElementById('spinner').style.display = 'none';
                        document.getElementById('btn_txts').style.display = 'inline-block';

                        accepting_request = false;
                        rejecting_request = false;

                        toggleModal();

                        list_elem.innerHTML =  `
                            <div id="error_placement">
                                <img id="cancel_icon" src="images/no_data.png" alt="">
                                <p id="error_text">No pending requests!</p>
                            </div>
                        `;

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('green', 'Success', 'Request accepted!'); // Display modal

                        pending_requests = [];
                        enable_search = true;
                        data_fetched = false;
                    }
                })
                .catch(err => {
                    document.getElementById('spinner').style.display = 'none';
                    document.getElementById('btn_txts').style.display = 'inline-block';
                    enable_search = true;

                    accepting_request = false;
                    rejecting_request = false;

                    toggleModal();

                    user_id = null;
                    request_id = null;

                    enable_search = true;

                    render_modal('red', 'Error', 'An error occured!'); // Display modal
                })
        }
    }
})

// Reject student request
leave_request_btn.addEventListener('click', () => {
    if (enable_search === true && data_fetched === true && pending_requests.length > 0){
        if (accepting_request === false && rejecting_request === false){
            enable_search = false;
            accepting_request = false;
            rejecting_request = true;
            enable_search = false;
            document.getElementById('spinner_2').style.display = 'inline-block';
            document.getElementById('btn_txts_2').style.display = 'none';

            // Constructed request object
            let request = {
                method: 'POST',
                body: new URLSearchParams({
                    user_id: user_id,
                    request_id: request_id
                })
            }
            //--------------------------------

            fetch(`${main_url}/promise_project/api/hall_admin/reject_request.php`, request)
                .then((res) => res.json()) // Return response in JSON format
                .then(data => {
                    if (data.status === 'successful'){
                        pending_requests = [];
                        let array_data = data.result;
                        list_elem.innerHTML = '';
                        array_data.forEach(element => {
                            const node = document.createElement("div");
                            node.setAttribute("class", "mail");
                            node.setAttribute("id", "request_elem");
                            node.setAttribute("data-userid", element.id);
                            node.setAttribute("data-requestid", element.request_id);
                            node.setAttribute("data-destination_state", element.destination_state);
                            node.setAttribute("data-destination_city", element.destination_city);
                            node.setAttribute("data-date_of_exit", element.date_of_exit);
                            node.setAttribute("data-date_of_return", element.date_of_return);
                            node.setAttribute("data-time_of_exit", element.time_of_exit);
                            node.setAttribute("data-time_of_return", element.time_of_return);
                            node.setAttribute("data-guardian_name", element.guardian_name);
                            node.setAttribute("data-guardian_phone_number", element.guardian_phone_number);
                            node.setAttribute("data-date_requested", element.date_requested);
                            node.innerHTML = `
                                <div class="pfp">
                                    <img src="./images/FTqHfUcUsAA4WYG.jfif" alt="">
                                </div>
                                <div class="mail-synopsis">
                                    <h6 style="font-size: 0.97rem;">${element.name}</h6>
                                    <p><span style="font-weight: 600;">${element.matric_no}</span> (<span style="font-weight: 600;">Date: ${element.date_requested}</span>)</p>
                                </div>
                            `;

                            list_elem.appendChild(node);

                            pending_requests.push(element);
                        });

                        document.getElementById('spinner_2').style.display = 'none';
                        document.getElementById('btn_txts_2').style.display = 'inline-block';

                        toggleModal();

                        accepting_request = false;
                        rejecting_request = false;

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('green', 'Success', 'Request rejected!'); // Display modal
                    } else if (data.status === 'role_error' || data.status === 'invalid_user'){
                        enable_search = false;
                        pending_requests = [];
                        window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index page
                    } else if (data.status === 'invalid' || data.status === 'invalid_user_id' || data.status === 'invalid_request_id'){
                        document.getElementById('spinner_2').style.display = 'none';
                        document.getElementById('btn_txts_2').style.display = 'inline-block';

                        accepting_request = false;
                        rejecting_request = false;

                        toggleModal();

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('red', 'Error', 'An error occured!'); // Display modal
                    } else if (data.status === 'request_does_not_exist'){
                        document.getElementById('spinner_2').style.display = 'none';
                        document.getElementById('btn_txts_2').style.display = 'inline-block';

                        accepting_request = false;
                        rejecting_request = false;

                        toggleModal();

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('red', 'Error', 'This request does not exist!'); // Display modal
                    } else if (data.status === 'successful_with_no_data'){
                        document.getElementById('spinner_2').style.display = 'none';
                        document.getElementById('btn_txts_2').style.display = 'inline-block';

                        accepting_request = false;
                        rejecting_request = false;

                        toggleModal();

                        list_elem.innerHTML =  `
                            <div id="error_placement">
                                <img id="cancel_icon" src="images/no_data.png" alt="">
                                <p id="error_text">No pending requests!</p>
                            </div>
                        `;

                        user_id = null;
                        request_id = null;

                        enable_search = true;

                        render_modal('green', 'Success', 'Request rejected!'); // Display modal

                        pending_requests = [];
                        enable_search = true;
                        data_fetched = false;
                    }
                })
                .catch(err => {
                    document.getElementById('spinner_2').style.display = 'none';
                    document.getElementById('btn_txts_2').style.display = 'inline-block';
                    enable_search = true;

                    accepting_request = false;
                    rejecting_request = false;

                    toggleModal();

                    user_id = null;
                    request_id = null;

                    enable_search = true;

                    render_modal('red', 'Error', 'An error occured!'); // Display modal
                })
        }
    }
})
//---------------------------------------------------------------

// Run when the page is initially loaded
window.onload = async function run_on_load(){
    fetch(`${main_url}/promise_project/api/hall_admin/get_all_requests.php`)
        .then((res) => res.json()) // Return response in JSON format
        .then(data => {
            if (data.status === 'successful'){
                let array_data = data.result;
                list_elem.innerHTML = '';
                array_data.forEach(element => {
                    const node = document.createElement("div");
                    node.setAttribute("class", "mail");
                    node.setAttribute("id", "request_elem");
                    node.setAttribute("data-userid", element.id);
                    node.setAttribute("data-requestid", element.request_id);
                    node.setAttribute("data-destination_state", element.destination_state);
                    node.setAttribute("data-destination_city", element.destination_city);
                    node.setAttribute("data-date_of_exit", element.date_of_exit);
                    node.setAttribute("data-date_of_return", element.date_of_return);
                    node.setAttribute("data-time_of_exit", element.time_of_exit);
                    node.setAttribute("data-time_of_return", element.time_of_return);
                    node.setAttribute("data-guardian_name", element.guardian_name);
                    node.setAttribute("data-guardian_phone_number", element.guardian_phone_number);
                    node.setAttribute("data-date_requested", element.date_requested);
                    node.innerHTML = `
                        <div class="pfp">
                            <img src="./images/FTqHfUcUsAA4WYG.jfif" alt="">
                        </div>
                        <div class="mail-synopsis">
                            <h6 style="font-size: 0.97rem;">${element.name}</h6>
                            <p><span style="font-weight: 600;">${element.matric_no}</span> (<span style="font-weight: 600;">Date: ${element.date_requested}</span>)</p>
                        </div>
                    `;

                    list_elem.appendChild(node);

                    pending_requests.push(element);
                });

                enable_search = true;
                data_fetched = true;
            } else if (data.status === 'role_error'){
                enable_search = false;
                data_fetched = false;
                pending_requests = [];
                window.location.href = main_url + '/promise_project/index.php'; // Redirect user to the index page
            } else if (data.status === 'no_data_available'){
                list_elem.innerHTML =  `
                    <div id="error_placement">
                        <img id="cancel_icon" src="images/no_data.png" alt="">
                        <p id="error_text">No pending requests!</p>
                    </div>
                `;

                pending_requests = [];

                enable_search = true;
                data_fetched = false;
            }
        })
        .catch(err => {
            list_elem.innerHTML =  `
                <div id="error_placement">
                    <img id="cancel_icon" src="images/cancel.png" alt="">
                    <p id="error_text">An error occured!</p>
                </div>
            `;

            pending_requests = [];

            enable_search = true;
            data_fetched = false;
        })
}
//-------------------------------------------------