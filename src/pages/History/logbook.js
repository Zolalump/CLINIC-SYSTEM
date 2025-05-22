document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const currentDateEl = document.getElementById('currentDate');
    const currentTimeEl = document.getElementById('currentTime');
    const studentNameInput = document.getElementById('studentName');
    const departmentSelect = document.getElementById('department');
    const classificationSelect = document.getElementById('classification');
    const studentResultsDiv = document.getElementById('studentResults');
    const studentInfoEl = document.getElementById('studentInfo');
    const logEntryForm = document.getElementById('logEntryForm');
    const complaintsInput = document.getElementById('complaints');
    const interventionInput = document.getElementById('intervention');
    const clearButton = document.getElementById('clearButton');
    const recentEntriesTable = document.getElementById('recentEntries');

    // Department classifications
    const departmentOptions = {
        "basic-education": [
            { value: "grade-school", label: "Grade School (Kinder to Grade 6)" },
            { value: "JHS", label: "Junior High School (Grade 7 to 10)" },
            { value: "SHS-11-stem", label: "SHS Grade 11 - STEM" },
            { value: "SHS-11-gas", label: "SHS Grade 11 - GAS" },
            { value: "SHS-11-humss", label: "SHS Grade 11 - HUMSS" },
            { value: "SHS-12-stem", label: "SHS Grade 12 - STEM" },
            { value: "SHS-12-gas", label: "SHS Grade 12 - GAS" },
            { value: "SHS-12-humss", label: "SHS Grade 12 - HUMSS" }
        ],
        "tertiary": [
            { value: "abpsych", label: "Bachelor of Arts in Psychology (ABPsych.)" },
            { value: "BSBA", label: "Bachelor of Science in Business Administration (BSBA)" },
            { value: "beed", label: "Bachelor in Elementary Education (BEED)" },
            { value: "bsed", label: "Bachelor in Secondary Education (BSED)" },
            { value: "bsce", label: "Bachelor of Science in Civil Engineering (BSCE)" },
            { value: "BSN", label: "Bachelor of Science in Nursing (BSN)" },
            { value: "bshm", label: "Bachelor of Science in Hospitality Management" },
            { value: "bstm", label: "Bachelor of Science in Tourism Management (BSTM)" },
            { value: "BSCS", label: "Bachelor of Science in Computer Science (BSCS)" },
            { value: "bscrim", label: "Bachelor of Science in Criminology (BSCrim.)" },
            { value: "graduate", label: "Graduate Education Program" },
            { value: "juris-doctor", label: "Juris Doctor Program" }
        ],
        "personnel": [
            { value: "top-level", label: "Top Level Institutional Administrator" },
            { value: "hed-admin", label: "HED Middle Level Administrator and Faculty" },
            { value: "bed-admin", label: "BED Middle Level Administrator and Faculty" },
            { value: "gs-faculty", label: "Grade School Faculty" },
            { value: "JHS-faculty", label: "JHS Faculty" },
            { value: "SHS-faculty", label: "SHS Faculty" },
            { value: "finance", label: "Finance Personnel" },
            { value: "registrar", label: "Registrar's Office" },
            { value: "ict", label: "ICT Personnel" },
            { value: "guidance", label: "Guidance Office" },
            { value: "clinic", label: "School Clinic" },
            { value: "admin-asst", label: "Administrative Assistants" },
            { value: "campus-min", label: "Campus Ministers" },
            { value: "canteen", label: "Canteen Staff" },
            { value: "lab-custodian", label: "Laboratory Custodian" },
            { value: "plant-supervisor", label: "Physical Plant Supervisor" },
            { value: "property", label: "Property Custodian" },
            { value: "printing", label: "Printing/Binding Office" },
            { value: "library", label: "Library" },
            { value: "community", label: "Community Involvement Program" },
            { value: "maintenance", label: "Maintenance Personnel" },
            { value: "janitorial", label: "Outsourced Janitorial Services" }
        ]
    };

    // Mock student/personnel database - in a real application, this would come from a server
    const database = [
        { id: 1, name: "John Smith", department: "basic-education", classification: "SHS-11-STEM (BED)", section: "Section A", age: 16, year: "3rd Year", position: "Student" },
        { id: 2, name: "Maria Santos", department: "basic-education", classification: "SHS-11-GAS (BED)", section: "Section B", age: 17 },
        { id: 3, name: "Alex Johnson", department: "basic-education", classification: "JHS-7 (BED)", section: "Grade 9-A", age: 15 },
        { id: 4, name: "Sofia Reyes", department: "basic-education", classification: "SHS-12-STEM (BED)", section: "Section C", age: 18 },
        { id: 5, name: "David Kim", department: "tertiary", classification: "BSCS (TEP)", year: "2nd Year", age: 20 },
        { id: 6, name: "Emma Wilson", department: "basic-education", classification: "Grade-school (BED)", section: "Grade 6-B", age: 12 },
        { id: 7, name: "James Rodriguez", department: "tertiary", classification: "BSBA (TEP)", year: "3rd Year", age: 21 },
        { id: 8, name: "Olivia Chen", department: "tertiary", classification: "BSN (TEP)", year: "4th Year", age: 22 },
        { id: 9, name: "Dr. Robert Garcia", department: "personnel", classification: "Clinic", position: "School Physician", age: 45 },
        { id: 10, name: "Ms. Patricia Lee", department: "personnel", classification: "Guidance", position: "Guidance Counselor", age: 38 },
        { id: 11, name: "Prof. Michael Brown", department: "personnel", classification: "Hed-admin", position: "Department Chair", age: 50 },
        { id: 12, name: "Mrs. Jennifer Cruz", department: "personnel", classification: "Gs-faculty", position: "Grade 4 Teacher", age: 32 }
    ];

    // Log entries array
    let logEntries = loadLogEntries();

    // Update date and time
    function updateDateTime() {
        const now = new Date();
        
        // Format date as DD/MM/YYYY
        const dateOptions = { year: 'numeric', month: 'numeric', day: 'numeric' };
        currentDateEl.textContent = `Date: ${now.toLocaleDateString('en-GB', dateOptions)}`;
        
        // Format time as HH:MM:SS
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        currentTimeEl.textContent = `Time: ${now.toLocaleTimeString('en-US', timeOptions)}`;
    }

    // Initialize date and time, then update every second
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Initialize classification dropdown options
    function initClassificationDropdown() {
        // Populate all options for all departments
        Object.keys(departmentOptions).forEach(dept => {
            departmentOptions[dept].forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.value;
                optionElement.textContent = option.label;
                optionElement.dataset.department = dept;
                classificationSelect.appendChild(optionElement);
            });
        });
    }

    // Initialize classification dropdown with all options
    initClassificationDropdown();

    // Filter classification dropdown based on department
    departmentSelect.addEventListener('change', function() {
        const department = this.value;
        
        // Show all options and then hide those that don't match the selected department
        const options = Array.from(classificationSelect.options);
        
        // Skip the first "Select Classification" option
        for (let i = 1; i < options.length; i++) {
            const option = options[i];
            if (!department || option.dataset.department === department) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }
        
        // Reset selection if current selection doesn't belong to selected department
        const currentOption = classificationSelect.options[classificationSelect.selectedIndex];
        if (currentOption.dataset.department !== department) {
            classificationSelect.selectedIndex = 0;
        }
    });

    // Student search functionality
    studentNameInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        if (searchTerm.length < 2) {
            studentResultsDiv.classList.add('hidden');
            return;
        }
        
        // Filter students based on search term
        const matchingResults = database.filter(person => 
            person.name.toLowerCase().includes(searchTerm)
        );
        
        // Display results
        if (matchingResults.length > 0) {
            studentResultsDiv.innerHTML = '';
            matchingResults.forEach(person => {
                const resultItem = document.createElement('div');
                resultItem.classList.add('student-result-item');
                resultItem.textContent = person.name;
                resultItem.dataset.id = person.id;
                
                resultItem.addEventListener('click', function() {
                    selectPerson(person);
                    studentResultsDiv.classList.add('hidden');
                });
                
                studentResultsDiv.appendChild(resultItem);
            });
            studentResultsDiv.classList.remove('hidden');
        } else {
            studentResultsDiv.innerHTML = '<div class="p-3 text-gray-500">No matching records found</div>';
            studentResultsDiv.classList.remove('hidden');
        }
    });

    // Hide search results when clicking outside
    document.addEventListener('click', function(event) {
        if (!studentNameInput.contains(event.target) && !studentResultsDiv.contains(event.target)) {
            studentResultsDiv.classList.add('hidden');
        }
    });

    function selectPerson(person) {
        studentNameInput.value = person.name;
        
        // Set department and classification dropdowns
        departmentSelect.value = person.department;
        
        // Trigger change event to filter classification options
        const changeEvent = new Event('change');
        departmentSelect.dispatchEvent(changeEvent);
        
        // Find and select the matching classification option
        for (let i = 0; i < classificationSelect.options.length; i++) {
            if (classificationSelect.options[i].value === person.classification) {
                classificationSelect.selectedIndex = i;
                break;
            }
        }
        
        // Display additional info based on department
        let infoText = '';
        if (person.department === 'basic-education') {
            infoText = `${person.section} | Age: ${person.age}`;
            logEntryForm.dataset.section = person.section || ''; // Ensure section is set
            logEntryForm.dataset.year = '';  // Clear year for basic-education
            logEntryForm.dataset.position = '';  // Clear position for basic-education
        } else if (person.department === 'tertiary') {
            infoText = `${person.year} | Age: ${person.age}`;
            logEntryForm.dataset.year = person.year || ''; // Ensure year is set
            logEntryForm.dataset.section = '';  // Clear section for tertiary
            logEntryForm.dataset.position = '';  // Clear position for tertiary
        } else if (person.department === 'personnel') {
            infoText = `${person.position} | Age: ${person.age}`;
            logEntryForm.dataset.position = person.position || ''; // Ensure position is set
            logEntryForm.dataset.year = '';  // Clear year for personnel
            logEntryForm.dataset.section = '';  // Clear section for personnel
        }
        
        studentInfoEl.textContent = infoText;
        
        // Store selected person data in form
        logEntryForm.dataset.id = person.id;
        logEntryForm.dataset.name = person.name;
        logEntryForm.dataset.department = person.department;
        logEntryForm.dataset.classification = person.classification;
        logEntryForm.dataset.additionalInfo = infoText;
        logEntryForm.dataset.age = person.age || '';  // Ensure age is set
    }
    
    
    // Clear form function
    function clearForm() {
        studentNameInput.value = '';
        departmentSelect.value = '';
        classificationSelect.selectedIndex = 0;
        studentInfoEl.textContent = 'No student/personnel selected';
        complaintsInput.value = '';
        interventionInput.value = '';
        
        // Clear form dataset
        delete logEntryForm.dataset.id;
        delete logEntryForm.dataset.name;
        delete logEntryForm.dataset.department;
        delete logEntryForm.dataset.classification;
        delete logEntryForm.dataset.additionalInfo;
        delete logEntryForm.dataset.departmentLabel;
        delete logEntryForm.dataset.classificationLabel;
    }

    // Clear button event
    clearButton.addEventListener('click', clearForm);

    logEntryForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        if (!logEntryForm.dataset.id) {
            showToast('Please select a student/personnel first', 'error');
            return;
        }
    
        if (!complaintsInput.value.trim()) {
            showToast('Please enter the complaints', 'error');
            complaintsInput.focus();
            return;
        }
    
        if (!interventionInput.value.trim()) {
            showToast('Please enter the intervention provided', 'error');
            interventionInput.focus();
            return;
        }
    
        const payload = {
            student_id: Number(logEntryForm.dataset.id),
            name: logEntryForm.dataset.name,
            department: logEntryForm.dataset.department,
            classification: logEntryForm.dataset.classification,
            section: logEntryForm.dataset.section || null,
            year: logEntryForm.dataset.year || null,
            position: logEntryForm.dataset.position || null,
            age: Number(logEntryForm.dataset.age) || null,
            complaints: complaintsInput.value.trim(),
            intervention: interventionInput.value.trim()
        };

    
        // Extract section, year, position, and age from dataset.additionalInfo if available
        const info = logEntryForm.dataset.additionalInfo;
        if (info) {
            // crude example, you might want to enhance this
            const ageMatch = info.match(/Age: (\d+)/);
            if (ageMatch) payload.age = Number(ageMatch[1]);
    
            const sectionMatch = info.match(/Section: ([\w\s-]+)/);
            if (sectionMatch) payload.section = sectionMatch[1];
    
            const yearMatch = info.match(/Year: ([\w\s-]+)/);
            if (yearMatch) payload.year = yearMatch[1];
    
            const positionMatch = info.match(/Position: ([\w\s-]+)/);
            if (positionMatch) payload.position = positionMatch[1];
        }
    
        // Send data to PHP
        fetch('/WebDa/CLINIC-SYSTEM-3/src/php/save_entry.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(response => {
            if (response.status === 'success') {
                // Add to local view
                const now = new Date();
                const logEntry = {
                    id: Date.now(),
                    ...payload,
                    departmentLabel: logEntryForm.dataset.departmentLabel,
                    classificationLabel: logEntryForm.dataset.classificationLabel,
                    additionalInfo: info,
                    date: now.toLocaleDateString('en-GB'),
                    time: now.toLocaleTimeString('en-US')
                };
                logEntries.unshift(logEntry);
                saveLogEntries();
                updateRecentEntries();
                clearForm();
                showToast('Log entry added successfully!', 'success');
            } else {
                showToast('Failed to save entry: ' + response.message, 'error');
            }
        })
        .catch(error => {
            console.error(error);
            showToast('An error occurred. Please try again.', 'error');
        });
    });
    

    // Load log entries from local storage
    function loadLogEntries() {
        const storedEntries = localStorage.getItem('clinicLogEntries');
        return storedEntries ? JSON.parse(storedEntries) : [];
    }

    // Save log entries to local storage
    function saveLogEntries() {
        // Limit to most recent 100 entries to prevent storage issues
        if (logEntries.length > 100) {
            logEntries = logEntries.slice(0, 100);
        }
        localStorage.setItem('clinicLogEntries', JSON.stringify(logEntries));
    }

    // Delete entry function
    function deleteEntry(entryId, reason) {
        // Find the entry index
        const entryIndex = logEntries.findIndex(entry => entry.id === entryId);
        
        if (entryIndex !== -1) {
            // Store deletion reason if provided
            if (reason) {
                const deletedEntry = {...logEntries[entryIndex]};
                deletedEntry.deletionReason = reason;
                deletedEntry.deletedAt = new Date().toISOString();
                
                // In a real application, you might want to store deleted entries separately
                const deletedEntries = JSON.parse(localStorage.getItem('deletedClinicLogEntries') || '[]');
                deletedEntries.push(deletedEntry);
                localStorage.setItem('deletedClinicLogEntries', JSON.stringify(deletedEntries));
            }
            
            // Remove from active entries
            logEntries.splice(entryIndex, 1);
            saveLogEntries();
            updateRecentEntries();
            
            showToast('Entry deleted successfully', 'success');
        }
    }

    // Close all delete confirmation dropdowns
    function closeAllDeleteDropdowns() {
        const dropdowns = document.querySelectorAll('.delete-options');
        dropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }

    // Event listener for clicks outside delete dropdowns
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.delete-button') && !event.target.closest('.delete-options')) {
            closeAllDeleteDropdowns();
        }
    });

    // Update recent entries table
    function updateRecentEntries() {
        if (logEntries.length === 0) {
            recentEntriesTable.innerHTML = `
                <tr class="border-b">
                    <td colspan="7" class="py-4 px-4 text-center text-gray-500">No recent entries</td>
                </tr>
            `;
            return;
        }
        
        recentEntriesTable.innerHTML = '';
        
        // Display the 5 most recent entries
        const entriesToShow = logEntries.slice(0, 5);
        
        entriesToShow.forEach(entry => {
            const row = document.createElement('tr');
            row.classList.add('border-b');
            
            row.innerHTML = `
                <td class="py-3 px-4">${entry.name}</td>
                <td class="py-3 px-4">${entry.departmentLabel || formatDepartment(entry.department)}</td>
                <td class="py-3 px-4">${entry.classificationLabel || formatClassification(entry.classification)}</td>
                <td class="py-3 px-4">${entry.date} ${entry.time}</td>
                <td class="py-3 px-4">${truncateText(entry.complaints, 30)}</td>
                <td class="py-3 px-4">${truncateText(entry.intervention, 30)}</td>
                <td class="py-3 px-4 relative">
                    <button class="delete-button bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md text-sm" 
                            data-entry-id="${entry.id}">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                    <div class="delete-options hidden absolute right-0 bg-white border border-gray-200 rounded-md shadow-lg mt-1 z-10 w-48">
                        <p class="px-4 py-2 text-sm font-medium border-b border-gray-200">Reason for deletion:</p>
                        <button class="delete-reason w-full text-left px-4 py-2 text-sm hover:bg-gray-100" 
                                data-reason="Duplicate Entry" data-entry-id="${entry.id}">
                            Duplicate Entry
                        </button>
                        <button class="delete-reason w-full text-left px-4 py-2 text-sm hover:bg-gray-100" 
                                data-reason="Incorrect Information" data-entry-id="${entry.id}">
                            Incorrect Information
                        </button>
                        <button class="delete-reason w-full text-left px-4 py-2 text-sm hover:bg-gray-100" 
                                data-reason="Entry Resolved" data-entry-id="${entry.id}">
                            Entry Resolved
                        </button>
                        <button class="delete-reason w-full text-left px-4 py-2 text-sm hover:bg-gray-100" 
                                data-reason="Other" data-entry-id="${entry.id}">
                            Other
                        </button>
                    </div>
                </td>
            `;
            
            recentEntriesTable.appendChild(row);
        });
        
        // Add event listeners for delete buttons
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                
                // Close all other dropdowns first
                closeAllDeleteDropdowns();
                
                // Show this dropdown
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('hidden');
            });
        });
        
        // Add event listeners for delete reason buttons
        document.querySelectorAll('.delete-reason').forEach(button => {
            button.addEventListener('click', function() {
                const entryId = Number(this.dataset.entryId);
                const reason = this.dataset.reason;
                
                if (reason === 'Other') {
                    const customReason = prompt('Please specify the reason for deletion:');
                    if (customReason) {
                        deleteEntry(entryId, customReason);
                    }
                } else {
                    deleteEntry(entryId, reason);
                }
                
                // Hide the dropdown
                this.closest('.delete-options').classList.add('hidden');
            });
        });
    }

    // Helper function to format department name for display
    function formatDepartment(department) {
        const departmentMap = {
            'basic-education': 'Basic Education Department',
            'tertiary': 'Tertiary Education Program',
            'personnel': 'Personnel'
        };
        return departmentMap[department] || department;
    }

    // Helper function to format classification for display
    function formatClassification(classification) {
        // Flatten all classification options for lookup
        const allOptions = Object.values(departmentOptions).flat();
        const option = allOptions.find(opt => opt.value === classification);
        return option ? option.label : classification;
    }

    // Helper function to truncate text
    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
    }

    // Show toast notification
    function showToast(message, type = 'success') {
        // Remove any existing toasts
        const existingToast = document.querySelector('.success-toast');
        if (existingToast) {
            existingToast.remove();
        }
        
        // Create new toast
        const toast = document.createElement('div');
        toast.classList.add('success-toast');
        
        // Set icon and color based on type
        let icon, bgColor;
        if (type === 'success') {
            icon = '<i class="fas fa-check-circle"></i>';
            bgColor = '#10b981'; // Green
        } else {
            icon = '<i class="fas fa-exclamation-circle"></i>';
            bgColor = '#ef4444'; // Red
        }
        
        toast.style.backgroundColor = bgColor;
        toast.innerHTML = `${icon} ${message}`;
        
        // Add to document
        document.body.appendChild(toast);
        
        // Trigger animation
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }

    // Initialize recent entries
    updateRecentEntries();
});