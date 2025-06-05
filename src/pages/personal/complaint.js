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
  const complaintsContainer = document.getElementById('complaints-container');

  const deleteModal = document.getElementById('deleteModal');
  const deleteCancelBtn = document.getElementById('deleteCancelBtn');
  const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');

  const loggedInUserId = window.loggedInUserId || 0;

  let complaintsToAdd = [];
  let allComplaints = [];
  let complaintIndexToDelete = null;
  let currentIdNumber = null; // ✅ stores the selected user's ID number

  // Open modal
  editComplaintBtn.addEventListener('click', () => {
    complaintModalOverlay.classList.remove('hidden');
    complaintForm.reset();
    complaintsToAdd = [];
    renderComplaintList();
  });

  // Cancel modal
  complaintModalOverlay.querySelector('.cancel-btn').addEventListener('click', () => {
    complaintModalOverlay.classList.add('hidden');
  });

  // Add complaint in modal
  addComplaintBtn.addEventListener('click', () => {
    const nurse = document.getElementById('nurse').value.trim();
    const date = document.getElementById('complaint-date').value;
    const disease = document.getElementById('disease').value.trim();
    const severity = document.getElementById('severity').value;
    const medicineName = document.getElementById('medicine-name').value.trim();
    const dosage = document.getElementById('dosage').value.trim();

    if (!nurse || !date || !disease || !severity || !medicineName || !dosage) {
      alert('Please fill in all complaint and medication fields before adding.');
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

  // Save complaints
  complaintForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (!currentIdNumber) {
      alert("No student selected. Please load a user first.");
      return;
    }

    if (complaintsToAdd.length === 0) {
      alert('No complaints to save.');
      return;
    }

    try {
      for (const comp of complaintsToAdd) {
        const response = await fetch('save_complaint.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({
            id_number: currentIdNumber, // ✅ use dynamic ID
            disease: comp.disease,
            severity: comp.severity,
            medication: comp.medicineName,
            dosage: comp.dosage,
            nurse: comp.nurse,
            date: comp.date
          })
        });

        const text = await response.text();
        console.log("Raw response text:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (err) {
          console.error('Invalid JSON from server:', text);
          alert('Unexpected server response. Check console for details.');
          return;
        }
      }

      allComplaints = allComplaints.concat(complaintsToAdd);
      complaintsToAdd = [];
      complaintList.innerHTML = '';
      complaintModalOverlay.classList.add('hidden');
      complaintForm.reset();
      renderAllComplaints();

      alert('All complaints saved successfully!');
    } catch (err) {
      console.error('Error saving complaints:', err);
      alert('An error occurred while saving complaints.');
    }
  });

  function renderAllComplaints() {
    if (allComplaints.length === 0) {
      complaintsEmpty.style.display = 'block';
      complaintsContent.style.display = 'none';
      recordsTableBody.innerHTML = '';
      medicationsTableBody.innerHTML = '';
      complaintsContent.innerHTML = '';
      return;
    }

    complaintsEmpty.style.display = 'none';
    complaintsContent.style.display = 'block';
    complaintsContent.innerHTML = '';
    recordsTableBody.innerHTML = '';
    medicationsTableBody.innerHTML = '';

    allComplaints.forEach((comp, index) => {
      const div = document.createElement('div');
      div.className = `complaint-item-display ${comp.severity}`;
      div.innerHTML = `
        <div class="complaint-display-details">
          <div><strong>Date:</strong> ${comp.date}</div>
          <div><strong>Nurse:</strong> ${comp.nurse}</div>
          <div><strong>Disease:</strong> ${comp.disease}</div>
          <div><strong>Medication:</strong> ${comp.medicineName} (${comp.dosage})</div>
          <div><strong>Severity:</strong> <span class="severity-badge">${comp.severity}</span></div>
          <button class="complaint-remove-btn" title="Remove complaint" data-index="${index}">Remove</button>
        </div>
      `;

      complaintsContent.appendChild(div);

      div.querySelector('.complaint-remove-btn').addEventListener('click', (e) => {
        complaintIndexToDelete = Number(e.target.dataset.index);
        deleteModal.classList.remove('hidden');
      });

      const recordRow = document.createElement('tr');
      recordRow.innerHTML = `
        <td>${comp.nurse}</td>
        <td>${comp.date}</td>
        <td>${comp.disease}</td>
      `;
      recordsTableBody.appendChild(recordRow);

      const medRow = document.createElement('tr');
      medRow.innerHTML = `
        <td>${comp.medicineName}</td>
        <td>${comp.dosage}</td>
        <td>${comp.date}</td>
      `;
      medicationsTableBody.appendChild(medRow);
    });
  }

  deleteCancelBtn.addEventListener('click', () => {
    complaintIndexToDelete = null;
    deleteModal.classList.add('hidden');
  });

  deleteConfirmBtn.addEventListener('click', () => {
    if (complaintIndexToDelete !== null) {
      allComplaints.splice(complaintIndexToDelete, 1);
      complaintIndexToDelete = null;
      deleteModal.classList.add('hidden');
      renderAllComplaints();
    }
  });

  renderAllComplaints();

  // ✅ expose loadComplaints globally so it can be triggered from search
  window.loadComplaints = async function (id_number) {
    currentIdNumber = id_number;

    try {
      const response = await fetch('search_profile.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ id_number })
      });

      const data = await response.json();
      console.log("Fetched profile + complaints data:", data);

      if (!data.success) {
        complaintsEmpty.style.display = 'block';
        complaintsContent.style.display = 'none';
        complaintsContainer.innerHTML = '';
        allComplaints = [];
        renderAllComplaints();
        return;
      }

      allComplaints = data.complaints || [];
      renderAllComplaints();

      complaintsEmpty.style.display = allComplaints.length === 0 ? 'block' : 'none';
      complaintsContent.style.display = allComplaints.length === 0 ? 'none' : 'block';
      complaintsContainer.innerHTML = '';
    } catch (err) {
      console.error("Error loading complaints:", err);
      complaintsEmpty.style.display = 'block';
      complaintsContent.style.display = 'none';
      complaintsContainer.innerHTML = '';
      allComplaints = [];
      renderAllComplaints();
    }
  };
});
