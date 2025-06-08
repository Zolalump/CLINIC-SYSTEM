document.addEventListener('DOMContentLoaded', () => {
  const notesModal = document.getElementById('notesModal');
  const openBtn = document.getElementById('openNotesModalBtn');
  const cancelBtn = document.getElementById('cancelNotesBtn');
  const closeBtn = document.getElementById('closeNotesBtn');

  const tabAdd = document.getElementById('tabAddNote');
  const tabView = document.getElementById('tabViewNotes');

  const addSection = document.getElementById('addNoteSection');
  const viewSection = document.getElementById('viewNotesSection');

  const notesInput = document.getElementById('notesInput');
  const saveBtn = document.getElementById('saveNotesBtn');
  const notesList = document.getElementById('notesList');

  const deleteModal = document.getElementById('deleteModal');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

  // Dynamically get the id_number from a global variable or wherever it's set
  const idNumber = window.idNumber || ''; 
  let notes = [];
  let noteToDeleteId = null;

  if (openBtn) {
    openBtn.addEventListener('click', () => {
      if (!idNumber) {
        alert('User ID not found.');
        return;
      }
      if (notesModal) notesModal.classList.remove('hidden');
      showAdd();
      loadNotesFromServer();
    });
  }

  if (cancelBtn) {
    cancelBtn.addEventListener('click', () => {
      if (notesModal) notesModal.classList.add('hidden');
      if (notesInput) notesInput.value = '';
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      if (notesModal) notesModal.classList.add('hidden');
    });
  }

  if (tabAdd) tabAdd.addEventListener('click', showAdd);
  if (tabView) tabView.addEventListener('click', showView);

  function showAdd() {
    if (addSection) addSection.classList.remove('hidden');
    if (viewSection) viewSection.classList.add('hidden');
  }

  function showView() {
    if (addSection) addSection.classList.add('hidden');
    if (viewSection) viewSection.classList.remove('hidden');
    renderNotes();
  }

  async function loadNotesFromServer() {
    try {
      const response = await fetch(`notes_api.php?action=load&id_number=${encodeURIComponent(idNumber)}`);
      if (!response.ok) throw new Error('Network response was not ok');
      const data = await response.json();
      notes = data || [];
      renderNotes();
    } catch (error) {
      console.error('Error loading notes:', error);
      alert('Failed to load notes.');
    }
  }

  async function saveNoteToServer(content) {
    try {
      const response = await fetch('notes_api.php?action=save', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_number: idNumber, content })
      });
      if (!response.ok) throw new Error('Network response was not ok');
      await response.json();
      loadNotesFromServer();
    } catch (error) {
      console.error('Error saving note:', error);
      alert('Failed to save note.');
    }
  }

async function deleteNoteFromServer(noteId) {
  try {
    const response = await fetch('notes_api.php?action=delete', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id: noteId,
        id_number: idNumber // include id_number in the request
      })
    });

    if (!response.ok) throw new Error('Failed to delete note');

    const result = await response.json();
    if (result.success) {
      loadNotesFromServer(); // Refresh the notes display
    } else {
      alert(result.error || 'Failed to delete note.');
    }
  } catch (error) {
    console.error('Error deleting note:', error);
    alert('Error deleting note.');
  }
}

  if (saveBtn) {
    saveBtn.addEventListener('click', () => {
      const content = notesInput?.value.trim();
      if (!content) return;

      if (notesInput) notesInput.value = '';
      saveNoteToServer(content);
      showView();
    });
  }

  function renderNotes() {
    if (!notesList) return;

    notesList.innerHTML = '';

    if (!notes.length) {
      notesList.innerHTML = '<li class="text-gray-400 italic">No notes saved yet.</li>';
      return;
    }

    notes.forEach(note => {
      const li = document.createElement('li');
      li.className = 'bg-gray-50 border rounded-md p-3 flex justify-between items-start';

      const noteContent = document.createElement('div');
      noteContent.innerHTML = `
        <p class="text-sm text-gray-800 whitespace-pre-wrap">${note.content}</p>
        <small class="text-gray-400 text-xs">${note.created_at}</small>
      `;

      const delBtn = document.createElement('button');
      delBtn.innerHTML = '<i class="fas fa-trash text-red-500 hover:text-red-700"></i>';
      delBtn.addEventListener('click', () => {
        noteToDeleteId = note.id;
        if (deleteModal) deleteModal.classList.remove('hidden');
      });

      li.appendChild(noteContent);
      li.appendChild(delBtn);
      notesList.appendChild(li);
    });
  }

  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', () => {
      if (noteToDeleteId !== null) {
        deleteNoteFromServer(noteToDeleteId);
        noteToDeleteId = null;
        if (deleteModal) deleteModal.classList.add('hidden');
      }
    });
  }

  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', () => {
      noteToDeleteId = null;
      if (deleteModal) deleteModal.classList.add('hidden');
    });
  }
});
