// JavaScript for Tab Functionality
const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.slider-content');

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        tabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        contents.forEach(content => content.classList.remove('active'));
        const target = this.getAttribute('data-target');
        document.getElementById(target).classList.add('active');
    });
});

// Add Walk-In Functionality
const walkIns = [];
const complaintsList = document.querySelector('.complaints-list');
const walkInsBody = document.getElementById('walk-ins-body');
const addWalkInForm = document.getElementById('add-walkin-form');
const walkinReasonSelect = document.getElementById('walkin-reason');
const otherReasonInput = document.getElementById('other-reason');

// Function to populate reasons (fixed)
function populateReasons() {
    const reasons = ['Fever', 'Cough', 'Headache', 'Other']; // Example reasons
    walkinReasonSelect.innerHTML = '<option value="">Select Reason</option>';
    reasons.forEach(reason => {
        const option = document.createElement('option');
        option.value = reason;
        option.textContent = reason;
        walkinReasonSelect.appendChild(option);
    });
}

// Show "Other Reason" input when "Other" is selected
walkinReasonSelect.addEventListener('change', function() {
    if (this.value === 'Other') {
        otherReasonInput.style.display = 'block';
    } else {
        otherReasonInput.style.display = 'none';
    }
});

// Show Add Walk-In Popup
function showAddWalkInPopup() {
    populateReasons(); // Call the function to populate reasons
    document.getElementById('add-walkin-popup').style.display = 'flex';
}

// Close Add Walk-In Popup
function closeAddWalkInPopup() {
    document.getElementById('add-walkin-popup').style.display = 'none';
}

// Add Walk-In
addWalkInForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const patientName = document.getElementById('patient-name').value;
    const date = document.getElementById('walkin-date').value;
    const time = document.getElementById('walkin-time').value;
    const reason = walkinReasonSelect.value === 'Other' ? otherReasonInput.value : walkinReasonSelect.value;
    const status = document.getElementById('walkin-status').value;

    if (patientName && date && time && reason && status) {
        const walkIn = { patientName, date, time, reason, status, id: Date.now() };
        walkIns.push(walkIn);
        addWalkInToHistory(walkIn); // Add to history
        updateWalkInsTable();
        closeAddWalkInPopup();
    } else {
        alert('Please fill out all fields.');
    }
});

// Update Walk-Ins Table
function updateWalkInsTable() {
    walkInsBody.innerHTML = '';
    walkIns.forEach((walkIn, index) => {
        const row = `
            <tr>
                <td>${walkIn.patientName}</td>
                <td>${walkIn.date}</td>
                <td>${walkIn.time}</td>
                <td>${walkIn.reason}</td>
                <td>${walkIn.status}</td>
                <td>
                    <button class="edit-btn" onclick="editWalkIn(${index})"><i class='bx bx-edit'></i> Edit</button>
                    <button class="delete-btn" onclick="deleteWalkIn(${index})"><i class='bx bx-trash'></i> Delete</button>
                </td>
            </tr>
        `;
        walkInsBody.innerHTML += row;
    });
}

// Edit Walk-In
function editWalkIn(index) {
    const walkIn = walkIns[index];
    document.getElementById('patient-name').value = walkIn.patientName;
    document.getElementById('walkin-date').value = walkIn.date;
    document.getElementById('walkin-time').value = walkIn.time;
    document.getElementById('walkin-reason').value = walkIn.reason;
    document.getElementById('walkin-status').value = walkIn.status;
    showAddWalkInPopup();
}

// Delete Walk-In
function deleteWalkIn(index) {
    if (confirm('Are you sure you want to delete this walk-in?')) {
        walkIns.splice(index, 1);
        updateWalkInsTable();
    }
}

// Walk-In History (for Past Appointments and Medical Records)
const pastAppointments = [];
const medicalRecords = [];

// Add Walk-In to History
function addWalkInToHistory(walkIn) {
    const historyEntry = { ...walkIn, id: Date.now() }; // Add unique ID
    pastAppointments.push(historyEntry);
    medicalRecords.push(historyEntry);
    updatePastAppointmentsTable();
    updateMedicalRecordsTable();
}

// Update Past Appointments Table
function updatePastAppointmentsTable() {
    const pastBody = document.getElementById('past-body');
    pastBody.innerHTML = '';
    pastAppointments.forEach((appointment, index) => {
        const row = `
            <tr>
                <td>${appointment.patientName}</td>
                <td>${appointment.date}</td>
                <td>${appointment.time}</td>
                <td>${appointment.reason}</td>
                <td>${appointment.status}</td>
                <td>
                    <button class="detail-btn" onclick="showDetailPopup(${appointment.id})"><i class='bx bx-detail'></i> Details</button>
                </td>
            </tr>
        `;
        pastBody.innerHTML += row;
    });
}

