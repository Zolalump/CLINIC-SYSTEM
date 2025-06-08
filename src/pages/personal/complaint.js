function showMessage(message, onOk) {
  const container = document.getElementById('messageContainer');
  const text = document.getElementById('messageText');
  const okBtn = document.getElementById('messageOkBtn');
  const cancelBtn = document.getElementById('messageCancelBtn');

  cancelBtn.classList.add('hidden'); // hide cancel for simple messages
  text.textContent = message;
  container.classList.remove('hidden');

  function cleanup() {
    container.classList.add('hidden');
    okBtn.removeEventListener('click', okHandler);
  }

  function okHandler() {
    cleanup();
    if (onOk) onOk();
  }

  okBtn.addEventListener('click', okHandler);
}

function showConfirm(message, onConfirm, onCancel) {
  const container = document.getElementById('messageContainer');
  const text = document.getElementById('messageText');
  const okBtn = document.getElementById('messageOkBtn');
  const cancelBtn = document.getElementById('messageCancelBtn');

  cancelBtn.classList.remove('hidden'); // show cancel for confirm
  text.textContent = message;
  container.classList.remove('hidden');

  function cleanup() {
    container.classList.add('hidden');
    okBtn.removeEventListener('click', okHandler);
    cancelBtn.removeEventListener('click', cancelHandler);
  }

  function okHandler() {
    cleanup();
    if (onConfirm) onConfirm();
  }
  function cancelHandler() {
    cleanup();
    if (onCancel) onCancel();
  }

  okBtn.addEventListener('click', okHandler);
  cancelBtn.addEventListener('click', cancelHandler);
}


document.addEventListener("DOMContentLoaded", () => {
  const editComplaintBtn = document.querySelector('.edit-btn[data-edit="complaints"]');
  const complaintModalOverlay = document.getElementById('complaintModalOverlay');
  const complaintForm = document.getElementById('complaintForm');
  const complaintList = document.getElementById('complaintList');
  const addComplaintBtn = document.getElementById('addComplaintBtn');

  const recordsTableBody = document.getElementById('recordsTableBody');
  const medicationsTableBody = document.getElementById('medicationsTableBody');

  const complaintsContent = document.getElementById('complaintsContent');
  const complaintsEmpty = document.getElementById('complaintsEmpty');

  let complaintsToAdd = [];
  let allComplaints = [];
  let complaintIdToDelete = null;
  let currentIdNumber = null;

  editComplaintBtn.addEventListener('click', () => {
    complaintModalOverlay.classList.remove('hidden');
    complaintForm.reset();
    complaintsToAdd = [];
    renderComplaintList();
  });

  complaintModalOverlay.querySelector('.cancel-btn').addEventListener('click', () => {
    complaintModalOverlay.classList.add('hidden');
  });

  addComplaintBtn.addEventListener('click', () => {
    const nurse = document.getElementById('nurse').value.trim();
    const date = document.getElementById('complaint-date').value;
    const disease = document.getElementById('disease').value.trim();
    const severity = document.getElementById('severity').value;
    const medicineName = document.getElementById('medicine-name').value.trim();
    const dosage = document.getElementById('dosage').value.trim();

    if (!nurse || !date || !disease || !severity || !medicineName || !dosage) {
      showMessage('Please fill in all complaint and medication fields before adding.');
      return;
    }

    complaintsToAdd.push({ nurse, date, disease, severity, medicineName, dosage });
    complaintForm.reset();
    document.getElementById('severity').value = "";
    renderComplaintList();
  });

  function renderComplaintList() {
    complaintList.innerHTML = '';

    if (complaintsToAdd.length === 0) {
      complaintList.innerHTML = '<li style="color:#666; font-style:italic;">No complaints added yet.</li>';
      return;
    }

    complaintsToAdd.forEach((comp) => {
      const li = document.createElement('li');
      const textSpan = document.createElement('span');
      textSpan.textContent = `${comp.date} - Nurse: ${comp.nurse} - Disease: ${comp.disease} - Medication: ${comp.medicineName} (${comp.dosage})`;

      const severityBadge = document.createElement('span');
      severityBadge.className = comp.severity === 'severe' ? 'severe' : 'mild';
      severityBadge.textContent = comp.severity;

      li.appendChild(textSpan);
      li.appendChild(severityBadge);
      complaintList.appendChild(li);
    });
  }

  complaintForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (!currentIdNumber) {
      showMessage('No student selected. Please load a user first.');
      return;
    }

    if (complaintsToAdd.length === 0) {
      showMessage('No complaints to save.');
      return;
    }

    try {
      for (const comp of complaintsToAdd) {
        const response = await fetch('save_complaint.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({
            id_number: currentIdNumber,
            disease: comp.disease,
            severity: comp.severity,
            medication: comp.medicineName,
            dosage: comp.dosage,
            nurse: comp.nurse,
            date: comp.date
          })
        });

        const data = await response.json();
        if (!data.success) throw new Error('Save failed');
      }

      await window.loadComplaints(currentIdNumber);

      complaintsToAdd = [];
      complaintList.innerHTML = '';
      complaintForm.reset();
      complaintModalOverlay.classList.add('hidden');

      showMessage('All complaints saved successfully!');
    } catch (err) {
      console.error('Save error:', err);
      showMessage('Failed to save complaints.');
    }
  });

  function renderAllComplaints() {
    complaintsContent.innerHTML = '';
    recordsTableBody.innerHTML = '';
    medicationsTableBody.innerHTML = '';

    if (allComplaints.length === 0) {
      complaintsEmpty.style.display = 'block';
      complaintsContent.style.display = 'none';
      return;
    }

    complaintsEmpty.style.display = 'none';
    complaintsContent.style.display = 'block';

    allComplaints.forEach((comp, index) => {
      const div = document.createElement('div');
      div.className = `complaint-item-display ${comp.severity}`;
      div.innerHTML = `
        <div class="complaint-card" data-index="${index}">
          <p>Date: ${comp.date}</p>
          <p>Nurse: ${comp.nurse}</p>
          <p>Disease: ${comp.disease}</p>
          <p>Severity: ${comp.severity}</p>
          <p>Medication: ${comp.medication}</p>
          <p>Dosage: ${comp.dosage}</p>
          <button class="complaint-remove-btn" data-id="${comp.id}" data-index="${index}">Remove</button>
        </div>
      `;
      complaintsContent.appendChild(div);

      div.querySelector('.complaint-remove-btn').addEventListener('click', (e) => {
        complaintIdToDelete = e.target.dataset.id;
        deleteModal.classList.remove('hidden');
      });

      const recordRow = document.createElement('tr');
      recordRow.innerHTML = `<td>${comp.nurse}</td><td>${comp.date}</td><td>${comp.disease}</td>`;
      recordsTableBody.appendChild(recordRow);

      const medRow = document.createElement('tr');
      medRow.innerHTML = `<td>${comp.medication}</td><td>${comp.dosage}</td><td>${comp.date}</td>`;
      medicationsTableBody.appendChild(medRow);
    });
  }

