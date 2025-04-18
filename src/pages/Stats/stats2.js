document.addEventListener('DOMContentLoaded', function() {
    // Keep original selectors and elements
    const dateRangeSelect = document.getElementById('dateRange');
    const dateSelectorDiv = document.getElementById('dateSelector');
    const filterDepartmentSelect = document.getElementById('filterDepartment');
    const generateReportBtn = document.getElementById('generateReport');
    const exportStatsBtn = document.getElementById('exportStats');
    
    const totalVisitsEl = document.getElementById('totalVisits');
    const commonComplaintEl = document.getElementById('commonComplaint');
    const deptBreakdownEl = document.getElementById('deptBreakdown');
    const avgDailyVisitsEl = document.getElementById('avgDailyVisits');
    const statsTableBody = document.getElementById('statsTableBody');
    
    // Department classifications (copied from logbook.js)
    const departmentOptions = {
        "basic-education": [
            { value: "grade-school", label: "Grade School (Kinder to Grade 6)" },
            { value: "jhs", label: "Junior High School (Grade 7 to 10)" },
            { value: "shs-11-stem", label: "SHS Grade 11 - STEM" },
            { value: "shs-11-gas", label: "SHS Grade 11 - GAS" },
            { value: "shs-11-humss", label: "SHS Grade 11 - HUMSS" },
            { value: "shs-12-stem", label: "SHS Grade 12 - STEM" },
            { value: "shs-12-gas", label: "SHS Grade 12 - GAS" },
            { value: "shs-12-humss", label: "SHS Grade 12 - HUMSS" }
        ],
        "tertiary": [
            { value: "abpsych", label: "Bachelor of Arts in Psychology (ABPsych.)" },
            { value: "bsba", label: "Bachelor of Science in Business Administration (BSBA)" },
            { value: "beed", label: "Bachelor in Elementary Education (BEED)" },
            { value: "bsed", label: "Bachelor in Secondary Education (BSED)" },
            { value: "bsce", label: "Bachelor of Science in Civil Engineering (BSCE)" },
            { value: "bsn", label: "Bachelor of Science in Nursing (BSN)" },
            { value: "bshm", label: "Bachelor of Science in Hospitality Management" },
            { value: "bstm", label: "Bachelor of Science in Tourism Management (BSTM)" },
            { value: "bscs", label: "Bachelor of Science in Computer Science (BSCS)" },
            { value: "bscrim", label: "Bachelor of Science in Criminology (BSCrim.)" },
            { value: "graduate", label: "Graduate Education Program" },
            { value: "juris-doctor", label: "Juris Doctor Program" }
        ],
        "personnel": [
            { value: "top-level", label: "Top Level Institutional Administrator" },
            { value: "hed-admin", label: "HED Middle Level Administrator and Faculty" },
            { value: "bed-admin", label: "BED Middle Level Administrator and Faculty" },
            { value: "gs-faculty", label: "Grade School Faculty" },
            { value: "jhs-faculty", label: "JHS Faculty" },
            { value: "shs-faculty", label: "SHS Faculty" },
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
    
    // Common complaint categories
    const complaintCategories = [
        { keywords: ['fever', 'temperature', 'hot', 'chills'], name: 'Fever' },
        { keywords: ['headache', 'migraine', 'head pain'], name: 'Headache' },
        { keywords: ['cough', 'coughing'], name: 'Cough' },
        { keywords: ['cold', 'flu', 'runny nose', 'stuffy nose'], name: 'Cold/Flu' },
        { keywords: ['stomach', 'gastritis', 'diarrhea', 'vomit', 'nausea'], name: 'Stomach Issues' },
        { keywords: ['asthma', 'breathing', 'breathe', 'wheeze'], name: 'Asthma/Breathing' },
        { keywords: ['injury', 'cut', 'wound', 'bruise', 'sprain'], name: 'Injury' },
        { keywords: ['allergy', 'allergic', 'rash', 'itchy'], name: 'Allergies' },
        { keywords: ['dizzy', 'dizziness', 'vertigo', 'faint'], name: 'Dizziness' },
        { keywords: ['tooth', 'teeth', 'dental', 'toothache'], name: 'Dental Issues' },
        { keywords: ['eye', 'vision', 'seeing'], name: 'Eye Issues' },
        { keywords: ['ear', 'hearing', 'earache'], name: 'Ear Issues' },
        { keywords: ['bite', 'insect', 'mosquito', 'cat', 'dog'], name: 'Bites' },
        { keywords: ['covid', 'corona', 'virus'], name: 'COVID Symptoms' },
        { keywords: ['anxiety', 'stress', 'panic', 'nervous'], name: 'Anxiety/Stress' }
    ];
    
    // Initialize date pickers based on selected range
    function initDateSelectors() {
        const rangeType = dateRangeSelect.value;
        dateSelectorDiv.innerHTML = '';
        
        switch(rangeType) {
            case 'daily':
                // Single date selector
                dateSelectorDiv.innerHTML = `
                    <div>
                        <label for="singleDate" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                        <input type="date" id="singleDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                `;
                // Set default to today
                document.getElementById('singleDate').valueAsDate = new Date();
                break;
                
            case 'weekly':
                // Week selector
                dateSelectorDiv.innerHTML = `
                    <div>
                        <label for="weekSelector" class="block text-sm font-medium text-gray-700 mb-1">Select Week</label>
                        <input type="week" id="weekSelector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                `;
                // Set default to current week
                const now = new Date();
                const weekInput = document.getElementById('weekSelector');
                const year = now.getFullYear();
                let weekNum = getWeekNumber(now);
                weekInput.value = `${year}-W${weekNum.toString().padStart(2, '0')}`;
                break;
                
            case 'monthly':
                // Month selector
                dateSelectorDiv.innerHTML = `
                    <div>
                        <label for="monthSelector" class="block text-sm font-medium text-gray-700 mb-1">Select Month</label>
                        <input type="month" id="monthSelector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                `;
                // Set default to current month
                const currentDate = new Date();
                const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                document.getElementById('monthSelector').value = `${currentDate.getFullYear()}-${month}`;
                break;
                
            case 'semester':
                // Semester and academic year selector
                const currentYear = new Date().getFullYear();
                dateSelectorDiv.innerHTML = `
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="semesterSelector" class="block text-sm font-medium text-gray-700 mb-1">Select Semester</label>
                            <select id="semesterSelector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                                <option value="3">Summer</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="academicYear" class="block text-sm font-medium text-gray-700 mb-1">Academic Year</label>
                            <select id="academicYear" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="${currentYear-1}-${currentYear}">${currentYear-1}-${currentYear}</option>
                                <option value="${currentYear}-${currentYear+1}" selected>${currentYear}-${currentYear+1}</option>
                                <option value="${currentYear+1}-${currentYear+2}">${currentYear+1}-${currentYear+2}</option>
                            </select>
                        </div>
                    </div>
                `;
                break;
                
            case 'yearly':
                // Year selector
                const thisYear = new Date().getFullYear();
                dateSelectorDiv.innerHTML = `
                    <div>
                        <label for="yearSelector" class="block text-sm font-medium text-gray-700 mb-1">Select Year</label>
                        <select id="yearSelector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="${thisYear-2}">${thisYear-2}</option>
                            <option value="${thisYear-1}">${thisYear-1}</option>
                            <option value="${thisYear}" selected>${thisYear}</option>
                        </select>
                    </div>
                `;
                break;
        }
    }
    
    // Get week number function
    function getWeekNumber(d) {
        d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
        d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
        const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
        return Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
    }
    
    // Get date range based on selected options
    function getSelectedDateRange() {
        const rangeType = dateRangeSelect.value;
        let startDate = new Date();
        let endDate = new Date();
        let rangeLabel = '';
        
        switch(rangeType) {
            case 'daily':
                const selectedDate = document.getElementById('singleDate').valueAsDate;
                startDate = new Date(selectedDate);
                startDate.setHours(0, 0, 0, 0);
                endDate = new Date(selectedDate);
                endDate.setHours(23, 59, 59, 999);
                
                rangeLabel = startDate.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
                break;
                
            case 'weekly':
                const weekInput = document.getElementById('weekSelector').value; // Format: 2023-W10
                const parts = weekInput.split('-W');
                const year = parseInt(parts[0]);
                const week = parseInt(parts[1]);
                
                startDate = getDateOfWeek(week, year);
                endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6); // Sunday
                
                startDate.setHours(0, 0, 0, 0);
                endDate.setHours(23, 59, 59, 999);

                rangeLabel = `Week ${week}, ${year} (${startDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })} - ${endDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })})`;
                break;
                
            case 'monthly':
                const monthInput = document.getElementById('monthSelector').value; // Format: 2023-10
                const [yearMonth, monthNum] = monthInput.split('-');
                const year2 = parseInt(yearMonth);
                const month = parseInt(monthNum) - 1; // JS months are 0-indexed
                
                startDate = new Date(year2, month, 1);
                endDate = new Date(year2, month + 1, 0);
                
                startDate.setHours(0, 0, 0, 0);
                endDate.setHours(23, 59, 59, 999);
                
                rangeLabel = startDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
                break;
                
            case 'semester':
                const semesterVal = document.getElementById('semesterSelector').value;
                const academicYear = document.getElementById('academicYear').value; // Format: 2023-2024
                const [startYear, endYear] = academicYear.split('-');
                
                if (semesterVal === '1') {
                    // First semester (August - December)
                    startDate = new Date(`${startYear}-08-01`);
                    endDate = new Date(`${startYear}-12-31`);
                    rangeLabel = `First Semester, AY ${startYear}-${endYear}`;
                } else if (semesterVal === '2') {
                    // Second semester (January - May)
                    startDate = new Date(`${endYear}-01-01`);
                    endDate = new Date(`${endYear}-05-31`);
                    rangeLabel = `Second Semester, AY ${startYear}-${endYear}`;
                } else {
                    // Summer (June - July)
                    startDate = new Date(`${endYear}-06-01`);
                    endDate = new Date(`${endYear}-07-31`);
                    rangeLabel = `Summer, AY ${startYear}-${endYear}`;
                }
                
                startDate.setHours(0, 0, 0, 0);
                endDate.setHours(23, 59, 59, 999);
                break;
                
            case 'yearly':
                const selectedYear = document.getElementById('yearSelector').value;
                startDate = new Date(`${selectedYear}-01-01`);
                endDate = new Date(`${selectedYear}-12-31`);
                
                startDate.setHours(0, 0, 0, 0);
                endDate.setHours(23, 59, 59, 999);
                
                rangeLabel = `Year ${selectedYear}`;
                break;
        }
        
        return { startDate, endDate, rangeLabel };
    }
    
    // Helper to get first day of week number
    function getDateOfWeek(week, year) {
        const januaryFourth = new Date(year, 0, 4);
        const firstDayOfYear = new Date(year, 0, 1);
        const daysOffset = januaryFourth.getDay() || 7;
        
        // Find Monday of first week
        const firstMonday = new Date(januaryFourth);
        firstMonday.setDate(januaryFourth.getDate() - daysOffset + 1);
        
        // Add weeks
        const targetDate = new Date(firstMonday);
        targetDate.setDate(firstMonday.getDate() + ((week - 1) * 7));
        
        return targetDate;
    }
    
    // Fetch mock data (in real implementation, this would be an API call)
    function fetchVisitData(startDate, endDate, department = 'all') {
        // Simulate API request delay
        return new Promise((resolve) => {
            setTimeout(() => {
                // Generate random data for demonstration
                const visitorData = generateMockData(startDate, endDate, department);
                resolve(visitorData);
            }, 500);
        });
    }
    
    // Generate mock data for demonstration with actual section counts
    function generateMockData(startDate, endDate, department) {
        const data = [];
        const totalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
        const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        // Common complaints for mock data
        const commonComplaints = [
            'Headache', 'Fever', 'Stomachache', 'Cough', 'Cold', 
            'Allergy', 'Dizziness', 'Muscle Pain', 'Toothache', 'Injury',
            'Asthma', 'Eye Irritation', 'Nausea', 'Exhaustion', 'Sore Throat'
        ];

        // Population weights based on actual section counts
        const departmentWeights = {
            "basic-education": {
                "grade-school": 14, // 2 sections per grade level kinder to grade 6 (7 levels)
                "jhs": 12, // 3 sections per grade level g7 to g10 (4 levels)
                "shs-11-stem": 11,
                "shs-11-gas": 11,
                "shs-11-humss": 11,
                "shs-12-stem": 11,
                "shs-12-gas": 11,
                "shs-12-humss": 11
            },
            "tertiary": {
                // All tertiary programs have approximately equal weight
                "abpsych": 3,
                "bsba": 3,
                "beed": 3,
                "bsed": 3,
                "bsce": 3,
                "bsn": 3,
                "bshm": 3,
                "bstm": 3,
                "bscs": 3,
                "bscrim": 3,
                "graduate": 2,
                "juris-doctor": 2
            },
            "personnel": {
                // All personnel categories have approximately equal weight
                "top-level": 1,
                "hed-admin": 3,
                "bed-admin": 3,
                "gs-faculty": 3,
                "jhs-faculty": 3,
                "shs-faculty": 3,
                "finance": 2,
                "registrar": 2,
                "ict": 2,
                "guidance": 2,
                "clinic": 2,
                "admin-asst": 2,
                "campus-min": 2,
                "canteen": 2,
                "lab-custodian": 1,
                "plant-supervisor": 1,
                "property": 1,
                "printing": 1,
                "library": 2,
                "community": 1,
                "maintenance": 3,
                "janitorial": 4
            }
        };
        
        // Generate records for each day in range
        for (let i = 0; i < totalDays; i++) {
            const currentDate = new Date(startDate);
            currentDate.setDate(startDate.getDate() + i);
            
            // Skip Sundays
            if (currentDate.getDay() === 0) {
                continue;
            }
            
            // Generate between 5-25 records per day
            const dailyRecordCount = Math.floor(Math.random() * 20) + 5;
            
            for (let j = 0; j < dailyRecordCount; j++) {
                // Generate random visitor data based on weights
                const deptGroup = getRandomDeptGroup(department);
                const specificDept = getWeightedRandomSpecificDept(deptGroup, departmentWeights);
                
                const visitHour = Math.floor(Math.random() * 8) + 8; // 8am-4pm
                const visitMinute = Math.floor(Math.random() * 60);
                
                const visitDateTime = new Date(currentDate);
                visitDateTime.setHours(visitHour, visitMinute);
                
                // Generate visit record
                const record = {
                    visitId: `V${Math.floor(Math.random() * 10000)}`,
                    visitDate: visitDateTime,
                    dayOfWeek: dayNames[visitDateTime.getDay()],
                    department: deptGroup,
                    classification: specificDept,
                    complaint: commonComplaints[Math.floor(Math.random() * commonComplaints.length)],
                    gender: Math.random() > 0.5 ? 'Male' : 'Female'
                };
                
                data.push(record);
            }
        }
        
        return data;
    }
    
    // Get random department group based on filter
    function getRandomDeptGroup(filter) {
        if (filter !== 'all') {
            return filter;
        }
        
        const deptGroups = ['basic-education', 'tertiary', 'personnel'];
        // Weights based on student/personnel distribution
        const weights = [0.5, 0.4, 0.1]; // 50% basic ed, 40% tertiary, 10% personnel
        const random = Math.random();
        
        if (random < weights[0]) return deptGroups[0];
        else if (random < weights[0] + weights[1]) return deptGroups[1];
        else return deptGroups[2];
    }
    
    // Get weighted random specific department from department group
    function getWeightedRandomSpecificDept(deptGroup, weights) {
        const deptOptions = Object.keys(weights[deptGroup]);
        const deptWeights = Object.values(weights[deptGroup]);
        
        // Calculate total weight
        const totalWeight = deptWeights.reduce((sum, weight) => sum + weight, 0);
        
        // Generate random value
        let random = Math.random() * totalWeight;
        
        // Find the department based on weight
        for (let i = 0; i < deptOptions.length; i++) {
            random -= deptWeights[i];
            if (random <= 0) {
                return deptOptions[i];
            }
        }
        
        // Fallback to first option
        return deptOptions[0];
    }
    
    // Calculate statistics from data with detailed category breakdowns
    function calculateStatistics(data) {
        if (!data || data.length === 0) {
            return {
                totalVisits: 0,
                commonComplaint: '-',
                deptBreakdown: {
                    'basic-education': 0,
                    'tertiary': 0,
                    'personnel': 0
                },
                avgDailyVisits: 0,
                detailedStats: [],
                complaintBreakdown: [],
                detailedDeptStats: {
                    'basic-education': {},
                    'tertiary': {},
                    'personnel': {}
                }
            };
        }
        
        // Total visits
        const totalVisits = data.length;
        
        // Department breakdown
        const deptBreakdown = {
            'basic-education': 0,
            'tertiary': 0,
            'personnel': 0
        };
        
        // Detailed department stats
        const detailedDeptStats = {
            'basic-education': {},
            'tertiary': {},
            'personnel': {}
        };
        
        // Initialize detailed department stats
        for (const deptGroup in departmentOptions) {
            departmentOptions[deptGroup].forEach(dept => {
                detailedDeptStats[deptGroup][dept.value] = {
                    count: 0,
                    complaints: {},
                    label: dept.label
                };
            });
        }
        
        // Process each visit
        data.forEach(visit => {
            // Increment department counters
            deptBreakdown[visit.department]++;
            
            // Increment specific department counters
            if (detailedDeptStats[visit.department][visit.classification]) {
                detailedDeptStats[visit.department][visit.classification].count++;
                
                // Track complaints by department and classification
                const complaintKey = visit.complaint;
                if (!detailedDeptStats[visit.department][visit.classification].complaints[complaintKey]) {
                    detailedDeptStats[visit.department][visit.classification].complaints[complaintKey] = 0;
                }
                detailedDeptStats[visit.department][visit.classification].complaints[complaintKey]++;
            }
        });
        
        // Find common complaints overall
        const complaintCounts = {};
        data.forEach(visit => {
            complaintCounts[visit.complaint] = (complaintCounts[visit.complaint] || 0) + 1;
        });
        
        const complaintEntries = Object.entries(complaintCounts);
        complaintEntries.sort((a, b) => b[1] - a[1]);
        const commonComplaint = complaintEntries.length > 0 ? complaintEntries[0][0] : '-';
        
        // Calculate overall complaint breakdown
        const complaintBreakdown = complaintEntries.map(([complaint, count]) => ({
            complaint,
            count,
            percentage: ((count / totalVisits) * 100).toFixed(1)
        }));
        
        // Calculate average daily visits
        const uniqueDays = new Set(data.map(visit => visit.visitDate.toDateString())).size;
        const avgDailyVisits = uniqueDays > 0 ? (totalVisits / uniqueDays).toFixed(1) : 0;
        
        // Generate detailed statistics by classification
        const detailedStats = [];
        
        // Process each department group
        for (const deptGroup in detailedDeptStats) {
            for (const classification in detailedDeptStats[deptGroup]) {
                const stats = detailedDeptStats[deptGroup][classification];
                
                if (stats.count > 0) {
                    // Find most common complaint for this classification
                    const classComplaints = Object.entries(stats.complaints)
                        .sort((a, b) => b[1] - a[1]);
                    
                    const commonClassComplaint = classComplaints.length > 0 
                        ? `${classComplaints[0][0]} (${classComplaints[0][1]} cases)` 
                        : '-';
                    
                    detailedStats.push({
                        department: deptGroup,
                        classification: stats.label,
                        visits: stats.count,
                        commonComplaint: commonClassComplaint,
                        percentage: ((stats.count / totalVisits) * 100).toFixed(1),
                        complaintBreakdown: Object.entries(stats.complaints)
                            .map(([complaint, count]) => ({
                                complaint,
                                count,
                                percentage: ((count / stats.count) * 100).toFixed(1)
                            }))
                            .sort((a, b) => b.count - a.count)
                    });
                }
            }
        }
        
        // Sort detailed stats by visits (descending)
        detailedStats.sort((a, b) => b.visits - a.visits);
        
        return {
            totalVisits,
            commonComplaint,
            deptBreakdown,
            avgDailyVisits,
            detailedStats,
            complaintBreakdown,
            detailedDeptStats
        };
    }
    
    // Update UI with statistics (no charts)
    function updateStatisticsUI(stats, dateRangeLabel) {
        // Update header with date range
        document.querySelector('header p').textContent = `Clinic Visitor Analysis for ${dateRangeLabel}`;
        
        // Update stats cards
        totalVisitsEl.textContent = stats.totalVisits.toLocaleString();
        commonComplaintEl.textContent = stats.commonComplaint;
        
        // Update department breakdown
        deptBreakdownEl.innerHTML = `
            <div>Basic Education: <span class="font-bold">${stats.deptBreakdown['basic-education'].toLocaleString()}</span> (${((stats.deptBreakdown['basic-education'] / stats.totalVisits) * 100).toFixed(1)}%)</div>
            <div>Tertiary: <span class="font-bold">${stats.deptBreakdown['tertiary'].toLocaleString()}</span> (${((stats.deptBreakdown['tertiary'] / stats.totalVisits) * 100).toFixed(1)}%)</div>
            <div>Personnel: <span class="font-bold">${stats.deptBreakdown['personnel'].toLocaleString()}</span> (${((stats.deptBreakdown['personnel'] / stats.totalVisits) * 100).toFixed(1)}%)</div>
        `;
        
        avgDailyVisitsEl.textContent = stats.avgDailyVisits;
        
        // Update Department Tables
        updateDepartmentTables(stats);
        
        // Update Complaint Tables
        updateComplaintTable(stats.complaintBreakdown);
    }
    
    // Update stats table for each department
    function updateDepartmentTables(stats) {
        const deptTablesContainer = document.getElementById('departmentTablesContainer');
        deptTablesContainer.innerHTML = '';
        
 // Update stats table for each department
 function updateDepartmentTables(stats) {
    const deptTablesContainer = document.getElementById('departmentTablesContainer');
    deptTablesContainer.innerHTML = '';
    
    // Create tables for each department
    const departments = ['basic-education', 'tertiary', 'personnel'];
    const departmentLabels = {
        'basic-education': 'Basic Education',
        'tertiary': 'Tertiary Education',
        'personnel': 'Personnel'
    };
    
    departments.forEach(dept => {
        // Filter stats for this department
        const deptStats = stats.detailedStats.filter(s => s.department === dept);
        
        if (deptStats.length > 0) {
            // Create department section
            const deptSection = document.createElement('div');
            deptSection.className = 'mb-8';
            deptSection.innerHTML = `
                <h3 class="text-lg font-semibold mb-3">${departmentLabels[dept]} Department Breakdown</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left">Classification</th>
                                <th class="py-2 px-4 border-b text-center">Visits</th>
                                <th class="py-2 px-4 border-b text-center">Percentage</th>
                                <th class="py-2 px-4 border-b text-left">Common Complaint</th>
                            </tr>
                        </thead>
                        <tbody id="${dept}-table-body">
                        </tbody>
                    </table>
                </div>
            `;
            
            deptTablesContainer.appendChild(deptSection);
            
            // Populate table rows
            const tableBody = document.getElementById(`${dept}-table-body`);
            deptStats.forEach(stat => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                    <td class="py-2 px-4 border-b">${stat.classification}</td>
                    <td class="py-2 px-4 border-b text-center">${stat.visits}</td>
                    <td class="py-2 px-4 border-b text-center">${stat.percentage}%</td>
                    <td class="py-2 px-4 border-b">${stat.commonComplaint}</td>
                `;
                tableBody.appendChild(row);
            });
        }
    });
}

// Update complaint table
function updateComplaintTable(complaintData) {
    // Clear existing table
    statsTableBody.innerHTML = '';
    
    // Add rows for each complaint
    complaintData.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.innerHTML = `
            <td class="py-2 px-4 border-b">${item.complaint}</td>
            <td class="py-2 px-4 border-b text-center">${item.count}</td>
            <td class="py-2 px-4 border-b text-center">${item.percentage}%</td>
        `;
        statsTableBody.appendChild(row);
    });
}

// Generate PDF report
function generatePDFReport(stats, dateRangeLabel) {
    alert("Generated PDF report for " + dateRangeLabel);
    // In a real implementation, this would use a PDF library like jsPDF
    // to generate and download a PDF with the statistics
}

// Export statistics to CSV
function exportToCSV(stats, dateRangeLabel) {
    // Prepare data for CSV
    let csvContent = "data:text/csv;charset=utf-8,";
    
    // Add header row
    csvContent += "Date Range: " + dateRangeLabel + "\n\n";
    csvContent += "Classification,Visits,Percentage,Common Complaint\n";
    
    // Add data rows
    stats.detailedStats.forEach(stat => {
        csvContent += `"${stat.classification}",${stat.visits},${stat.percentage}%,"${stat.commonComplaint}"\n`;
    });
    
    // Add complaint breakdown
    csvContent += "\nComplaint Breakdown\n";
    csvContent += "Complaint,Count,Percentage\n";
    
    stats.complaintBreakdown.forEach(item => {
        csvContent += `"${item.complaint}",${item.count},${item.percentage}%\n`;
    });
    
    // Create download link
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `clinic_stats_${dateRangeLabel.replace(/\s+/g, '_')}.csv`);
    document.body.appendChild(link);
    
    // Trigger download and remove link
    link.click();
    document.body.removeChild(link);
}

// Event listeners
dateRangeSelect.addEventListener('change', function() {
    initDateSelectors();
});

generateReportBtn.addEventListener('click', async function() {
    const { startDate, endDate, rangeLabel } = getSelectedDateRange();
    const departmentFilter = filterDepartmentSelect.value;
    
    // Add loading indicator
    generateReportBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    generateReportBtn.disabled = true;
    
    try {
        // Fetch data and update UI
        const visitData = await fetchVisitData(startDate, endDate, departmentFilter);
        const statistics = calculateStatistics(visitData);
        
        updateStatisticsUI(statistics, rangeLabel);
        
        // Enable report actions
        exportStatsBtn.disabled = false;
    } catch (error) {
        console.error('Error generating report:', error);
        alert('Error generating report. Please try again.');
    } finally {
        // Reset button state
        generateReportBtn.innerHTML = 'Generate Report';
        generateReportBtn.disabled = false;
    }
});

exportStatsBtn.addEventListener('click', function() {
    const { startDate, endDate, rangeLabel } = getSelectedDateRange();
    const departmentFilter = filterDepartmentSelect.value;
    
    // Confirm export
    if (confirm('Export statistics to CSV?')) {
        // Disable button during export
        exportStatsBtn.disabled = true;
        
        setTimeout(async function() {
            try {
                // Re-fetch data to ensure consistency
                const visitData = await fetchVisitData(startDate, endDate, departmentFilter);
                const statistics = calculateStatistics(visitData);
                
                // Export data
                exportToCSV(statistics, rangeLabel);
            } catch (error) {
                console.error('Error exporting statistics:', error);
                alert('Error exporting statistics. Please try again.');
            } finally {
                exportStatsBtn.disabled = false;
            }
        }, 100);
    }
});

// Initialize UI
function initUI() {
    // Initialize department filter dropdown
    const deptsArray = [
        { value: 'all', label: 'All Departments' },
        { value: 'basic-education', label: 'Basic Education' },
        { value: 'tertiary', label: 'Tertiary' },
        { value: 'personnel', label: 'Personnel' }
    ];
    
    filterDepartmentSelect.innerHTML = '';
    deptsArray.forEach(dept => {
        const option = document.createElement('option');
        option.value = dept.value;
        option.textContent = dept.label;
        filterDepartmentSelect.appendChild(option);
    });
    
    // Initialize date selectors
    initDateSelectors();
    
    // Disable export button initially
    exportStatsBtn.disabled = true;
}

// Initialize the application
initUI();

// Auto-generate report on load with default settings
generateReportBtn.click();
    }});