// Update Medical Records Table
function updateMedicalRecordsTable() {
    const recordsBody = document.getElementById('records-body');
    recordsBody.innerHTML = '';
    medicalRecords.forEach((record, index) => {
        const row = `
            <tr>
                <td>${record.patientName}</td>
                <td>${record.date}</td>
                <td>${record.time}</td>
                <td>${record.reason}</td>
                <td>${record.status}</td>
                <td>
                    <button class="detail-btn" onclick="showDetailPopup(${record.id})"><i class='bx bx-detail'></i> Details</button>
                </td>
            </tr>
        `;
        recordsBody.innerHTML += row;
    });
}

// Show Detail Popup
function showDetailPopup(id) {
    const entry = pastAppointments.find(appointment => appointment.id === id);
    if (entry) {
        document.getElementById('detail-patient-name').textContent = entry.patientName;
        document.getElementById('detail-date').textContent = entry.date;
        document.getElementById('detail-time').textContent = entry.time;
        document.getElementById('detail-reason').textContent = entry.reason;
        document.getElementById('detail-status').textContent = entry.status;

        // Populate Chief Complaints
        const complaintsList = document.getElementById('detail-complaints');
        complaintsList.innerHTML = '';
        document.querySelectorAll('.complaints-list li').forEach(complaint => {
            const li = document.createElement('li');
            li.textContent = complaint.textContent.split('Delete')[0].trim(); // Remove delete button text
            complaintsList.appendChild(li);
        });

        // Populate Medications
        const medicationsList = document.getElementById('detail-medications');
        medicationsList.innerHTML = '';
        document.querySelectorAll('#medications-body tr').forEach(medication => {
            const li = document.createElement('li');
            li.textContent = medication.cells[0].textContent; // Medication name
            medicationsList.appendChild(li);
        });

        // Populate Notes
        const notesList = document.getElementById('detail-notes');
        notesList.innerHTML = '';
        notes.forEach(note => {
            const div = document.createElement('div');
            div.textContent = `${note.title}: ${note.content}`;
            notesList.appendChild(div);
        });

        document.getElementById('detail-popup').style.display = 'flex';
    }
}

// Close Detail Popup
document.getElementById('close-detail-popup').addEventListener('click', function() {
    document.getElementById('detail-popup').style.display = 'none';
});

// Medications Functionality
const medications = [];
const medicationsBody = document.getElementById('medications-body');
const editMedicationsButton = document.getElementById('edit-medications');

// Show Medication Popup
editMedicationsButton.addEventListener('click', function() {
    document.getElementById('medication-popup-overlay').style.display = 'flex';
});

// Close Medication Popup
document.getElementById('close-medication-popup').addEventListener('click', function() {
    document.getElementById('medication-popup-overlay').style.display = 'none';
});

// Add Medication
document.getElementById('submit-medication').addEventListener('click', function() {
    const name = document.getElementById('med-name').value;
    const date = document.getElementById('med-date').value;
    const status = document.getElementById('med-status').value;

    if (name && date && status) {
        const medication = { name, date, status };
        medications.push(medication);
        updateMedicationsTable();
        document.getElementById('medication-popup-overlay').style.display = 'none';
    } else {
        alert('Please fill out all fields.');
    }
});

// Update Medications Table
function updateMedicationsTable() {
    medicationsBody.innerHTML = '';
    medications.forEach((medication, index) => {
        const row = `
            <tr>
                <td>${medication.name}</td>
                <td>${medication.date}</td>
                <td>Patient</td>
                <td>${medication.status}</td>
                <td>
                    <button class="edit-btn" onclick="editMedication(${index})"><i class='bx bx-edit'></i> Edit</button>
                    <button class="delete-btn" onclick="deleteMedication(${index})"><i class='bx bx-trash'></i> Delete</button>
                </td>
            </tr>
        `;
        medicationsBody.innerHTML += row;
    });
}

// Edit Medication
function editMedication(index) {
    const medication = medications[index];
    document.getElementById('med-name').value = medication.name;
    document.getElementById('med-date').value = medication.date;
    document.getElementById('med-status').value = medication.status;
    document.getElementById('medication-popup-overlay').style.display = 'flex';
}

// Delete Medication
function deleteMedication(index) {
    if (confirm('Are you sure you want to delete this medication?')) {
        medications.splice(index, 1);
        updateMedicationsTable();
    }
}

// Chief Complaints Functionality
const editComplaintsButton = document.getElementById('edit-complaints');

// Show Complaints Popup
editComplaintsButton.addEventListener('click', function() {
    document.getElementById('complaint-popup-overlay').style.display = 'flex';
});