document.addEventListener('click', async function (e) {
  if (e.target && e.target.classList.contains('complaint-remove-btn')) {
    const complaintIdToDelete = e.target.getAttribute('data-id');
    console.log('Deleting complaint ID:', complaintIdToDelete);
    console.log('For ID number:', currentIdNumber);

    if (!complaintIdToDelete || !currentIdNumber) {
      showMessage('Complaint ID or ID number is missing.');
      return;
    }

    showConfirm('Are you sure you want to delete this complaint?', async () => {
      try {
        const response = await fetch('delete_complaint.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({
            id_number: currentIdNumber,
            complaint_id: complaintIdToDelete
          })
        });

        const text = await response.text();

        let data;
        try {
          data = JSON.parse(text);
        } catch (jsonErr) {
          console.error('Failed to parse JSON:', jsonErr);
          console.log('Raw response from server:', text);
          showMessage('An error occurred: Invalid response from server.');
          return;
        }

        if (data.success) {
          showMessage(data.message, () => {
            loadComplaints(currentIdNumber);
          });
        } else {
          showMessage('Error: ' + data.error);
        }
      } catch (err) {
        console.error('Fetch error:', err);
        showMessage('An error occurred while deleting complaint.');
      }
    });
  }
});



  window.loadComplaints = async function (id_number) {
    currentIdNumber = id_number;

    try {
      const response = await fetch('search_profile.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ id_number })
      });

      const data = await response.json();

      allComplaints = data.success ? (data.complaints || []) : [];
      renderAllComplaints();
    } catch (err) {
      console.error("Error loading complaints:", err);
      allComplaints = [];
      renderAllComplaints();
    }
  };

  renderAllComplaints();
});



