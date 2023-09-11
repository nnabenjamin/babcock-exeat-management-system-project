<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <?php 
      if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])){ 
        if ($_SESSION['role'] === 'Student'){
          echo "<p>Redirecting...</p>";
          header("Location: http://localhost/promise_project/student/form.php");
        } else if ($_SESSION['role'] === 'Admin'){
          echo '
            <div class="cover">
              <div class="container_x">
                <div class="container-child">
                  <div class="mailbox">
                    <div class="mailbox-items">
                      <div class="mailbox-header">
                        <i class="fa-solid fa-caret-left fa-2x"></i>
                        <h2>Mailbox</h2>
                      </div>
                      <hr/>
                      <div class="inbox mailbox-item">
                        <i class="fa-solid fa-inbox"></i>
                        <h3 style="font-size: 1.3rem;">Inbox</h3>
                      </div>
                      <div id="logout_btn" class="draft mailbox-item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <h3 style="font-size: 1.3rem;">Logout</h3>
                      </div>
                    </div>
                    <div class="mails">
                      <div class="mail-items">
                        <div class="search-div">
                          <input type="search" name="" placeholder="Search" id="search_bar_x" class="search-bar">
                        </div>
                        <div id="gate_pass_requests">
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
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- The Modal -->
            <div id="myModal" class="modal">
              <!-- Modal content -->
              <div class="modal-content">
                <div class="modal-header" id="m_head">
                  <span class="close">&times;</span>
                  <h2 id="head_txt">Modal Header</h2>
                </div>
                <div class="modal-body" id="box_txt"></div>
                <div class="modal-footer" id="m_foot"></div>
              </div>
            </div>

            <div class="modal_x">
                <div class="modal-content_x">
                    <span class="close-button_x">×</span>
                    <div id="djuu7ax">
                      <p id="jsy7">Destination state: <span id="dest_state"></span></p>
                      <p id="jsy7">Destination city: <span id="dest_city"></span></p>
                      <p id="jsy7">Date of exit: <span id="d_o_e"></span></p>
                      <p id="jsy7">Date of return: <span id="d_o_r"></span></p>
                      <p id="jsy7">Time of exit: <span id="t_o_e"></span></p>
                      <p id="jsy7">Time of return: <span id="t_o_r"></span></p>
                      <p id="jsy7">Guardian name: <span id="guardian_name"></span></p>
                      <p id="jsy7">Guardian phone number: <span id="guardian_pn"></span></p>
                      <p id="jsy7">Date requested: <span id="requested_date"></span></p>
                    </div>
                    <div id="nhs7n">
                      <h4 id="aga6">Do you want to accept this request?</h4>
                      <div id="modal_btns">
                        <span id="accept_request" class="modal_based_btn">
                          <img id="spinner" src="../../Image/spinner.png" alt="">
                          <span id="btn_txts">Yes</span>
                        </span>
                        <span id="leave_request" class="modal_based_btn" style="margin-left: 10px;">
                          <img id="spinner_2" src="../../Image/spinner.png" alt="">
                          <span id="btn_txts_2">No</span>
                        </span>
                      </div>
                    </div>
                </div>
            </div>

            <script src="../../JS/utility.js"></script>
            <script src="../dashboard/js/dashboard.js"></script>
          ';
        }
      } else {
        echo "<p>Redirecting...</p>";
        header("Location: http://localhost/promise_project/index.php");
      }
    ?>
  </body>
</html>