// Close Complaints Popup
document.getElementById('close-complaint-popup').addEventListener('click', function() {
    document.getElementById('complaint-popup-overlay').style.display = 'none';
});

// Add Complaint
document.getElementById('submit-complaint').addEventListener('click', function() {
    const name = document.getElementById('complaint-name').value;
    const severity = document.getElementById('complaint-severity').value;

    if (name && severity) {
        const listItem = document.createElement('li');
        listItem.innerHTML = `
            ${name} <span class="${severity === 'Severe' ? 'severity' : ''}">${severity}</span>
            <button class="delete-btn" onclick="deleteComplaint(this)"><i class='bx bx-trash'></i> Delete</button>
        `;
        if (severity === 'Severe') {
            listItem.classList.add('severe');
        }
        complaintsList.appendChild(listItem);
        document.getElementById('complaint-popup-overlay').style.display = 'none';
    } else {
        alert('Please fill out all fields.');
    }
});

// Delete Complaint
function deleteComplaint(button) {
    if (confirm('Are you sure you want to delete this complaint?')) {
        button.parentNode.remove();
    }
}

// Notes Functionality
const notes = [];
const notesList = document.getElementById('notes-list');
const noteContent = document.getElementById('note-content');
const addNoteButton = document.getElementById('add-note');
const viewNotesButton = document.getElementById('view-notes');
const prevNoteButton = document.getElementById('prev-note');
const nextNoteButton = document.getElementById('next-note');
const deleteNoteButton = document.getElementById('delete-note');
const restoreNoteButton = document.getElementById('restore-note');

let currentNoteIndex = 0;

// Add Note
addNoteButton.addEventListener('click', function() {
    const title = document.getElementById('title-input').value;
    const content = document.getElementById('note-input').value;

    if (title && content) {
        const note = { title, content };
        notes.push(note);
        updateNotesList();
        document.getElementById('title-input').value = '';
        document.getElementById('note-input').value = '';
    } else {
        alert('Please fill out both title and content.');
    }
});

// View Notes
viewNotesButton.addEventListener('click', function() {
    document.getElementById('notes-popup').style.display = 'flex';
    updateNotesList();
});

// Update Notes List
function updateNotesList() {
    notesList.innerHTML = '';
    notes.forEach((note, index) => {
        const noteItem = document.createElement('div');
        noteItem.textContent = note.title;
        noteItem.addEventListener('click', () => showNote(index));
        notesList.appendChild(noteItem);
    });
}

// Show Note
function showNote(index) {
    currentNoteIndex = index;
    const note = notes[index];
    noteContent.textContent = note.content;
}

// Previous Note
prevNoteButton.addEventListener('click', function() {
    if (currentNoteIndex > 0) {
        currentNoteIndex--;
        showNote(currentNoteIndex);
    }
});

// Next Note
nextNoteButton.addEventListener('click', function() {
    if (currentNoteIndex < notes.length - 1) {
        currentNoteIndex++;
        showNote(currentNoteIndex);
    }
});

// Delete Note
deleteNoteButton.addEventListener('click', function() {
    if (notes.length > 0) {
        notes.splice(currentNoteIndex, 1);
        updateNotesList();
        noteContent.textContent = 'Select a note to view details';
    }
});

// Restore Note (Optional: You can implement this if you want to restore deleted notes)
restoreNoteButton.addEventListener('click', function() {
    // Implement restore functionality if needed
});

// Close Notes Popup
document.getElementById('close-notes-popup').addEventListener('click', function() {
    document.getElementById('notes-popup').style.display = 'none';
});

// Settings Functionality
const settingsButton = document.getElementById('settings-btn');
const settingsPopup = document.getElementById('settings-popup');
const darkModeToggle = document.getElementById('dark-mode-toggle');
const profileNameInput = document.getElementById('profile-name-input');
const saveProfileNameButton = document.getElementById('save-profile-name');
const profileNameDisplay = document.getElementById('profile-name');

// Show Settings Popup
settingsButton.addEventListener('click', function() {
    settingsPopup.style.display = 'flex';
});

// Close Settings Popup
document.getElementById('close-settings-popup').addEventListener('click', function() {
    settingsPopup.style.display = 'none';
});

// Toggle Dark Mode
darkModeToggle.addEventListener('change', function() {
    document.body.classList.toggle('dark-mode', this.checked);
});

// Save Profile Name
saveProfileNameButton.addEventListener('click', function() {
    const newName = profileNameInput.value.trim();
    if (newName) {
        profileNameDisplay.textContent = newName;
        profileNameInput.value = '';
        alert('Profile name updated successfully!');
    } else {
        alert('Please enter a valid name.');
    }
});