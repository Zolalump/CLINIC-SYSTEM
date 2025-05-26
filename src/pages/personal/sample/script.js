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

// Sample student database for search functionality
let studentsDatabase = [
    {
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
    },
    {
        name: "John Ellemeleck",
        email: "johnellemeleck@gmail.com",
        course: "Computer Science",
        year: "3rd Year",
        id: "2020-67890",
        gender: "Male",
        birthdate: "Mar 15, 1993",
        phone: "0912-567-8901",
        address: "456 Oak St., City",
        bp: "115/75 mmHg",
        weight: "70 kg",
        temp: "36.8°C"
    },
    {
        name: "Grace Cabilis",
        email: "gracecabilis@gmail.com",
        course: "Computer Science",
        year: "3rd Year",
        id: "2020-11111",
        gender: "Female",
        birthdate: "July 20,2005",
        phone: "0912-234-5678",
        address: "789 Pine St., City",
        bp: "110/70 mmHg",
        weight: "58 kg",
        temp: "36.2°C"
    }
];

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
    { name: "Fever", severity: "severe", medication: "Paracetamol", dosage: "500mg" },
    { name: "Diarrhea", severity: "severe", medication: "Loperamide", dosage: "2mg" },
    { name: "Cough", severity: "mild", medication: "Dextromethorphan", dosage: "15mg" },
    { name: "Asthma", severity: "mild", medication: "Salbutamol", dosage: "100mcg" },
    { name: "Headache", severity: "mild", medication: "Ibuprofen", dosage: "200mg" }
];

let notes = "";

let records = [
    { assignedNurse: "Maam Z", date: "05/21/2025", disease: "Asthma", status: "Pending" },
    { assignedNurse: "Maam Z", date: "05/22/2025", disease: "Anemia", status: "Pending" },
    { assignedNurse: "Maam Z", date: "05/23/2025", disease: "Fever", status: "Pending" },
    { assignedNurse: "Maam Z", date: "05/24/2025", disease: "Fever", status: "Pending" }
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
    setupSearch();
    checkSevereComplaints();
    loadUserData();
    loadMedicationsTable();
    loadComplaintsList();
    loadRecordsTable();
    updateProfileBorder();
}

// Search functionality
function setupSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const searchBtn = document.getElementById('searchBtn');

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        
        if (query.length === 0) {
            searchResults.style.display = 'none';
            return;
        }

        const filteredStudents = studentsDatabase.filter(student => 
            student.name.toLowerCase().includes(query) ||
            student.email.toLowerCase().includes(query) ||
            student.id.toLowerCase().includes(query)
        );

        displaySearchResults(filteredStudents);
    });

    searchBtn.addEventListener('click', function() {
        const query = searchInput.value.trim().toLowerCase();
        if (query.length > 0) {
            const filteredStudents = studentsDatabase.filter(student => 
                student.name.toLowerCase().includes(query) ||
                student.email.toLowerCase().includes(query) ||
                student.id.toLowerCase().includes(query)
            );
            displaySearchResults(filteredStudents);
        }
    });

    // Close search results when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });
}

function displaySearchResults(students) {
    const searchResults = document.getElementById('searchResults');
    
    if (students.length === 0) {
        searchResults.innerHTML = '<div class="search-result-item"><span>No students found</span></div>';
        searchResults.style.display = 'block';
        return;
    }

    searchResults.innerHTML = students.map(student => `
        <div class="search-result-item" onclick="selectStudent('${student.id}')">
            <div class="search-result-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="search-result-info">
                <div class="search-result-name">${student.name}</div>
                <div class="search-result-details">${student.id} • ${student.course}</div>
            </div>
        </div>
    `).join('');
    
    searchResults.style.display = 'block';
}

function selectStudent(studentId) {
    const student = studentsDatabase.find(s => s.id === studentId);
    if (student) {
        currentUser = { ...student };
        loadUserData();
        loadStudentSpecificData(studentId);
        
        // Hide search results and clear search input
        document.getElementById('searchResults').style.display = 'none';
        document.getElementById('searchInput').value = '';
        
        // Switch to student tab if not already active
        const studentTab = document.querySelector('[data-tab="student"]');
        const studentTabContent = document.getElementById('student');
        
        document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        studentTab.classList.add('active');
        studentTabContent.classList.add('active');
    }
}

