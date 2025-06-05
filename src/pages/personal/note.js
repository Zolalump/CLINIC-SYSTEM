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

  // Delete modal elements
  const deleteModal = document.getElementById('deleteModal');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

  let notes = [];
  let noteToDeleteId = null;

  openBtn.addEventListener('click', () => {
    notesModal.classList.remove('hidden');
    showAdd();
  });

  cancelBtn.addEventListener('click', () => {
    notesModal.classList.add('hidden');
    notesInput.value = '';
  });

  closeBtn.addEventListener('click', () => {
    notesModal.classList.add('hidden');
  });

  tabAdd.addEventListener('click', showAdd);
  tabView.addEventListener('click', showView);

  function showAdd() {
    addSection.classList.remove('hidden');
    viewSection.classList.add('hidden');
  }

  function showView() {
    addSection.classList.add('hidden');
    viewSection.classList.remove('hidden');
    renderNotes();
  }

  saveBtn.addEventListener('click', () => {
    const content = notesInput.value.trim();
    if (!content) return;

    notes.unshift({
      id: Date.now(),
      content,
      time: new Date().toLocaleString()
    });

    notesInput.value = '';
    showView();
  });

  function renderNotes() {
    notesList.innerHTML = '';

    if (notes.length === 0) {
      notesList.innerHTML = '<li class="text-gray-400 italic">No notes saved yet.</li>';
      return;
    }

    notes.forEach(note => {
      const li = document.createElement('li');
      li.className = 'bg-gray-50 border rounded-md p-3 flex justify-between items-start';

      const noteContent = document.createElement('div');
      noteContent.innerHTML = `
        <p class="text-sm text-gray-800 whitespace-pre-wrap">${note.content}</p>
        <small class="text-gray-400 text-xs">${note.time}</small>
      `;

      const delBtn = document.createElement('button');
      delBtn.innerHTML = '<i class="fas fa-trash text-red-500 hover:text-red-700"></i>';
      delBtn.addEventListener('click', () => {
        noteToDeleteId = note.id;
        deleteModal.classList.remove('hidden');
      });

      li.appendChild(noteContent);
      li.appendChild(delBtn);
      notesList.appendChild(li);
    });
  }

  confirmDeleteBtn.addEventListener('click', () => {
    if (noteToDeleteId !== null) {
      notes = notes.filter(n => n.id !== noteToDeleteId);
      noteToDeleteId = null;
      renderNotes();
      deleteModal.classList.add('hidden');
    }
  });

  cancelDeleteBtn.addEventListener('click', () => {
    noteToDeleteId = null;
    deleteModal.classList.add('hidden');
  });
});
