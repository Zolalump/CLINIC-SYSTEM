// Global variables
let currentUser = {
    name: "Student, User",
    email: "studentuser@gmail.com",
    course: "Computer Science",
    year: "4th Year",
    id: "2020-12345",
    gender: "Female",
    birthdate: "Oct 25, 1992",
    phone: "0912-345-6789",
    address: "123 Main St., City",
    bp: "120/80 mmHg",
    weight: "65 kg",
    temp: "36.5°C"
};

let medications = [
    {
        name: "ACTRAPID HM1",
        dosage: "Amoxyl 1mg",
        startDate: "08/24/2024",
        assignedBy: "Patient",
        status: "Process"
    },
    {
        name: "ACTRAPID HM1",
        dosage: "Amoxyl 1mg",
        startDate: "08/24/2024",
        assignedBy: "Patient",
        status: "Complete"
    },
    {
        name: "ACTRAPID HM1",
        dosage: "Amoxyl 1mg",
        startDate: "08/24/2024",
        assignedBy: "Patient",
        status: "Process"
    }
];

let complaints = [
    { name: "Fever", severity: "severe" },
    { name: "Diarrhea", severity: "severe" },
    { name: "Cough", severity: "mild" },
    { name: "Asthma", severity: "mild" },
    { name: "Asthma", severity: "mild" }
];

let notes = "";

let records = [
    { assignedNurse: "Mike Pedrera", date: "08/21/2024", disease: "Asthma", status: "Pending" },
    { assignedNurse: "Mike Pedrera", date: "08/21/2024", disease: "Anemia", status: "Pending" },
    { assignedNurse: "Mike Pedrera", date: "08/21/2024", disease: "Fever", status: "Pending" },
    { assignedNurse: "Mike Pedrera", date: "08/21/2024", disease: "Fever", status: "Pending" }
];

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    setupNavigation();
    setupStudentTabs();
    setupEditButtons();
    setupModal();
    checkSevereComplaints();
    loadUserData();
    loadMedicationsTable();
    loadComplaintsList();
    loadRecordsTable();
    updateProfileBorder();
}

// Navigation functionality
function setupNavigation() {
    const navButtons = document.querySelectorAll('.nav-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            navButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        });
    });
}

// Student tabs functionality
function setupStudentTabs() {
    const studentTabs = document.querySelectorAll('.student-tab');
    const studentTabContents = document.querySelectorAll('.student-tab-content');

    studentTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.getAttribute('data-student-tab');
            
            studentTabs.forEach(t => t.classList.remove('active'));
            studentTabContents.forEach(content => content.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        });
    });
}

// Edit buttons functionality
function setupEditButtons() {
    const editButtons = document.querySelectorAll('.edit-btn, .edit-profile-btn, .add-notes-btn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const editType = this.getAttribute('data-edit') || 'profile';
            openEditModal(editType);
        });
    });
}

// Modal functionality
function setupModal() {
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close');
    const cancelBtn = document.querySelector('.btn-cancel');
    const saveBtn = document.querySelector('.btn-save');

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    saveBtn.addEventListener('click', saveChanges);

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Delegate remove button clicks inside modal for dynamic content
    modal.querySelector('#modalBody').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove')) {
            // Determine the parent row and its index
            const parentRow = e.target.closest('.medication-row') || e.target.closest('.complaint-row') || e.target.closest('.record-row');
            if (!parentRow) return;
            const index = parseInt(parentRow.getAttribute('data-index'));
            if (isNaN(index)) return;

            // Remove accordingly based on modal's edit type
            const modalEditType = modal.getAttribute('data-edit-type');
            if(modalEditType === 'medications') {
                removeMedication(index);
            } else if (modalEditType === 'complaints') {
                removeComplaint(index);
            } else if (modalEditType === 'records') {
                removeRecord(index);
            }
        }
    });
}