function loadStudentSpecificData(studentId) {
    // Load student-specific medications, complaints, records, etc.
    // This would typically come from a database
    // For now, we'll use sample data
    
    // Reset complaints and update profile border
    loadComplaintsList();
    checkSevereComplaints();
    updateProfileBorder();
    
    // Reload other data
    loadMedicationsTable();
    loadRecordsTable();
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
            <div class="medication-inputs">
                <label>Prescribed Medication</label>
                <div class="medication-input-row">
                    <div class="form-group">
                        <label>Medication Name</label>
                        <input type="text" value="${complaint.medication || ''}" data-field="medication" placeholder="Enter medication name">
                    </div>
                    <div class="form-group">
                        <label>Dosage</label>
                        <input type="text" value="${complaint.dosage || ''}" data-field="dosage" placeholder="Enter dosage">
                    </div>
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

// Save functions
function saveProfileChanges() {
    currentUser.name = document.getElementById('edit-name').value;
    currentUser.email = document.getElementById('edit-email').value;
    
    const courseYear = document.getElementById('edit-course').value.split(' - ');
    currentUser.course = courseYear[0];
    currentUser.year = courseYear[1] || '';
    
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
    
    medicationRows.forEach((row, index) => {
        const name = row.querySelector('[data-field="name"]').value;
        const dosage = row.querySelector('[data-field="dosage"]').value;
        const startDate = row.querySelector('[data-field="startDate"]').value;
        const status = row.querySelector('[data-field="status"]').value;
        
        medications.push({
            name: name,
            dosage: dosage,
            startDate: formatDateDisplay(startDate),
            assignedBy: "Patient",
            status: status
        });
    });
    
    loadMedicationsTable();
}

function saveComplaintChanges() {
    const complaintRows = document.querySelectorAll('.complaint-row');
    complaints = [];
    
    complaintRows.forEach((row, index) => {
        const name = row.querySelector('[data-field="name"]').value;
        const severity = row.querySelector('[data-field="severity"]').value;
        const medication = row.querySelector('[data-field="medication"]').value;
        const dosage = row.querySelector('[data-field="dosage"]').value;
        
        const complaint = {
            name: name,
            severity: severity,
            medication: medication,
            dosage: dosage
        };
        
        complaints.push(complaint);
        
        // Add medication to medications table if provided
        if (medication && dosage) {
            medications.push({
                name: medication,
                dosage: dosage,
                startDate: new Date().toLocaleDateString('en-US', { 
                    month: '2-digit', 
                    day: '2-digit', 
                    year: 'numeric' 
                }),
                assignedBy: "Nurse",
                status: "Process"
            });
            
            // Add to records table
            records.push({
                assignedNurse: "Maam Z",
                date: new Date().toLocaleDateString('en-US', { 
                    month: '2-digit', 
                    day: '2-digit', 
                    year: 'numeric' 
                }),
                disease: name,
                status: "Process"
            });
        }
    });
    
    loadComplaintsList();
    loadMedicationsTable();
    loadRecordsTable();
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
    
    recordRows.forEach((row) => {
        const assignedNurse = row.querySelector('[data-field="assignedNurse"]').value;
        const date = row.querySelector('[data-field="date"]').value;
        const disease = row.querySelector('[data-field="disease"]').value;
        const status = row.querySelector('[data-field="status"]').value;
        
        records.push({
            assignedNurse: assignedNurse,
            date: formatDateDisplay(date),
            disease: disease,
            status: status
        });
    });
    
    loadRecordsTable();
}

// Add functions
function addMedication() {
    const modalBody = document.getElementById('modalBody');
    const newIndex = medications.length;
    
    const newMedicationRow = document.createElement('div');
    newMedicationRow.className = 'medication-row';
    newMedicationRow.setAttribute('data-index', newIndex);
    newMedicationRow.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>Medication Name</label>
                <input type="text" value="" data-field="name" placeholder="Enter medication name">
            </div>
            <div class="form-group">
                <label>Dosage</label>
                <input type="text" value="" data-field="dosage" placeholder="Enter dosage">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" value="${new Date().toISOString().split('T')[0]}" data-field="startDate">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select data-field="status">
                    <option value="Process" selected>Process</option>
                    <option value="Complete">Complete</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <button type="button" class="btn-remove">Remove</button>
        <hr style="margin: 20px 0;">
    `;
    
    const addButton = modalBody.querySelector('.btn-add');
    modalBody.insertBefore(newMedicationRow, addButton);
    
    medications.push({
        name: "",
        dosage: "",
        startDate: new Date().toLocaleDateString('en-US', { 
            month: '2-digit', 
            day: '2-digit', 
            year: 'numeric' 
        }),
        assignedBy: "Patient",
        status: "Process"
    });
}

function addComplaint() {
    const modalBody = document.getElementById('modalBody');
    const newIndex = complaints.length;
    
    const newComplaintRow = document.createElement('div');
    newComplaintRow.className = 'complaint-row';
    newComplaintRow.setAttribute('data-index', newIndex);
    newComplaintRow.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>Complaint</label>
                <input type="text" value="" data-field="name" placeholder="Enter complaint">
            </div>
            <div class="form-group">
                <label>Severity</label>
                <select data-field="severity">
                    <option value="mild" selected>Mild</option>
                    <option value="severe">Severe</option>
                </select>
            </div>
        </div>
        <div class="medication-inputs">
            <label>Prescribed Medication</label>
            <div class="medication-input-row">
                <div class="form-group">
                    <label>Medication Name</label>
                    <input type="text" value="" data-field="medication" placeholder="Enter medication name">
                </div>
                <div class="form-group">
                    <label>Dosage</label>
                    <input type="text" value="" data-field="dosage" placeholder="Enter dosage">
                </div>
            </div>
        </div>
        <button type="button" class="btn-remove">Remove</button>
        <hr style="margin: 20px 0;">
    `;
    
    const addButton = modalBody.querySelector('.btn-add');
    modalBody.insertBefore(newComplaintRow, addButton);
    
    complaints.push({
        name: "",
        severity: "mild",
        medication: "",
        dosage: ""
    });
}

function addRecord() {
    const modalBody = document.getElementById('modalBody');
    const newIndex = records.length;
    
    const newRecordRow = document.createElement('div');
    newRecordRow.className = 'record-row';
    newRecordRow.setAttribute('data-index', newIndex);
    newRecordRow.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>Assigned Nurse</label>
                <input type="text" value="Maam Z" data-field="assignedNurse" />
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" value="${new Date().toISOString().split('T')[0]}" data-field="date" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Disease</label>
                <input type="text" value="" data-field="disease" placeholder="Enter disease" />
            </div>
            <div class="form-group">
                <label>Status</label>
                <select data-field="status">
                    <option value="Pending" selected>Pending</option>
                    <option value="Complete">Complete</option>
                    <option value="Process">Process</option>
                </select>
            </div>
        </div>
        <button type="button" class="btn-remove">Remove</button>
        <hr style="margin: 20px 0;">
    `;
    
    const addButton = modalBody.querySelector('.btn-add');
    modalBody.insertBefore(newRecordRow, addButton);
    
records.push({
        assignedNurse: "Maam Z",
        date: new Date().toLocaleDateString('en-US', { 
            month: '2-digit', 
            day: '2-digit', 
            year: 'numeric' 
        }),
        disease: "",
        status: "Pending"
    });
}

// Remove functions
function removeMedication(index) {
    medications.splice(index, 1);
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = getMedicationsEditForm();
}

function removeComplaint(index) {
    complaints.splice(index, 1);
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = getComplaintsEditForm();
}

function removeRecord(index) {
    records.splice(index, 1);
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = getRecordsEditForm();
}

// Load data functions
function loadUserData() {
    // Update profile header
    document.querySelector('.student-profile h3').textContent = currentUser.name;
    document.querySelector('.student-profile p').textContent = currentUser.email;
    
    // Update detail rows
    const detailRows = document.querySelectorAll('.detail-row');
    const detailValues = [
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
        const valueSpan = row.querySelector('.value');
        if (valueSpan && detailValues[index]) {
            valueSpan.textContent = detailValues[index];
        }
    });
}

function loadMedicationsTable() {
    const tbody = document.querySelector('.medications-table tbody');
    tbody.innerHTML = medications.map(med => `
        <tr>
            <td>${med.name}</td>
            <td>${med.startDate}</td>
            <td>${med.assignedBy}</td>
            <td>
                <select class="status-dropdown" onchange="updateMedicationStatus(this, '${med.name}')">
                    <option value="Process" ${med.status === 'Process' ? 'selected' : ''}>Process</option>
                    <option value="Complete" ${med.status === 'Complete' ? 'selected' : ''}>Complete</option>
                    <option value="Pending" ${med.status === 'Pending' ? 'selected' : ''}>Pending</option>
                </select>
            </td>
        </tr>
    `).join('');
}

function updateMedicationStatus(selectElement, medicationName) {
    const newStatus = selectElement.value;
    const medication = medications.find(med => med.name === medicationName);
    if (medication) {
        medication.status = newStatus;
    }
}

function loadComplaintsList() {
    const complaintsList = document.getElementById('complaintsList');
    complaintsList.innerHTML = complaints.map(complaint => `
        <div class="complaint-item ${complaint.severity}">
            <div class="complaint-info">
                <span class="complaint-name">${complaint.name}</span>
                <span class="complaint-severity ${complaint.severity}">${complaint.severity}</span>
            </div>
            ${complaint.medication ? `
                <div class="complaint-medication">
                    <small>Medication: ${complaint.medication} - ${complaint.dosage}</small>
                </div>
            ` : ''}
        </div>
    `).join('');
}

function loadRecordsTable() {
    const tbody = document.querySelector('.records-table tbody');
    tbody.innerHTML = records.map(record => `
        <tr>
            <td>${record.assignedNurse}</td>
            <td>${record.date}</td>
            <td>${record.disease}</td>
            <td><span class="status-badge ${record.status.toLowerCase()}">${record.status}</span></td>
        </tr>
    `).join('');
}

// Utility functions
function formatDateDisplay(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        month: '2-digit', 
        day: '2-digit', 
        year: 'numeric' 
    });
}

function formatDateISO(dateString) {
    const [month, day, year] = dateString.split('/');
    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
}

function checkSevereComplaints() {
    const hasSevereComplaints = complaints.some(complaint => complaint.severity === 'severe');
    updateProfileBorder(hasSevereComplaints);
}

function updateProfileBorder(hasSevereComplaints = null) {
    const profileElement = document.getElementById('studentProfile');
    
    if (hasSevereComplaints === null) {
        hasSevereComplaints = complaints.some(complaint => complaint.severity === 'severe');
    }
    
    if (hasSevereComplaints) {
        profileElement.classList.add('severe-alert');
    } else {
        profileElement.classList.remove('severe-alert');
    }
}