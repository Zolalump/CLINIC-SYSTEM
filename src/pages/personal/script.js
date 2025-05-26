
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

// Initialize sections as empty by default
let medications = [];
let complaints = [];
let notes = "";
let records = [];

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
     setupStudentTabs();
    setupEditButtons();
    setupModal();
    setupSearch();
    setupAllButtons(); 
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

    if (!searchInput || !searchResults) return;

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

    if (searchBtn) {
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
    }

    // Close search results when clicking outside
    document.addEventListener('click', function(event) {
        if (searchInput && searchResults && !searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });
}

function displaySearchResults(students) {
    const searchResults = document.getElementById('searchResults');
    if (!searchResults) return;
    
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
        const searchResults = document.getElementById('searchResults');
        const searchInput = document.getElementById('searchInput');
        if (searchResults) searchResults.style.display = 'none';
        if (searchInput) searchInput.value = '';
        
        // Switch to student tab if not already active
        const studentTab = document.querySelector('[data-tab="student"]');
        const studentTabContent = document.getElementById('student');
        
        if (studentTab && studentTabContent) {
            document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            studentTab.classList.add('active');
            studentTabContent.classList.add('active');
        }
    }
}

function loadStudentSpecificData(studentId) {
    // Reset all sections to empty for new student
    medications = [];
    complaints = [];
    records = [];
    notes = "";
    
    // Reload all data
    checkSevereComplaints();
    updateProfileBorder();
 
    
    // Clear notes textarea
    const notesTextarea = document.querySelector('.notes-textarea');
    if (notesTextarea) {
        notesTextarea.value = "";
    }
}
    
    // Add this block for student info card
    if (studentInfoCard) {
        if (hasSevereComplaints) {
            studentInfoCard.classList.add('severe-alert');
        } else {
            studentInfoCard.classList.remove('severe-alert');
        }
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
            const targetContent = document.getElementById(tabName);
            if (targetContent) {
                targetContent.classList.add('active');
            }
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

    if (!modal) return;

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    if (saveBtn) saveBtn.addEventListener('click', saveChanges);

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Delegate remove button clicks inside modal for dynamic content
    const modalBody = modal.querySelector('#modalBody');
    if (modalBody) {
        modalBody.addEventListener('click', function(e) {
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
}

function openEditModal(editType) {
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');

    if (!modal || !modalTitle || !modalBody) return;

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
    const modal = document.getElementById('editModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function saveChanges() {
    const modal = document.getElementById('editModal');
    if (!modal) return;
    
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
    if (medications.length === 0) {
        return `
            <p style="text-align: center; color: #666; margin: 20px 0;">No medications added yet.</p>
            <button type="button" class="btn-add" onclick="addMedication()">Add New Medication</button>
        `;
    }

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
                    <input type="date" value="${formatDateISO(med.startDate)}" data-field="startDate">
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
    if (complaints.length === 0) {
        return `
            <p style="text-align: center; color: #666; margin: 20px 0;">No complaints added yet.</p>
            <button type="button" class="btn-add" onclick="addComplaint()">Add New Complaint</button>
        `;
    }

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
        return `
            <p style="text-align: center; color: #666; margin: 20px 0;">No records available.</p>
            <button type="button" class="btn-add" onclick="addRecord()">Add New Record</button>
        `;
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
    const nameEl = document.getElementById('edit-name');
    const emailEl = document.getElementById('edit-email');
    const courseEl = document.getElementById('edit-course');
    const idEl = document.getElementById('edit-id');
    const genderEl = document.getElementById('edit-gender');
    const phoneEl = document.getElementById('edit-phone');
    const addressEl = document.getElementById('edit-address');
    const bpEl = document.getElementById('edit-bp');
    const weightEl = document.getElementById('edit-weight');
    const tempEl = document.getElementById('edit-temp');

    if (nameEl) currentUser.name = nameEl.value;
    if (emailEl) currentUser.email = emailEl.value;
    
    if (courseEl) {
        const courseYear = courseEl.value.split(' - ');
        currentUser.course = courseYear[0];
        currentUser.year = courseYear[1] || '';
    }
    
    if (idEl) currentUser.id = idEl.value;
    if (genderEl) currentUser.gender = genderEl.value;
    if (phoneEl) currentUser.phone = phoneEl.value;
    if (addressEl) currentUser.address = addressEl.value;
    if (bpEl) currentUser.bp = bpEl.value;
    if (weightEl) currentUser.weight = weightEl.value;
    if (tempEl) currentUser.temp = tempEl.value;

    loadUserData();
}

function saveMedicationChanges() {
    const medicationRows = document.querySelectorAll('.medication-row');
    medications = [];
    
    medicationRows.forEach((row, index) => {
        const nameEl = row.querySelector('[data-field="name"]');
        const dosageEl = row.querySelector('[data-field="dosage"]');
        const startDateEl = row.querySelector('[data-field="startDate"]');
        const statusEl = row.querySelector('[data-field="status"]');
        
        if (nameEl && dosageEl && startDateEl && statusEl) {
            medications.push({
                name: nameEl.value,
                dosage: dosageEl.value,
                startDate: formatDateDisplay(startDateEl.value),
                assignedBy: "Patient",
                status: statusEl.value
            });
        }
    });
    
}

function saveComplaintChanges() {
    const complaintRows = document.querySelectorAll('.complaint-row');
    complaints = [];

    complaintRows.forEach((row) => {
        const nameEl = row.querySelector('[data-field="name"]');
        const severityEl = row.querySelector('[data-field="severity"]');
        const medicationEl = row.querySelector('[data-field="medication"]');
        const dosageEl = row.querySelector('[data-field="dosage"]');

        const name = nameEl?.value.trim();
        const severity = severityEl?.value.trim();

        // Ignore empty or deleted rows
        if (!name || !severity) return;

        const medication = medicationEl?.value.trim() || '';
        const dosage = dosageEl?.value.trim() || '';

        complaints.push({
            name,
            severity,
            medication,
            dosage
        });

        // Only push to medications & records if medication and dosage are BOTH present
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
    updateProfileBorder();  
}

function saveNotesChanges() {
    const notesEl = document.getElementById('edit-notes');
    const notesTextarea = document.querySelector('.notes-textarea');

    notes = notesEl?.value.trim() || "";
    if (notesTextarea) {
        notesTextarea.value = notes;
        notesTextarea.placeholder = notes === "" ? "No notes yet." : "Add text...";
    }
}

function saveRecordsChanges() {
    const recordRows = document.querySelectorAll('.record-row');
    records = [];

    recordRows.forEach((row) => {
        const assignedNurseEl = row.querySelector('[data-field="assignedNurse"]');
        const dateEl = row.querySelector('[data-field="date"]');
        const diseaseEl = row.querySelector('[data-field="disease"]');

        const assignedNurse = assignedNurseEl?.value.trim();
        const date = dateEl?.value;
        const disease = diseaseEl?.value.trim();

        // Skip if any essential field is missing
        if (!assignedNurse || !date || !disease) return;

        records.push({
            assignedNurse,
            date: formatDateDisplay(date),
            disease,
        });
    });

    loadRecordsTable();
}

// Add functions
function addMedication() {
    const modalBody = document.getElementById('modalBody');
    if (!modalBody) return;
    
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
    if (addButton) {
        modalBody.insertBefore(newMedicationRow, addButton);
    } else {
        // If no add button (first medication), replace content
        modalBody.innerHTML = newMedicationRow.outerHTML + '<button type="button" class="btn-add" onclick="addMedication()">Add New Medication</button>';
    }
    
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
    if (!modalBody) return;
    
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
if (addButton) {
    modalBody.insertBefore(newComplaintRow, addButton);
} else {
    // If no add button (first complaint), replace content
    modalBody.innerHTML = newComplaintRow.outerHTML + '<button class="btn-add">Add New Complaint</button>';
}
}

function addRecord() {
    const modalBody = document.getElementById('modalBody');
    if (!modalBody) return;
    
    const newIndex = records.length;
    
    const newRecordRow = document.createElement('div');
    newRecordRow.className = 'record-row';
    newRecordRow.setAttribute('data-index', newIndex);
    newRecordRow.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>Assigned Nurse</label>
                <input type="text" value="" data-field="assignedNurse" placeholder="Enter nurse name">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" value="${new Date().toISOString().split('T')[0]}" data-field="date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Disease</label>
                <input type="text" value="" data-field="disease" placeholder="Enter disease/condition">
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
    if (addButton) {
        modalBody.insertBefore(newRecordRow, addButton);
    } else {
        // If no add button (first record), replace content
        modalBody.innerHTML = newRecordRow.outerHTML + '<button type="button" class="btn-add" onclick="addRecord()">Add New Record</button>';
    }
    
    records.push({
        assignedNurse: "",
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
    const modal = document.getElementById('editModal');
    const modalBody = document.getElementById('modalBody');
    
    if (medications.length === 0) {
        modalBody.innerHTML = `
            <p style="text-align: center; color: #666; margin: 20px 0;">No medications added yet.</p>
            <button type="button" class="btn-add" onclick="addMedication()">Add New Medication</button>
        `;
    } else {
        modalBody.innerHTML = getMedicationsEditForm();
    }
}

function removeComplaint(index) {
    complaints.splice(index, 1);
    const modal = document.getElementById('editModal');
    const modalBody = document.getElementById('modalBody');
    
    if (complaints.length === 0) {
        modalBody.innerHTML = `
            <p style="text-align: center; color: #666; margin: 20px 0;">No complaints added yet.</p>
            <button type="button" class="btn-add" onclick="addComplaint()">Add New Complaint</button>
        `;
    } else {
        modalBody.innerHTML = getComplaintsEditForm();
    }
}

function removeRecord(index) {
    records.splice(index, 1);
    const modal = document.getElementById('editModal');
    const modalBody = document.getElementById('modalBody');
    
    if (records.length === 0) {
        modalBody.innerHTML = `
            <p style="text-align: center; color: #666; margin: 20px 0;">No records available.</p>
            <button type="button" class="btn-add" onclick="addRecord()">Add New Record</button>
        `;
    } else {
        modalBody.innerHTML = getRecordsEditForm();
    }
}

// Data loading functions
function loadUserData() {
    // Profile section
    const profileName = document.querySelector('.profile-name');
    const profileEmail = document.querySelector('.profile-email');
    const profileCourse = document.querySelector('.profile-course');
    const profileId = document.querySelector('.profile-id');

    if (profileName) profileName.textContent = currentUser.name;
    if (profileEmail) profileEmail.textContent = currentUser.email;
    if (profileCourse) profileCourse.textContent = `${currentUser.course} - ${currentUser.year}`;
    if (profileId) profileId.textContent = currentUser.id;

    // Student info section
    const studentName = document.querySelector('.student-name');
    const studentEmail = document.querySelector('.student-email');
    const studentCourse = document.querySelector('.student-course');
    const studentId = document.querySelector('.student-id');
    const studentGender = document.querySelector('.student-gender');
    const studentBirthdate = document.querySelector('.student-birthdate');
    const studentPhone = document.querySelector('.student-phone');
    const studentAddress = document.querySelector('.student-address');
    const studentBp = document.querySelector('.student-bp');
    const studentWeight = document.querySelector('.student-weight');
    const studentTemp = document.querySelector('.student-temp');

    if (studentName) studentName.textContent = currentUser.name;
    if (studentEmail) studentEmail.textContent = currentUser.email;
    if (studentCourse) studentCourse.textContent = `${currentUser.course} - ${currentUser.year}`;
    if (studentId) studentId.textContent = currentUser.id;
    if (studentGender) studentGender.textContent = currentUser.gender;
    if (studentBirthdate) studentBirthdate.textContent = currentUser.birthdate;
    if (studentPhone) studentPhone.textContent = currentUser.phone;
    if (studentAddress) studentAddress.textContent = currentUser.address;
    if (studentBp) studentBp.textContent = currentUser.bp;
    if (studentWeight) studentWeight.textContent = currentUser.weight;
    if (studentTemp) studentTemp.textContent = currentUser.temp;
}

function loadMedicationsTable() {
    const medicationsTable = document.querySelector('.medications-table tbody');
    if (!medicationsTable) return;

    medicationsTable.innerHTML = medications.length === 0
        ? `<tr><td colspan="5" style="text-align:center;color:#aaa;font-style:italic;">No medications yet</td></tr>`
        : medications.map(med => `
            <tr>
                <td>${med.name}</td>
                <td>${med.dosage}</td>
                <td>${med.startDate}</td>
            </tr>
        `).join('');
}

function loadComplaintsList() {
    const complaintsList = document.getElementById('complaintsList');
    if (!complaintsList) return;

    complaintsList.innerHTML = complaints.length === 0
        ? `<div style="text-align:center;color:#aaa;padding:20px;font-style:italic;">No complaints yet.</div>`
        : complaints.map(c => `
            <div class="complaint-item ${c.severity}">
                <div class="complaint-info">
                    <strong>${c.name}</strong>
                    <span class="severity-badge ${c.severity}">${c.severity}</span>
                </div>
                ${c.medication ? `<div class="complaint-medication"><small>Prescribed: ${c.medication} - ${c.dosage}</small></div>` : ''}
            </div>
        `).join('');
}

function loadRecordsTable() {
    const recordsTable = document.querySelector('.records-table tbody');
    if (!recordsTable) return;

    recordsTable.innerHTML = records.length === 0
        ? `<tr><td colspan="4" style="text-align:center;color:#aaa;font-style:italic;">No records yet</td></tr>`
        : records.map(record => `
            <tr>
                <td>${record.assignedNurse}</td>
                <td>${record.date}</td>
                <td>${record.disease}</td>
            </tr>
        `).join('');
}

    function updateProfileBorder() {
    const profileCard = document.querySelector('.student-profile');
    if (!profileCard) return;

    profileCard.classList.remove('severe-complaints', 'mild-complaints');

    const hasSevere = complaints.some(c => c.severity === 'severe');
    const hasMild = complaints.length > 0 && complaints.every(c => c.severity === 'mild');

    if (hasSevere) {
        profileCard.classList.add('severe-complaints');
    } else if (hasMild) {
        profileCard.classList.add('mild-complaints');
    }
}

// Utility functions
function formatDateISO(dateString) {
    // Convert MM/DD/YYYY to YYYY-MM-DD for input[type="date"]
    if (!dateString) return new Date().toISOString().split('T')[0];
    
    const parts = dateString.split('/');
    if (parts.length === 3) {
        const month = parts[0].padStart(2, '0');
        const day = parts[1].padStart(2, '0');
        const year = parts[2];
        return `${year}-${month}-${day}`;
    }
    
    return new Date().toISOString().split('T')[0];
}

function formatDateDisplay(isoDateString) {
    // Convert YYYY-MM-DD to MM/DD/YYYY for display
    if (!isoDateString) return new Date().toLocaleDateString('en-US', { 
        month: '2-digit', 
        day: '2-digit', 
        year: 'numeric' 
    });
    
    const date = new Date(isoDateString);
    return date.toLocaleDateString('en-US', { 
        month: '2-digit', 
        day: '2-digit', 
        year: 'numeric' 
    });
}

// Add event listeners for all buttons after DOM is loaded
function setupAllButtons() {
    // Edit Profile Button
    const editProfileBtn = document.querySelector('.edit-profile-btn');
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', function() {
            openEditModal('profile');
        });
    }

    // Edit Medications Button
    const editMedicationsBtn = document.querySelector('.edit-medications-btn');
    if (editMedicationsBtn) {
        editMedicationsBtn.addEventListener('click', function() {
            openEditModal('medications');
        });
    }

    // Edit Complaints Button
    const editComplaintsBtn = document.querySelector('.edit-complaints-btn');
    if (editComplaintsBtn) {
        editComplaintsBtn.addEventListener('click', function() {
            openEditModal('complaints');
        });
    }

    // Add Notes Button
    const addNotesBtn = document.querySelector('.add-notes-btn');
    if (addNotesBtn) {
        addNotesBtn.addEventListener('click', function() {
            openEditModal('notes');
        });
    }

    // Edit Records Button
    const editRecordsBtn = document.querySelector('.edit-records-btn');
    if (editRecordsBtn) {
        editRecordsBtn.addEventListener('click', function() {
            openEditModal('records');
        });
    }

    // Export Button
    const exportBtn = document.querySelector('.export-btn');
    if (exportBtn) {
        exportBtn.addEventListener('click', exportData);
    }

    // Print Button
    const printBtn = document.querySelector('.print-btn');
    if (printBtn) {
        printBtn.addEventListener('click', printData);
    }

    // Download Button
    const downloadBtn = document.querySelector('.download-btn');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', downloadData);
    }

    // Logout Button
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', logout);
    }

    // Settings Button
    const settingsBtn = document.querySelector('.settings-btn');
    if (settingsBtn) {
        settingsBtn.addEventListener('click', openSettings);
    }

    // Help Button
    const helpBtn = document.querySelector('.help-btn');
    if (helpBtn) {
        helpBtn.addEventListener('click', openHelp);
    }

    // Refresh Button
    const refreshBtn = document.querySelector('.refresh-btn');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', refreshData);
    }

    // Clear All Button
    const clearAllBtn = document.querySelector('.clear-all-btn');
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', clearAllData);
    }

    // Backup Button
    const backupBtn = document.querySelector('.backup-btn');
    if (backupBtn) {
        backupBtn.addEventListener('click', backupData);
    }

    // Restore Button
    const restoreBtn = document.querySelector('.restore-btn');
    if (restoreBtn) {
        restoreBtn.addEventListener('click', restoreData);
    }
}

// Button Functions
function exportData() {
    const data = {
        user: currentUser,
        medications: medications,
        complaints: complaints,
        records: records,
        notes: notes,
        timestamp: new Date().toISOString()
    };
    
    const dataStr = JSON.stringify(data, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    const url = URL.createObjectURL(dataBlob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = `medical_data_${currentUser.name.replace(/\s+/g, '_')}_${new Date().toISOString().split('T')[0]}.json`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    
    showNotification('Data exported successfully!', 'success');
}

function printData() {
    const printWindow = window.open('', '_blank');
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Medical Records - ${currentUser.name}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .header { border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
                .section { margin-bottom: 20px; }
                .section h3 { color: #333; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .severe { color: red; font-weight: bold; }
                @media print { body { margin: 0; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Medical Records</h1>
                <h2>${currentUser.name}</h2>
                <p>ID: ${currentUser.id} | Course: ${currentUser.course} - ${currentUser.year}</p>
                <p>Generated on: ${new Date().toLocaleDateString()}</p>
            </div>
            
            <div class="section">
                <h3>Personal Information</h3>
                <p><strong>Email:</strong> ${currentUser.email}</p>
                <p><strong>Phone:</strong> ${currentUser.phone}</p>
                <p><strong>Address:</strong> ${currentUser.address}</p>
                <p><strong>Gender:</strong> ${currentUser.gender}</p>
                <p><strong>Birthdate:</strong> ${currentUser.birthdate}</p>
            </div>
            
            <div class="section">
                <h3>Vital Signs</h3>
                <p><strong>Blood Pressure:</strong> ${currentUser.bp}</p>
                <p><strong>Weight:</strong> ${currentUser.weight}</p>
                <p><strong>Temperature:</strong> ${currentUser.temp}</p>
            </div>
            
            <div class="section">
                <h3>Chief Complaints</h3>
                ${complaints.length === 0 ? '<p>No complaints recorded</p>' : 
                  complaints.map(c => `<p><strong>${c.name}</strong> - <span class="${c.severity}">${c.severity}</span>${c.medication ? ` | Medication: ${c.medication} (${c.dosage})` : ''}</p>`).join('')}
            </div>
            
            <div class="section">
                <h3>Medications</h3>
                ${medications.length === 0 ? '<p>No medications assigned</p>' : `
                <table>
                    <tr><th>Medication</th><th>Dosage</th><th>Start Date</th><th>Assigned By</th><th>Status</th></tr>
                    ${medications.map(m => `<tr><td>${m.name}</td><td>${m.dosage}</td><td>${m.startDate}</td><td>${m.assignedBy}</td><td>${m.status}</td></tr>`).join('')}
                </table>`}
            </div>
            
            <div class="section">
                <h3>Medical Records</h3>
                ${records.length === 0 ? '<p>No records available</p>' : `
                <table>
                    <tr><th>Assigned Nurse</th><th>Date</th><th>Disease</th><th>Status</th></tr>
                    ${records.map(r => `<tr><td>${r.assignedNurse}</td><td>${r.date}</td><td>${r.disease}</td><td>${r.status}</td></tr>`).join('')}
                </table>`}
            </div>
            
            ${notes ? `
            <div class="section">
                <h3>Notes</h3>
                <p>${notes.replace(/\n/g, '<br>')}</p>
            </div>` : ''}
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.print();
}

function downloadData() {
    const csvContent = generateCSV();
    const csvBlob = new Blob([csvContent], {type: 'text/csv'});
    const url = URL.createObjectURL(csvBlob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = `medical_records_${currentUser.name.replace(/\s+/g, '_')}_${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    
    showNotification('CSV file downloaded successfully!', 'success');
}

function generateCSV() {
    let csv = 'Section,Data\n';
    csv += `Name,${currentUser.name}\n`;
    csv += `Email,${currentUser.email}\n`;
    csv += `Course,${currentUser.course} - ${currentUser.year}\n`;
    csv += `ID,${currentUser.id}\n`;
    csv += `Phone,${currentUser.phone}\n`;
    csv += `Address,${currentUser.address}\n`;
    csv += `Gender,${currentUser.gender}\n`;
    csv += `Birthdate,${currentUser.birthdate}\n`;
    csv += `Blood Pressure,${currentUser.bp}\n`;
    csv += `Weight,${currentUser.weight}\n`;
    csv += `Temperature,${currentUser.temp}\n\n`;
    
    csv += 'Complaints\n';
    csv += 'Complaint,Severity,Medication,Dosage\n';
    complaints.forEach(c => {
        csv += `${c.name},${c.severity},${c.medication || ''},${c.dosage || ''}\n`;
    });
    
    csv += '\nMedications\n';
    csv += 'Name,Dosage,Start Date,Assigned By,Status\n';
    medications.forEach(m => {
        csv += `${m.name},${m.dosage},${m.startDate},${m.assignedBy},${m.status}\n`;
    });
    
    csv += '\nRecords\n';
    csv += 'Assigned Nurse,Date,Disease,Status\n';
    records.forEach(r => {
        csv += `${r.assignedNurse},${r.date},${r.disease},${r.status}\n`;
    });
    
    return csv;
}

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        // Reset to default user
        currentUser = {
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
        
        // Clear all data
        medications = [];
        complaints = [];
        records = [];
        notes = "";
        
        // Refresh display
        loadUserData();
        updateProfileBorder();
        
        // Clear search
        const searchInput = document.getElementById('searchInput');
        if (searchInput) searchInput.value = '';
        
        showNotification('Logged out successfully!', 'info');
    }
}

function openSettings() {
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');

    if (!modal || !modalTitle || !modalBody) return;

    modal.style.display = 'block';
    modal.setAttribute('data-edit-type', 'settings');
    modalTitle.textContent = 'Settings';
    modalBody.innerHTML = `
        <div class="settings-section">
            <h4>Appearance</h4>
            <div class="form-group">
                <label>Theme</label>
                <select id="theme-select">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="auto">Auto</option>
                </select>
            </div>
        </div>
        
        <div class="settings-section">
            <h4>Notifications</h4>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="show-notifications" checked>
                    Show notifications
                </label>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="severe-alerts" checked>
                    Alert for severe complaints
                </label>
            </div>
        </div>
        
        <div class="settings-section">
            <h4>Data</h4>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="auto-save" checked>
                    Auto-save changes
                </label>
            </div>
        </div>
    `;
}

function openHelp() {
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');

    if (!modal || !modalTitle || !modalBody) return;

    modal.style.display = 'block';
    modal.setAttribute('data-edit-type', 'help');
    modalTitle.textContent = 'Help & Support';
    modalBody.innerHTML = `
        <div class="help-section">
            <h4>How to Use</h4>
            <ul>
                <li><strong>Search:</strong> Use the search bar to find students by name, email, or ID</li>
                <li><strong>Edit Profile:</strong> Click the edit button to modify student information</li>
                <li><strong>Add Complaints:</strong> Record chief complaints and assign severity levels</li>
                <li><strong>Manage Medications:</strong> Add, edit, or remove prescribed medications</li>
                <li><strong>View Records:</strong> Track medical history and treatment progress</li>
                <li><strong>Export Data:</strong> Download records in JSON or CSV format</li>
            </ul>
        </div>
        
        <div class="help-section">
            <h4>Keyboard Shortcuts</h4>
            <ul>
                <li><strong>Ctrl+S:</strong> Save current changes</li>
                <li><strong>Ctrl+P:</strong> Print records</li>
                <li><strong>Ctrl+E:</strong> Export data</li>
                <li><strong>Escape:</strong> Close modal</li>
            </ul>
        </div>
        
        <div class="help-section">
            <h4>Contact Support</h4>
            <p>For technical support, contact the IT department or system administrator.</p>
        </div>
    `;
}

function refreshData() {
    loadUserData();
    updateProfileBorder();
    
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    if (searchInput) searchInput.value = '';
    if (searchResults) searchResults.style.display = 'none';
    
    showNotification('Data refreshed successfully!', 'success');
}

function clearAllData() {
    if (confirm('Are you sure you want to clear all medical data? This action cannot be undone.')) {
        medications = [];
        complaints = [];
        records = [];
        notes = "";
        
        updateProfileBorder();
        
        const notesTextarea = document.querySelector('.notes-textarea');
        if (notesTextarea) notesTextarea.value = "";
        
        showNotification('All medical data cleared!', 'warning');
    }
}

function backupData() {
    const backupData = {
        user: currentUser,
        medications: medications,
        complaints: complaints,
        records: records,
        notes: notes,
        timestamp: new Date().toISOString(),
        version: "1.0"
    };
    
    const dataStr = JSON.stringify(backupData, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    const url = URL.createObjectURL(dataBlob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = `backup_${currentUser.name.replace(/\s+/g, '_')}_${new Date().toISOString().split('T')[0]}.json`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    
    showNotification('Backup created successfully!', 'success');
}

function restoreData() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = '.json';
    
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const backupData = JSON.parse(e.target.result);
                
                if (confirm('Are you sure you want to restore from this backup? Current data will be overwritten.')) {
                    currentUser = backupData.user || currentUser;
                    medications = backupData.medications || [];
                    complaints = backupData.complaints || [];
                    records = backupData.records || [];
                    notes = backupData.notes || "";
                    
                    loadUserData();
                    updateProfileBorder();
                    
                    const notesTextarea = document.querySelector('.notes-textarea');
                    if (notesTextarea) notesTextarea.value = notes;
                    
                    showNotification('Data restored successfully!', 'success');
                }
            } catch (error) {
                showNotification('Invalid backup file format!', 'error');
            }
        };
        reader.readAsText(file);
    };
    
    input.click();
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey) {
        switch(e.key) {
            case 's':
                e.preventDefault();
                const modal = document.getElementById('editModal');
                if (modal && modal.style.display === 'block') {
                    saveChanges();
                }
                break;
            case 'p':
                e.preventDefault();
                printData();
                break;
            case 'e':
                e.preventDefault();
                exportData();
                break;
        }
    } else if (e.key === 'Escape') {
        closeModal();
    }
});

function initializeApp() {
    setupStudentTabs();
    setupEditButtons();
    setupModal();
    setupSearch();
    setupAllButtons(); 
    checkSevereComplaints();
    loadUserData();
    updateProfileBorder();
}
