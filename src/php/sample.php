<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /WebDa/booking/index.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/WebDa/booking/reserve.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="/WebDa/booking/src/output.css">
    <link rel="stylesheet" href="/WebDa/booking/font/Suisse/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

</head>

<style>
    body{
    margin-top:20px;
    color: #8e9194;
    background-color: #f4f6f9;
    }
    .text-muted {
        color: #aeb0b4 !important;
    }
    .text-muted {
        font-weight: 300;
    }

</style>

<body>
<div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        <h2 class="h3 mb-4 page-title">Settings</h2>
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Security</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Notifications</a>
                </li>
            </ul>
            <h5 class="mb-0 mt-5">Security Settings</h5>
            <p>These settings are helps you keep your account secure.</p>
            <div class="list-group mb-5 shadow">
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-2">Enable Activity Logs</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="activityLog" checked="">
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-2">2FA Authentication</strong>
                            <span class="badge badge-pill badge-success">Enabled</span>
                            <p class="text-muted mb-0">Maecenas sed diam eget risus varius blandit.</p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary btn-sm">Disable</button>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-2">Activate Pin Code</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="pinCode">
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="mb-0">Recent Activity</h5>
            <p>Last activities with your account.</p>
            <table class="table border bg-white">
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>Location</th>
                        <th>IP</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - Windows 10</th>
                        <td>Paris, France</td>
                        <td>192.168.1.10</td>
                        <td>Apr 24, 2019</td>
                        <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                    </tr>
                    <tr>
                        <th scope="col"><i class="fe fe-smartphone fe-12 text-muted mr-2"></i>App - Mac OS</th>
                        <td>Newyork, USA</td>
                        <td>10.0.0.10</td>
                        <td>Apr 24, 2019</td>
                        <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                    </tr>
                    <tr>
                        <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - iOS</th>
                        <td>London, UK</td>
                        <td>255.255.255.0</td>
                        <td>Apr 24, 2019</td>
                        <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>