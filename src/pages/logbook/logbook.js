// Function to update department options
function updateDepartmentOptions(rowIndex) {
    const department = document.getElementById(`department-select-${rowIndex}`).value;
    
    // Hide all nested dropdowns first
    document.getElementById(`basic-education-${rowIndex}`).style.display = "none";
    document.getElementById(`tertiary-education-${rowIndex}`).style.display = "none";
    document.getElementById(`shs-track-${rowIndex}`).style.display = "none";
    
    // Clear the grade/year dropdown
    const gradeYearSelect = document.getElementById(`grade-year-select-${rowIndex}`);
    gradeYearSelect.innerHTML = '<option value="">Select Grade/Year</option>';
    
    // Clear the section dropdown
    const sectionSelect = document.getElementById(`section-select-${rowIndex}`);
    sectionSelect.innerHTML = '<option value="">Select Section</option>';
    
    if (department === "Basic Education Department") {
        document.getElementById(`basic-education-${rowIndex}`).style.display = "block";
    } else if (department === "Tertiary Education Programs") {
        document.getElementById(`tertiary-education-${rowIndex}`).style.display = "block";
        
        // Set year options for tertiary
        const yearOptions = [
            '<option value="">Select Year</option>',
            '<option value="1st Year">1st Year</option>',
            '<option value="2nd Year">2nd Year</option>',
            '<option value="3rd Year">3rd Year</option>',
            '<option value="4th Year">4th Year</option>'
        ];
        
        gradeYearSelect.innerHTML = yearOptions.join('');
    } else if (department === "Personnel") {
        // No grade/year applicable for personnel
        gradeYearSelect.innerHTML = '<option value="N/A">N/A</option>';
        sectionSelect.innerHTML = '<option value="N/A">N/A</option>';
    }
}

// Function to update education level options
function updateEducationLevelOptions(rowIndex) {
    const level = document.getElementById(`basic-education-select-${rowIndex}`).value;
    
    // Hide SHS track dropdown
    document.getElementById(`shs-track-${rowIndex}`).style.display = "none";
    
    // Get the grade/year dropdown
    const gradeYearSelect = document.getElementById(`grade-year-select-${rowIndex}`);
    gradeYearSelect.innerHTML = '<option value="">Select Grade/Year</option>';
    
    // Clear the section dropdown
    const sectionSelect = document.getElementById(`section-select-${rowIndex}`);
    sectionSelect.innerHTML = '<option value="">Select Section</option>';
    
    if (level === "Grade School") {
        // Set grade options for grade school
        const gradeOptions = [
            '<option value="">Select Grade</option>',
            '<option value="Grade 1">Grade 1</option>',
            '<option value="Grade 2">Grade 2</option>',
            '<option value="Grade 3">Grade 3</option>',
            '<option value="Grade 4">Grade 4</option>',
            '<option value="Grade 5">Grade 5</option>',
            '<option value="Grade 6">Grade 6</option>'
        ];
        
        gradeYearSelect.innerHTML = gradeOptions.join('');
        
    } else if (level === "High School") {
        // Set grade options for high school
        const gradeOptions = [
            '<option value="">Select Grade</option>',
            '<option value="Grade 7">Grade 7</option>',
            '<option value="Grade 8">Grade 8</option>',
            '<option value="Grade 9">Grade 9</option>',
            '<option value="Grade 10">Grade 10</option>'
        ];
        
        gradeYearSelect.innerHTML = gradeOptions.join('');
        
    } else if (level === "Senior High School") {
        document.getElementById(`shs-track-${rowIndex}`).style.display = "block";
        
        // Set grade options for senior high school
        const gradeOptions = [
            '<option value="">Select Grade</option>',
            '<option value="Grade 11">Grade 11</option>',
            '<option value="Grade 12">Grade 12</option>'
        ];
        
        gradeYearSelect.innerHTML = gradeOptions.join('');
    }
}

// Function to update SHS track options
function updateSHSTrackOptions(rowIndex) {
    const track = document.getElementById(`shs-track-select-${rowIndex}`).value;
    const gradeYear = document.getElementById(`grade-year-select-${rowIndex}`).value;
    
    // If grade is selected, update section options
    if (gradeYear) {
        updateSectionOptions(rowIndex);
    }
}

// Function to update section options based on grade/year and other selections
function updateSectionOptions(rowIndex) {
    const department = document.getElementById(`department-select-${rowIndex}`).value;
    const sectionSelect = document.getElementById(`section-select-${rowIndex}`);
    
    // Clear previous options
    sectionSelect.innerHTML = '<option value="">Select Section</option>';
    
    if (department === "Basic Education Department") {
        const educationLevel = document.getElementById(`basic-education-select-${rowIndex}`).value;
        const gradeYear = document.getElementById(`grade-year-select-${rowIndex}`).value;
        
        if (educationLevel === "Senior High School") {
            const track = document.getElementById(`shs-track-select-${rowIndex}`).value;
            
            if (track === "STEM") {
                // Add STEM sections
                for (let i = 1; i <= 5; i++) {
                    const option = document.createElement('option');
                    option.value = `STEM ${i}`;
                    option.textContent = `STEM ${i}`;
                    sectionSelect.appendChild(option);
                }
            } else if (track === "HUMSS") {
                // Add HUMSS sections
                for (let i = 1; i <= 8; i++) {
                    const option = document.createElement('option');
                    option.value = `HUMSS ${i}`;
                    option.textContent = `HUMSS ${i}`;
                    sectionSelect.appendChild(option);
                }
            } else if (track === "GAS") {
                // Add GAS sections
                for (let i = 1; i <= 6; i++) {
                    const option = document.createElement('option');
                    option.value = `GAS ${i}`;
                    option.textContent = `GAS ${i}`;
                    sectionSelect.appendChild(option);
                }
            }
        } else if (educationLevel === "Grade School" || educationLevel === "High School") {
            // Add general sections for grade school and high school
            for (let i = 1; i <= 10; i++) {
                const option = document.createElement('option');
                option.value = `Section ${i}`;
                option.textContent = `Section ${i}`;
                sectionSelect.appendChild(option);
            }
        }
    } else if (department === "Tertiary Education Programs") {
        const program = document.getElementById(`program-select-${rowIndex}`).value;
        const gradeYear = document.getElementById(`grade-year-select-${rowIndex}`).value;
        
        if (program && gradeYear) {
            // Add program sections (A, B, C) for tertiary
            for (let i = 65; i <= 67; i++) { // ASCII codes for A, B, C
                const sectionLetter = String.fromCharCode(i);
                const option = document.createElement('option');
                option.value = `${program} ${gradeYear} - ${sectionLetter}`;
                option.textContent = `Section ${sectionLetter}`;
                sectionSelect.appendChild(option);
            }
        }
    }
}