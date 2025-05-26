<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SMCTI Clinic</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
      
        <header class="header">
            <div class="logo-section">
                <div class="logo-circle">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="clinic-name">
                    <h1>SMCTI</h1>
                    <h2>Clinic</h2>
                </div>
            </div>

            <div class="search-section">
                <div class="search-bar">
                    <input type="text" placeholder="Search students..." id="searchInput" />
                    <button id="searchBtn"><i class="fas fa-search"></i></button>
                </div>
                
                <div class="search-results" id="searchResults" style="display: none;">
                    
                </div>
            </div>

            <div class="header-right">
                <div class="datetime">10:50 AM Today, 28 May 2020</div>
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">4</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Maam Z</span>
                        <span class="user-role">Admin</span>
                    </div>
                </div>
            </div>
        </header>

   
        <nav class="navigation">
            <button class="nav-btn" data-tab="dashboard">Dashboard</button>
            <button class="nav-btn active" data-tab="student">Student</button>
            <button class="nav-btn" data-tab="history">History</button>
            <button class="nav-btn" data-tab="reports">Reports</button>
        </nav>

        <main class="main-content">
         
            <div id="dashboard" class="tab-content">
                <div class="dashboard-content">
                    <h2>Dashboard</h2>
                    <p>Dashboard content will be displayed here.</p>
                </div>
            </div>

            
            <div id="student" class="tab-content active">
                <div class="student-layout">
                
                    <div class="student-profile" id="studentProfile">
                        <div class="profile-header">
                            <div class="profile-image">
                                <i class="fas fa-user"></i>
                                <button class="edit-profile-btn" title="Edit Profile">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <h3>Student, User</h3>
                            <p>studentuser@gmail.com</p>
                        </div>

                        <div class="student-details">
                            <div class="detail-row">
                                <span class="label">Course and Year</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">ID number</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Gender</span>
                                <span class="value">Female</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Birthdate</span>
                                <span class="value">Oct 25, 1992</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Phone number</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Address</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">BP</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Weight</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Temp</span>
                                <span class="value">xxxxxxxxxxxx</span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="student-main">
                        
                        <div class="student-tabs-and-edit">
                            <div class="student-tabs">
                                <button class="student-tab active" data-student-tab="records">Records</button>
                                <button class="student-tab" data-student-tab="medical-records">Medical Records</button>
                            </div>
                           
                            <button class="edit-btn" data-edit="records" id="editRecordsBtn">
                                <i class="fas fa-pen"></i> Edit Records
                            </button>
                        </div>

                     
                        <div id="records" class="student-tab-content active">
                            <div class="records-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Assigned Nurse</th>
                                            <th>Date</th>
                                            <th>Disease</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                    </tbody>
                                </table>
                            </div>

                           
                            <div class="medications-section">
                                <div class="section-header">
                                    <h3><i class="fas fa-pills"></i> Medications</h3>
                                   
                                </div>
                                <div class="medications-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Start Date</th>
                                                <th>Assigned by</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                        <div id="medical-records" class="student-tab-content">
                            <p>Medical records content will be displayed here.</p>
                        </div>
                    </div>

                    
                    <div class="right-sidebar">
                       
                        <div class="chief-complaints">
                            <div class="section-header">
                                <h3>Chief Complaints</h3>
                                <button class="edit-btn" data-edit="complaints">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="complaints-list" id="complaintsList">
                                
                            </div>
                        </div>

                      
                        <div class="notes-section">
                            <div class="section-header">
                                <h3>Notes</h3>
                                <button class="add-notes-btn" data-edit="notes">
                                    <i class="fas fa-plus"></i> Add Notes
                                </button>
                            </div>
                            <div class="notes-content">
                                <p class="notes-subtitle">Add notes for other info</p>
                                <textarea class="notes-textarea" placeholder="Add text..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
            <div id="history" class="tab-content">
                <div class="history-content">
                    <h2>History</h2>
                    <p>History content will be displayed here.</p>
                </div>
            </div>

            
            <div id="reports" class="tab-content">
                <div class="reports-content">
                    <h2>Reports</h2>
                    <p>Reports content will be displayed here.</p>
                </div>
            </div>
        </main>
    </div>

    
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Edit</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body" id="modalBody">
                
            </div>
            <div class="modal-footer">
                <button class="btn-cancel">Cancel</button>
                <button class="btn-save">Save</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>