function openEditModal(editType) {
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');

    modal.style.display = 'block';
    modal.setAttribute('data-edit-type', editType);

    switch(editType) {
        case 'profile':
            modalTitle.textContent = 'Edit Profile';
            modalBody.innerHTML = getProfileEditForm();
            break;
        case 'medications':
            modalTitle.textContent = 'Edit Medications';
            modalBody.innerHTML = getMedicationsEditForm();
            break;
        case 'complaints':
            modalTitle.textContent = 'Edit Chief Complaints';
            modalBody.innerHTML = getComplaintsEditForm();
            break;
        case 'notes':
            modalTitle.textContent = 'Add Notes';
            modalBody.innerHTML = getNotesEditForm();
            break;
        case 'records':
            modalTitle.textContent = 'Edit Records';
            modalBody.innerHTML = getRecordsEditForm();
            break;
    }
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

function saveChanges() {
    const modal = document.getElementById('editModal');
    const editType = modal.getAttribute('data-edit-type');

    switch(editType) {
        case 'profile':
            saveProfileChanges();
            break;
        case 'medications':
            saveMedicationChanges();
            break;
        case 'complaints':
            saveComplaintChanges();
            break;
        case 'notes':
            saveNotesChanges();
            break;
        case 'records':
            saveRecordsChanges();
            break;
    }

    closeModal();
}

// Form generators

function getProfileEditForm() {
    return `
        <div class="form-row">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="edit-name" value="${currentUser.name}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="edit-email" value="${currentUser.email}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Course and Year</label>
                <input type="text" id="edit-course" value="${currentUser.course} - ${currentUser.year}">
            </div>
            <div class="form-group">
                <label>ID Number</label>
                <input type="text" id="edit-id" value="${currentUser.id}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Gender</label>
                <select id="edit-gender">
                    <option value="Female" ${currentUser.gender === 'Female' ? 'selected' : ''}>Female</option>
                    <option value="Male" ${currentUser.gender === 'Male' ? 'selected' : ''}>Male</option>
                </select>
            </div>
            <div class="form-group">
                <label>Birthdate</label>
                <input type="date" id="edit-birthdate" value="1992-10-25">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="edit-phone" value="${currentUser.phone}">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" id="edit-address" value="${currentUser.address}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Blood Pressure</label>
                <input type="text" id="edit-bp" value="${currentUser.bp}">
            </div>
            <div class="form-group">
                <label>Weight</label>
                <input type="text" id="edit-weight" value="${currentUser.weight}">
            </div>
        </div>
        <div class="form-group">
            <label>Temperature</label>
            <input type="text" id="edit-temp" value="${currentUser.temp}">
        </div>
    `;
}

function getMedicationsEditForm() {
    let medicationRows = medications.map((med, index) => `
        <div class="medication-row" data-index="${index}">
            <div class="form-row">
                <div class="form-group">
                    <label>Medication Name</label>
                    <input type="text" value="${med.name}" data-field="name">
                </div>
                <div class="form-group">
                    <label>Dosage</label>
                    <input type="text" value="${med.dosage}" data-field="dosage">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" value="2024-08-24" data-field="startDate">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select data-field="status">
                        <option value="Process" ${med.status === 'Process' ? 'selected' : ''}>Process</option>
                        <option value="Complete" ${med.status === 'Complete' ? 'selected' : ''}>Complete</option>
                        <option value="Pending" ${med.status === 'Pending' ? 'selected' : ''}>Pending</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn-remove">Remove</button>
            <hr style="margin: 20px 0;">
        </div>
    `).join('');

    return `
        ${medicationRows}
        <button type="button" class="btn-add" onclick="addMedication()">Add New Medication</button>
    `;
}

function getComplaintsEditForm() {
    let complaintRows = complaints.map((complaint, index) => `
        <div class="complaint-row" data-index="${index}">
            <div class="form-row">
                <div class="form-group">
                    <label>Complaint</label>
                    <input type="text" value="${complaint.name}" data-field="name">
                </div>
                <div class="form-group">
                    <label>Severity</label>
                    <select data-field="severity">
                        <option value="mild" ${complaint.severity === 'mild' ? 'selected' : ''}>Mild</option>
                        <option value="severe" ${complaint.severity === 'severe' ? 'selected' : ''}>Severe</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn-remove">Remove</button>
            <hr style="margin: 20px 0;">
        </div>
    `).join('');

    return `
        ${complaintRows}
        <button type="button" class="btn-add" onclick="addComplaint()">Add New Complaint</button>
    `;
}

function getNotesEditForm() {
    return `
        <div class="form-group">
            <label>Notes</label>
            <textarea id="edit-notes" rows="10" placeholder="Add notes for other info...">${notes}</textarea>
        </div>
    `;
}

// Records edit form for modal
function getRecordsEditForm() {
    if(records.length === 0) {
        return `<p>No records available.</p>`;
    }

    let recordRows = records.map((rec, index) => `
        <div class="record-row" data-index="${index}">
            <div class="form-row">
                <div class="form-group">
                    <label>Assigned Nurse</label>
                    <input type="text" value="${rec.assignedNurse}" data-field="assignedNurse" />
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" value="${formatDateISO(rec.date)}" data-field="date" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Disease</label>
                    <input type="text" value="${rec.disease}" data-field="disease" />
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select data-field="status">
                        <option value="Pending" ${rec.status === 'Pending' ? 'selected' : ''}>Pending</option>
                        <option value="Complete" ${rec.status === 'Complete' ? 'selected' : ''}>Complete</option>
                        <option value="Process" ${rec.status === 'Process' ? 'selected' : ''}>Process</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn-remove">Remove</button>
            <hr style="margin: 20px 0;">
        </div>
    `).join('');

    return `
        ${recordRows}
        <button type="button" class="btn-add" onclick="addRecord()">Add New Record</button>
    `;
}

// Utility to format date string (e.g. "08/21/2024" => "2024-08-21")
function formatDateISO(dateStr) {
    let parts = dateStr.split('/');
    if(parts.length === 3) {
        let [m, d, y] = parts;
        if(y.length === 4) {
            return `${y}-${m.padStart(2,'0')}-${d.padStart(2,'0')}`;
        }
    }
    return dateStr;
}

// Save functions

function saveProfileChanges() {
    currentUser.name = document.getElementById('edit-name').value;
    currentUser.email = document.getElementById('edit-email').value;
    
    const courseYear = document.getElementById('edit-course').value.split(' - ');
    currentUser.course = courseYear[0] || currentUser.course;
    currentUser.year = courseYear[1] || currentUser.year;
    
    currentUser.id = document.getElementById('edit-id').value;
    currentUser.gender = document.getElementById('edit-gender').value;
    currentUser.phone = document.getElementById('edit-phone').value;
    currentUser.address = document.getElementById('edit-address').value;
    currentUser.bp = document.getElementById('edit-bp').value;
    currentUser.weight = document.getElementById('edit-weight').value;
    currentUser.temp = document.getElementById('edit-temp').value;

    loadUserData();
}

function saveMedicationChanges() {
    const medicationRows = document.querySelectorAll('.medication-row');
    medications = [];

    medicationRows.forEach(row => {
        const medication = {
            name: row.querySelector('[data-field="name"]').value,
            dosage: row.querySelector('[data-field="dosage"]').value,
            startDate: row.querySelector('[data-field="startDate"]').value,
            assignedBy: "Patient",
            status: row.querySelector('[data-field="status"]').value
        };
        medications.push(medication);
    });

    loadMedicationsTable();
}

function saveComplaintChanges() {
    const complaintRows = document.querySelectorAll('.complaint-row');
    complaints = [];

    complaintRows.forEach(row => {
        const complaint = {
            name: row.querySelector('[data-field="name"]').value,
            severity: row.querySelector('[data-field="severity"]').value
        };
        complaints.push(complaint);
    });

    loadComplaintsList();
    checkSevereComplaints();
    updateProfileBorder();
}

function saveNotesChanges() {
    notes = document.getElementById('edit-notes').value;
    document.querySelector('.notes-textarea').value = notes;
}

function saveRecordsChanges() {
    const recordRows = document.querySelectorAll('.record-row');
    records = [];

    recordRows.forEach(row => {
        const record = {
            assignedNurse: row.querySelector('[data-field="assignedNurse"]').value,
            date: row.querySelector('[data-field="date"]').value,
            disease: row.querySelector('[data-field="disease"]').value,
            status: row.querySelector('[data-field="status"]').value
        };
        records.push(record);
    });

    loadRecordsTable();
}

// Add/Remove functions

function addMedication() {
    medications.push({
        name: "New Medication",
        dosage: "",
        startDate: new Date().toISOString().split('T')[0],
        assignedBy: "Patient",
        status: "Pending"
    });
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = getMedicationsEditForm();
}

function removeMedication(index) {
    if (index >= 0 && index < medications.length) {
        medications.splice(index, 1);
        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = getMedicationsEditForm();
    }
}

function addComplaint() {
    complaints.push({
        name: "New Complaint",
        severity: "mild"
    });
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = getComplaintsEditForm();
}

function removeComplaint(index) {
    if (index >= 0 && index < complaints.length) {
        complaints.splice(index, 1);
        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = getComplaintsEditForm();
    }
}

function addRecord() {
    records.push({
        assignedNurse: "New Nurse",
        date: new Date().toISOString().split('T')[0],
        disease: "New Disease",
        status: "Pending"
    });
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = getRecordsEditForm();
}

function removeRecord(index) {
    if (index >= 0 && index < records.length) {
        records.splice(index, 1);
        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = getRecordsEditForm();
    }
}

// Load data functions

function loadUserData() {
    document.querySelector('.profile-header h3').textContent = currentUser.name;
    document.querySelector('.profile-header p').textContent = currentUser.email;

    const detailRows = document.querySelectorAll('.detail-row');
    const details = [
        `${currentUser.course} - ${currentUser.year}`,
        currentUser.id,
        currentUser.gender,
        currentUser.birthdate,
        currentUser.phone,
        currentUser.address,
        currentUser.bp,
        currentUser.weight,
        currentUser.temp
    ];

    detailRows.forEach((row, index) => {
        if (index < details.length) {
            const valueSpan = row.querySelector('.value');
            if (valueSpan) {
                valueSpan.textContent = details[index];
            }
        }
    });
}

function loadMedicationsTable() {
    const tbody = document.querySelector('.medications-table tbody');
    if (!tbody) return;

    tbody.innerHTML = medications.map(med => `
        <tr>
            <td><i class="fas fa-pills"></i> ${med.name}<br><small>${med.dosage}</small></td>
            <td>${med.startDate}</td>
            <td><span class="assigned-by">${med.assignedBy}</span></td>
            <td><span class="status ${med.status.toLowerCase()}">${med.status}</span></td>
        </tr>
    `).join('');
}

function loadComplaintsList() {
    const complaintsList = document.getElementById('complaintsList');
    if (!complaintsList) return;

    complaintsList.innerHTML = complaints.map(complaint => `
        <div class="complaint-item ${complaint.severity}">
            <span class="complaint-name">${complaint.name}</span>
            <span class="severity ${complaint.severity}">${complaint.severity.charAt(0).toUpperCase() + complaint.severity.slice(1)}</span>
        </div>
    `).join('');
}

// Load Records Table with no buttons inside table (buttons moved outside)
function loadRecordsTable() {
    const recordsTbody = document.querySelector('#records tbody');
    if (!recordsTbody) return;

    recordsTbody.innerHTML = records.map((rec, idx) => `
        <tr data-index="${idx}">
            <td><i class="fas fa-user"></i> ${rec.assignedNurse}</td>
            <td>${rec.date}</td>
            <td>${rec.disease}</td>
            <td><span class="status ${rec.status.toLowerCase()}">${rec.status}</span></td>
        </tr>
    `).join('');
}

// Complaint border update functions
function updateProfileBorder() {
    const studentProfile = document.getElementById('studentProfile');

    const hasSevere = complaints.some(c => c.severity.toLowerCase() === 'severe');
    const allMild = complaints.length > 0 && complaints.every(c => c.severity.toLowerCase() === 'mild');

    studentProfile.classList.remove('mild-complaints', 'severe-complaints', 'has-severe-complaints');

    if (hasSevere) {
        studentProfile.classList.add('severe-complaints');
    } else if (allMild) {
        studentProfile.classList.add('mild-complaints');
    }
}

function checkSevereComplaints() {
    const studentProfile = document.getElementById('studentProfile');
    const hasSevereComplaints = complaints.some(complaint => complaint.severity.toLowerCase() === 'severe');
    
    if (hasSevereComplaints) {
        studentProfile.classList.add('has-severe-complaints');
    } else {
        studentProfile.classList.remove('has-severe-complaints');
    }
}
