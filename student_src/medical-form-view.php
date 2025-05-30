<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./img/SMC.png" type="image/png">
    <title>SMCTI Clinic - Medical Form</title>
    <link rel="stylesheet" href="../index.css">
    <script async src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      body {
        background-color: #f0f4f8;
        font-family: "Inter", sans-serif;
      }
      .form-container {
        background-color: white;
        border-radius: 12px;
        box-shadow:
          0 4px 6px rgba(0, 0, 0, 0.05),
          0 10px 15px rgba(0, 0, 0, 0.03);
      }
      .form-header {
        border-bottom: 1px solid #e5e7eb;
      }
      .form-section {
        background-color: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
      }
      .btn-primary {
        background-color: #2563eb;
        color: white;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        border-radius: 0.375rem;
        transition: background-color 0.2s;
      }
      .btn-primary:hover {
        background-color: #1d4ed8;
      }
      .btn-secondary {
        background-color: white;
        color: #4b5563;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        transition: background-color 0.2s;
      }
      .btn-secondary:hover {
        background-color: #f9fafb;
      }
      .btn-edit {
        background-color: #f59e0b;
        color: white;
        font-weight: 500;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        transition: background-color 0.2s;
        font-size: 0.875rem;
      }
      .btn-edit:hover {
        background-color: #d97706;
      }
      .floating-label {
        position: relative;
        margin-bottom: 1rem;
      }
      .floating-label input {
        width: 100%;
        height: 3.5rem;
        padding: 1.5rem 1rem 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        transition:
          border-color 0.2s,
          box-shadow 0.2s;
      }
      .floating-label input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
      }
      .floating-label label {
        position: absolute;
        left: 1rem;
        top: 1rem;
        color: #64748b;
        pointer-events: none;
        transition: all 0.2s;
      }
      .floating-label input:focus + label,
      .floating-label input:not(:placeholder-shown) + label {
        transform: translateY(-0.75rem) scale(0.75);
        color: #3b82f6;
      }
      .floating-label input:focus + label {
        color: #3b82f6;
      }
    </style>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="min-h-screen py-8 px-4">

    

    <div class="form-container max-w-4xl mx-auto p-0 overflow-hidden">
      <!-- Form Header -->
      <div class="form-header p-6 bg-white">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-4">
              <img src="../img/SMC.png" alt="SMC">
            </div>
            <div>
              <h1 class="text-2xl font-bold text-gray-900">
                Medical Form
              </h1>
              <p class="text-gray-500 text-sm">
                View and edit patient medical information
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="px-6 pb-6 bg-white">
        <div id="no-data-message" class="py-12 space-y-4 text-center">
          <p class="text-gray-500 text-lg">
            No patient data loaded. Go back to dashboard and submit a medical form.
          </p>

          <div class="flex justify-center ">
            <a class="flex flex-row-reverse duration-200 transition-color hover:border-gray-300 hover:bg-gray-100 p-2 text-gray-600 hover:text-black border-gray-200 shadow-sm rounded-sm items-center" href="./dashboard.php">Return
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 mr-1 rotate-[180deg]"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </a>
          </div>
        </div>

        <div id="patient-data" class="hidden space-y-6">
          <!-- Personal Information -->
          <div class="form-section p-4">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold text-gray-800">
                Personal Information
              </h2>
              <button
                class="btn-edit edit-section-btn"
                data-section="personal-info"
              >
                Edit
              </button>
            </div>

            <div
              id="personal-info-view"
              class="grid grid-cols-1 md:grid-cols-2 gap-4"
            >
              <!-- Will be populated by JavaScript -->
            </div>

            <div id="personal-info-edit" class="hidden space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="floating-label">
                  <input type="text" id="edit-firstName" placeholder=" " />
                  <label for="edit-firstName">First Name</label>
                </div>
                <div class="floating-label">
                  <input type="text" id="edit-lastName" placeholder=" " />
                  <label for="edit-lastName">Last Name</label>
                </div>
              </div>

              <div class="floating-label">
                <input type="date" id="edit-dateOfBirth" placeholder=" " />
                <label for="edit-dateOfBirth">Date of Birth</label>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="floating-label">
                  <input type="email" id="edit-email" placeholder=" " />
                  <label for="edit-email">Email</label>
                </div>
                <div class="floating-label">
                  <input type="tel" id="edit-phone" placeholder=" " />
                  <label for="edit-phone">Phone Number</label>
                </div>
              </div>

              <div class="floating-label">
                <input type="text" id="edit-address" placeholder=" " />
                <label for="edit-address">Address</label>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="floating-label">
                  <input type="text" id="edit-city" placeholder=" " />
                  <label for="edit-city">City</label>
                </div>
                <div class="floating-label">
                  <input type="text" id="edit-state" placeholder=" " />
                  <label for="edit-state">State</label>
                </div>
                <div class="floating-label">
                  <input type="text" id="edit-zipCode" placeholder=" " />
                  <label for="edit-zipCode">Zip Code</label>
                </div>
              </div>

              <div class="flex justify-end space-x-2 pt-4">
                <button
                  class="btn-secondary cancel-edit-btn"
                  data-section="personal-info"
                >
                  Cancel
                </button>
                <button
                  class="btn-primary save-edit-btn"
                  data-section="personal-info"
                >
                  Save Changes
                </button>
              </div>
            </div>
          </div>

          <!-- Emergency Contact Information -->
          <div class="form-section p-4">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold text-gray-800">
                Emergency Contact Information
              </h2>
            </div>

            <div class="space-y-6">
              <div>
                <h3 class="text-lg font-medium mb-3 text-gray-700">
                  Mother's Information
                </h3>
                <div id="mother-info-view">
                  <!-- Will be populated by JavaScript -->
                </div>
              </div>

              <div>
                <h3 class="text-lg font-medium mb-3 text-gray-700">
                  Father's Information
                </h3>
                <div id="father-info-view">
                  <!-- Will be populated by JavaScript -->
                </div>
              </div>

              <div>
                <h3 class="text-lg font-medium mb-3 text-gray-700">
                  Guardian's Information
                </h3>
                <div id="guardian-info-view">
                  <!-- Will be populated by JavaScript -->
                </div>
              </div>
            </div>
          </div>

          <!-- Medical History -->
          <div class="form-section p-4">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold text-gray-800">
                Medical History
              </h2>
              <button
                class="btn-edit edit-section-btn"
                data-section="medical-history"
              >
                Edit
              </button>
            </div>

            <div id="medical-history-view">
              <div class="mb-6">
                <h3 class="text-lg font-medium mb-2 text-gray-700">
                  Vaccination Records
                </h3>
                <div id="vaccines-view">
                  <!-- Will be populated by JavaScript -->
                </div>
              </div>

              <div>
                <h3 class="text-lg font-medium mb-2 text-gray-700">
                  Medical Conditions
                </h3>
                <div id="conditions-view">
                  <!-- Will be populated by JavaScript -->
                </div>
              </div>
            </div>

            <div id="medical-history-edit" class="hidden space-y-6">
              <div>
                <h3 class="text-lg font-medium mb-2 text-gray-700">
                  Vaccination Records
                </h3>
                <div id="vaccines-edit" class="space-y-3">
                  <!-- Will be populated by JavaScript -->
                </div>
                <button
                  id="add-vaccine-btn"
                  class="mt-3 w-full px-4 py-2 border border-blue-300 rounded-md bg-blue-50 hover:bg-blue-100 text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  Add Vaccine Record
                </button>
              </div>

              <div>
                <h3 class="text-lg font-medium mb-2 text-gray-700">
                  Medical Conditions
                </h3>
                <div id="conditions-edit" class="space-y-3">
                  <!-- Will be populated by JavaScript -->
                </div>
                <button
                  id="add-condition-btn"
                  class="mt-3 w-full px-4 py-2 border border-blue-300 rounded-md bg-blue-50 hover:bg-blue-100 text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  Add Medical Condition
                </button>
              </div>

              <div class="flex justify-end space-x-2 pt-4">
                <button
                  class="btn-secondary cancel-edit-btn"
                  data-section="medical-history"
                >
                  Cancel
                </button>
                <button
                  class="btn-primary save-edit-btn"
                  data-section="medical-history"
                >
                  Save Changes
                </button>
              </div>
            </div>
          </div>

          <!-- Social History -->
          <div class="form-section p-4">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold text-gray-800">
                Social History
              </h2>
              <button
                class="btn-edit edit-section-btn"
                data-section="social-history"
              >
                Edit
              </button>
            </div>

            <div
              id="social-history-view"
              class="grid grid-cols-1 md:grid-cols-2 gap-6"
            >
              <!-- Will be populated by JavaScript -->
            </div>

            <div id="social-history-edit" class="hidden space-y-6">
              <!-- Smoking Section -->
              <div>
                <h3 class="text-lg font-medium mb-3 text-gray-700">
                  Smoking History
                </h3>
                <div
                  class="space-y-3 bg-white p-3 rounded-md border border-gray-200"
                >
                  <div class="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      id="edit-current-smoker"
                      class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <label
                      for="edit-current-smoker"
                      class="text-sm font-medium text-gray-700"
                      >Current Smoker</label
                    >
                  </div>

                  <div
                    id="edit-current-smoker-details"
                    class="pl-6 space-y-3 hidden"
                  >
                    <div class="floating-label mb-0">
                      <input
                        type="text"
                        id="edit-packs-per-day"
                        placeholder=" "
                      />
                      <label for="edit-packs-per-day">Packs Per Day</label>
                    </div>
                    <div class="floating-label mb-0">
                      <input
                        type="text"
                        id="edit-years-smoked"
                        placeholder=" "
                      />
                      <label for="edit-years-smoked">Years Smoked</label>
                    </div>
                  </div>

                  <div class="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      id="edit-former-smoker"
                      class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <label
                      for="edit-former-smoker"
                      class="text-sm font-medium text-gray-700"
                      >Former Smoker</label
                    >
                  </div>

                  <div
                    id="edit-former-smoker-details"
                    class="pl-6 space-y-3 hidden"
                  >
                    <div class="floating-label mb-0">
                      <input type="date" id="edit-quit-date" placeholder=" " />
                      <label for="edit-quit-date">Quit Date</label>
                    </div>
                    <div class="floating-label mb-0">
                      <input
                        type="text"
                        id="edit-former-years-smoked"
                        placeholder=" "
                      />
                      <label for="edit-former-years-smoked">Years Smoked</label>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Alcohol Section -->
              <div>
                <h3 class="text-lg font-medium mb-3 text-gray-700">
                  Alcohol Consumption
                </h3>
                <div
                  class="space-y-3 bg-white p-3 rounded-md border border-gray-200"
                >
                  <div class="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      id="edit-current-drinker"
                      class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <label
                      for="edit-current-drinker"
                      class="text-sm font-medium text-gray-700"
                      >Current Alcohol Consumption</label
                    >
                  </div>

                  <div id="edit-current-drinker-details" class="pl-6 hidden">
                    <div class="floating-label mb-0">
                      <input
                        type="text"
                        id="edit-drinks-per-week"
                        placeholder=" "
                      />
                      <label for="edit-drinks-per-week">Drinks Per Week</label>
                    </div>
                  </div>

                  <div class="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      id="edit-former-drinker"
                      class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <label
                      for="edit-former-drinker"
                      class="text-sm font-medium text-gray-700"
                      >Former Alcohol Consumption</label
                    >
                  </div>

                  <div id="edit-former-drinker-details" class="pl-6 hidden">
                    <div class="floating-label mb-0">
                      <input
                        type="date"
                        id="edit-alcohol-quit-date"
                        placeholder=" "
                      />
                      <label for="edit-alcohol-quit-date">Quit Date</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex justify-end space-x-2 pt-4">
                <button
                  class="btn-secondary cancel-edit-btn"
                  data-section="social-history"
                >
                  Cancel
                </button>
                <button
                  class="btn-primary save-edit-btn"
                  data-section="social-history"
                >
                  Save Changes
                </button>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end space-x-3">
            <a class="flex flex-row-reverse p-2 text-gray-600 hover:text-black border-gray-200 shadow-sm rounded-sm items-center" href="./dashboard.html">Return
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 mr-1 rotate-[180deg]"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Vaccine Modal -->
    <div
      id="vaccine-modal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add Vaccine Record</h3>
          <button
            id="close-vaccine-modal"
            class="text-gray-500 hover:text-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"
              >Vaccine Type</label
            >
            <select
              id="vaccine-type"
              class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10 px-3"
            >
              <option value="">Select vaccine type</option>
              <option value="COVID-19">COVID-19</option>
              <option value="Influenza (Flu)">Influenza (Flu)</option>
              <option value="Tetanus">Tetanus</option>
              <option value="Hepatitis A">Hepatitis A</option>
              <option value="Hepatitis B">Hepatitis B</option>
              <option value="MMR (Measles, Mumps, Rubella)">
                MMR (Measles, Mumps, Rubella)
              </option>
              <option value="Varicella (Chickenpox)">
                Varicella (Chickenpox)
              </option>
              <option value="Pneumococcal">Pneumococcal</option>
              <option value="HPV (Human Papillomavirus)">
                HPV (Human Papillomavirus)
              </option>
              <option value="Tdap (Tetanus, Diphtheria, Pertussis)">
                Tdap (Tetanus, Diphtheria, Pertussis)
              </option>
              <option value="Shingles">Shingles</option>
              <option value="Meningococcal">Meningococcal</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="floating-label">
            <input type="date" id="vaccine-date" placeholder=" " />
            <label for="vaccine-date">Date</label>
          </div>

          <div class="floating-label">
            <input type="text" id="vaccine-notes" placeholder=" " />
            <label for="vaccine-notes">Notes (Optional)</label>
          </div>

          <div class="flex justify-end space-x-2 pt-2">
            <button id="cancel-vaccine" class="btn-secondary">Cancel</button>
            <button id="save-vaccine" class="btn-primary">Add Record</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Medical Condition Modal -->
    <div
      id="condition-modal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">
            Add Medical Condition
          </h3>
          <button
            id="close-condition-modal"
            class="text-gray-500 hover:text-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"
              >Condition</label
            >
            <select
              id="condition-type"
              class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10 px-3"
            >
              <option value="">Select condition</option>
              <option value="Hypertension">Hypertension</option>
              <option value="Diabetes">Diabetes</option>
              <option value="Asthma">Asthma</option>
              <option value="Heart Disease">Heart Disease</option>
              <option value="Cancer">Cancer</option>
              <option value="Stroke">Stroke</option>
              <option value="Arthritis">Arthritis</option>
              <option value="Depression">Depression</option>
              <option value="Anxiety">Anxiety</option>
              <option value="COPD">COPD</option>
              <option value="Kidney Disease">Kidney Disease</option>
              <option value="Liver Disease">Liver Disease</option>
              <option value="Thyroid Disorder">Thyroid Disorder</option>
              <option value="Migraine">Migraine</option>
              <option value="Allergies">Allergies</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="floating-label">
            <input type="date" id="diagnosis-date" placeholder=" " />
            <label for="diagnosis-date">Diagnosis Date</label>
          </div>

          <div class="floating-label">
            <input type="text" id="treatment" placeholder=" " />
            <label for="treatment">Treatment (Optional)</label>
          </div>

          <div class="floating-label">
            <input type="text" id="condition-notes" placeholder=" " />
            <label for="condition-notes">Notes (Optional)</label>
          </div>

          <div class="flex justify-end space-x-2 pt-2">
            <button id="cancel-condition" class="btn-secondary">Cancel</button>
            <button id="save-condition" class="btn-primary">
              Add Condition
            </button>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Current patient data
      let patientData = null;

      // DOM Elements
      const noDataMessage = document.getElementById("no-data-message");
      const patientDataContainer = document.getElementById("patient-data");
      const loadDataBtn = document.getElementById("load-data-btn");
      const printRecordBtn = document.getElementById("print-record-btn");
      const exportPdfBtn = document.getElementById("export-pdf-btn");

      // Edit section buttons
      const editSectionBtns = document.querySelectorAll(".edit-section-btn");
      const cancelEditBtns = document.querySelectorAll(".cancel-edit-btn");
      const saveEditBtns = document.querySelectorAll(".save-edit-btn");

      // Medical history elements
      const addVaccineBtn = document.getElementById("add-vaccine-btn");
      const vaccineModal = document.getElementById("vaccine-modal");
      const closeVaccineModal = document.getElementById("close-vaccine-modal");
      const cancelVaccine = document.getElementById("cancel-vaccine");
      const saveVaccine = document.getElementById("save-vaccine");

      const addConditionBtn = document.getElementById("add-condition-btn");
      const conditionModal = document.getElementById("condition-modal");
      const closeConditionModal = document.getElementById(
        "close-condition-modal",
      );
      const cancelCondition = document.getElementById("cancel-condition");
      const saveCondition = document.getElementById("save-condition");

      // Social history elements
      const editCurrentSmoker = document.getElementById("edit-current-smoker");
      const editCurrentSmokerDetails = document.getElementById(
        "edit-current-smoker-details",
      );
      const editFormerSmoker = document.getElementById("edit-former-smoker");
      const editFormerSmokerDetails = document.getElementById(
        "edit-former-smoker-details",
      );

      const editCurrentDrinker = document.getElementById(
        "edit-current-drinker",
      );
      const editCurrentDrinkerDetails = document.getElementById(
        "edit-current-drinker-details",
      );
      const editFormerDrinker = document.getElementById("edit-former-drinker");
      const editFormerDrinkerDetails = document.getElementById(
        "edit-former-drinker-details",
      );

      // Initialize the app
      function init() {
        // Load data button
        loadDataBtn.addEventListener("click", () => {
          // Check if there's data in localStorage first
          const savedData = localStorage.getItem("medicalFormData");
          if (savedData) {
            patientData = JSON.parse(savedData);
            loadDataBtn.textContent = "Refresh Data";
          } else {
            // Fall back to sample data if no saved data exists
            patientData = JSON.parse(JSON.stringify(samplePatientData)); // Deep clone
            loadDataBtn.textContent = "Load Sample Data";
          }
          displayPatientData();
        });

        // Edit section buttons
        editSectionBtns.forEach((btn) => {
          btn.addEventListener("click", () => {
            const section = btn.dataset.section;
            showEditMode(section);
          });
        });

        // Cancel edit buttons
        cancelEditBtns.forEach((btn) => {
          btn.addEventListener("click", () => {
            const section = btn.dataset.section;
            hideEditMode(section);
          });
        });

        // Save edit buttons
        saveEditBtns.forEach((btn) => {
          btn.addEventListener("click", () => {
            const section = btn.dataset.section;
            saveChanges(section);
            hideEditMode(section);
            displayPatientData();
          });
        });

        // Vaccine modal
        addVaccineBtn.addEventListener("click", openVaccineModal);
        closeVaccineModal.addEventListener("click", closeVaccineModalFn);
        cancelVaccine.addEventListener("click", closeVaccineModalFn);
        saveVaccine.addEventListener("click", addVaccineRecord);

        // Condition modal
        addConditionBtn.addEventListener("click", openConditionModal);
        closeConditionModal.addEventListener("click", closeConditionModalFn);
        cancelCondition.addEventListener("click", closeConditionModalFn);
        saveCondition.addEventListener("click", addConditionRecord);

        // Social history checkboxes
        editCurrentSmoker.addEventListener("change", function () {
          editCurrentSmokerDetails.classList.toggle("hidden", !this.checked);
          if (this.checked) {
            editFormerSmoker.checked = false;
            editFormerSmokerDetails.classList.add("hidden");
          }
        });

        editFormerSmoker.addEventListener("change", function () {
          editFormerSmokerDetails.classList.toggle("hidden", !this.checked);
          if (this.checked) {
            editCurrentSmoker.checked = false;
            editCurrentSmokerDetails.classList.add("hidden");
          }
        });

        editCurrentDrinker.addEventListener("change", function () {
          editCurrentDrinkerDetails.classList.toggle("hidden", !this.checked);
          if (this.checked) {
            editFormerDrinker.checked = false;
            editFormerDrinkerDetails.classList.add("hidden");
          }
        });

        editFormerDrinker.addEventListener("change", function () {
          editFormerDrinkerDetails.classList.toggle("hidden", !this.checked);
          if (this.checked) {
            editCurrentDrinker.checked = false;
            editCurrentDrinkerDetails.classList.add("hidden");
          }
        });

        // Print and export buttons
        printRecordBtn.addEventListener("click", () => {
          window.print();
        });

        exportPdfBtn.addEventListener("click", () => {
          alert("PDF export functionality would be implemented here.");
        });
      }

      // Display patient data
      function displayPatientData() {
        if (!patientData) return;

        // Show patient data container, hide no data message
        noDataMessage.classList.add("hidden");
        patientDataContainer.classList.remove("hidden");

        // Display personal info
        displayPersonalInfo();

        // Display emergency contact info if available
        if (patientData.contactInfo) {
          displayEmergencyContactInfo();
        }

        // Display medical history
        displayMedicalHistory();

        // Display social history
        displaySocialHistory();
      }

      // Display personal information
      function displayPersonalInfo() {
        const personalInfoView = document.getElementById("personal-info-view");
        const info = patientData.personalInfo;

        personalInfoView.innerHTML = `
        <div>
          <p class="text-sm text-gray-500">Name</p>
          <p class="font-medium text-gray-900">${info.firstName} ${info.lastName}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Date of Birth</p>
          <p class="font-medium text-gray-900">${formatDate(info.dateOfBirth)}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Email</p>
          <p class="font-medium text-gray-900">${info.email}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Phone</p>
          <p class="font-medium text-gray-900">${info.phone}</p>
        </div>
        <div class="md:col-span-2">
          <p class="text-sm text-gray-500">Address</p>
          <p class="font-medium text-gray-900">${info.address}, ${info.city}, ${info.state} ${info.zipCode}</p>
        </div>
      `;

        // Populate edit form
        document.getElementById("edit-firstName").value = info.firstName;
        document.getElementById("edit-lastName").value = info.lastName;
        document.getElementById("edit-dateOfBirth").value = info.dateOfBirth;
        document.getElementById("edit-email").value = info.email;
        document.getElementById("edit-phone").value = info.phone;
        document.getElementById("edit-address").value = info.address;
        document.getElementById("edit-city").value = info.city;
        document.getElementById("edit-state").value = info.state;
        document.getElementById("edit-zipCode").value = info.zipCode;
      }

      // Display medical history
      function displayMedicalHistory() {
        const vaccinesView = document.getElementById("vaccines-view");
        const conditionsView = document.getElementById("conditions-view");
        const vaccinesEdit = document.getElementById("vaccines-edit");
        const conditionsEdit = document.getElementById("conditions-edit");

        // Display vaccines
        if (patientData.medicalHistory.vaccines.length > 0) {
          let vaccinesList = '<ul class="list-disc pl-5 space-y-1">';
          patientData.medicalHistory.vaccines.forEach((vaccine) => {
            vaccinesList += `
            <li>
              <span class="font-medium">${vaccine.type}</span> - ${formatDate(vaccine.date)}
              ${vaccine.notes ? `<span class="text-gray-600"> (${vaccine.notes})</span>` : ""}
            </li>
          `;
          });
          vaccinesList += "</ul>";
          vaccinesView.innerHTML = vaccinesList;

          // Populate edit view
          vaccinesEdit.innerHTML = "";
          patientData.medicalHistory.vaccines.forEach((vaccine) => {
            const vaccineElement = document.createElement("div");
            vaccineElement.className =
              "flex items-center justify-between bg-white p-3 rounded-md shadow-sm border border-gray-200";
            vaccineElement.innerHTML = `
            <div>
              <h3 class="font-medium text-gray-900">${vaccine.type}</h3>
              <p class="text-sm text-gray-600">Date: ${formatDate(vaccine.date)}</p>
              ${vaccine.notes ? `<p class="text-sm text-gray-500 mt-1">${vaccine.notes}</p>` : ""}
            </div>
            <button class="p-1 hover:bg-gray-100 rounded-full delete-vaccine" data-id="${vaccine.id}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
            </button>
          `;
            vaccinesEdit.appendChild(vaccineElement);
          });

          // Add delete functionality
          document.querySelectorAll(".delete-vaccine").forEach((btn) => {
            btn.addEventListener("click", function () {
              const id = this.dataset.id;
              patientData.medicalHistory.vaccines =
                patientData.medicalHistory.vaccines.filter((v) => v.id !== id);
              displayMedicalHistory();
            });
          });
        } else {
          vaccinesView.innerHTML =
            '<p class="text-gray-500">No vaccination records provided.</p>';
          vaccinesEdit.innerHTML =
            '<p class="text-gray-500">No vaccination records. Add one below.</p>';
        }

        // Display medical conditions
        if (patientData.medicalHistory.medicalConditions.length > 0) {
          let conditionsList = '<ul class="list-disc pl-5 space-y-1">';
          patientData.medicalHistory.medicalConditions.forEach((condition) => {
            conditionsList += `
            <li>
              <span class="font-medium">${condition.condition}</span> - Diagnosed: ${formatDate(condition.diagnosisDate)}
              ${condition.treatment ? `<span class="text-gray-600"> (Treatment: ${condition.treatment})</span>` : ""}
            </li>
          `;
          });
          conditionsList += "</ul>";
          conditionsView.innerHTML = conditionsList;

          // Populate edit view
          conditionsEdit.innerHTML = "";
          patientData.medicalHistory.medicalConditions.forEach((condition) => {
            const conditionElement = document.createElement("div");
            conditionElement.className =
              "flex items-center justify-between bg-white p-3 rounded-md shadow-sm border border-gray-200";
            conditionElement.innerHTML = `
            <div>
              <h3 class="font-medium text-gray-900">${condition.condition}</h3>
              <p class="text-sm text-gray-600">Diagnosed: ${formatDate(condition.diagnosisDate)}</p>
              ${condition.treatment ? `<p class="text-sm text-gray-600">Treatment: ${condition.treatment}</p>` : ""}
              ${condition.notes ? `<p class="text-sm text-gray-500 mt-1">${condition.notes}</p>` : ""}
            </div>
            <button class="p-1 hover:bg-gray-100 rounded-full delete-condition" data-id="${condition.id}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
            </button>
          `;
            conditionsEdit.appendChild(conditionElement);
          });

          // Add delete functionality
          document.querySelectorAll(".delete-condition").forEach((btn) => {
            btn.addEventListener("click", function () {
              const id = this.dataset.id;
              patientData.medicalHistory.medicalConditions =
                patientData.medicalHistory.medicalConditions.filter(
                  (c) => c.id !== id,
                );
              displayMedicalHistory();
            });
          });
        } else {
          conditionsView.innerHTML =
            '<p class="text-gray-500">No medical conditions provided.</p>';
          conditionsEdit.innerHTML =
            '<p class="text-gray-500">No medical conditions. Add one below.</p>';
        }
      }

      // Display emergency contact information
      function displayEmergencyContactInfo() {
        // Mother's info
        const motherInfoView = document.getElementById("mother-info-view");
        if (patientData.contactInfo.mother) {
          if (patientData.contactInfo.mother.deceased) {
            motherInfoView.innerHTML = `<p class="text-gray-500">Deceased</p>`;
          } else if (
            patientData.contactInfo.mother.firstName ||
            patientData.contactInfo.mother.lastName
          ) {
            motherInfoView.innerHTML = `
              <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div>
                  <p class="text-sm text-gray-500">Name</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.mother.firstName} ${patientData.contactInfo.mother.lastName}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Phone</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.mother.phone || "Not provided"}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Email</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.mother.email || "Not provided"}</p>
                </div>
                ${
                  patientData.contactInfo.mother.address
                    ? `
                <div class="md:col-span-2">
                  <p class="text-sm text-gray-500">Address</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.mother.address}</p>
                </div>`
                    : ""
                }
              </div>
            `;
          } else {
            motherInfoView.innerHTML = `<p class="text-gray-500">No information provided</p>`;
          }
        } else {
          motherInfoView.innerHTML = `<p class="text-gray-500">No information provided</p>`;
        }

        // Father's info
        const fatherInfoView = document.getElementById("father-info-view");
        if (patientData.contactInfo.father) {
          if (patientData.contactInfo.father.deceased) {
            fatherInfoView.innerHTML = `<p class="text-gray-500">Deceased</p>`;
          } else if (
            patientData.contactInfo.father.firstName ||
            patientData.contactInfo.father.lastName
          ) {
            fatherInfoView.innerHTML = `
              <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div>
                  <p class="text-sm text-gray-500">Name</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.father.firstName} ${patientData.contactInfo.father.lastName}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Phone</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.father.phone || "Not provided"}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Email</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.father.email || "Not provided"}</p>
                </div>
                ${
                  patientData.contactInfo.father.address
                    ? `
                <div class="md:col-span-2">
                  <p class="text-sm text-gray-500">Address</p>
                  <p class="font-medium text-gray-900">${patientData.contactInfo.father.address}</p>
                </div>`
                    : ""
                }
              </div>
            `;
          } else {
            fatherInfoView.innerHTML = `<p class="text-gray-500">No information provided</p>`;
          }
        } else {
          fatherInfoView.innerHTML = `<p class="text-gray-500">No information provided</p>`;
        }

        // Guardian's info
        const guardianInfoView = document.getElementById("guardian-info-view");
        if (
          patientData.contactInfo.guardian &&
          patientData.contactInfo.guardian.hasGuardian
        ) {
          guardianInfoView.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="font-medium text-gray-900">${patientData.contactInfo.guardian.firstName} ${patientData.contactInfo.guardian.lastName}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Relationship</p>
                <p class="font-medium text-gray-900">${patientData.contactInfo.guardian.relationship || "Not specified"}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Phone</p>
                <p class="font-medium text-gray-900">${patientData.contactInfo.guardian.phone || "Not provided"}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium text-gray-900">${patientData.contactInfo.guardian.email || "Not provided"}</p>
              </div>
              ${
                patientData.contactInfo.guardian.address
                  ? `
              <div class="md:col-span-2">
                <p class="text-sm text-gray-500">Address</p>
                <p class="font-medium text-gray-900">${patientData.contactInfo.guardian.address}</p>
              </div>`
                  : ""
              }
            </div>
          `;
        } else {
          guardianInfoView.innerHTML = `<p class="text-gray-500">No guardian specified</p>`;
        }
      }

      // Display social history
      function displaySocialHistory() {
        const socialHistoryView = document.getElementById(
          "social-history-view",
        );
        const socialHistory = patientData.socialHistory;

        // Create HTML for smoking section
        let smokingHtml = "";
        if (socialHistory.smoking.current) {
          smokingHtml = `
          <div>
            <h3 class="text-lg font-medium mb-2 text-gray-700">Smoking</h3>
            <p class="font-medium text-amber-600">Current Smoker</p>
            <p>Packs per day: ${socialHistory.smoking.packsPerDay || "Not specified"}</p>
            <p>Years smoked: ${socialHistory.smoking.yearsSmoked || "Not specified"}</p>
          </div>
        `;
        } else if (socialHistory.smoking.former) {
          smokingHtml = `
          <div>
            <h3 class="text-lg font-medium mb-2 text-gray-700">Smoking</h3>
            <p class="font-medium">Former Smoker</p>
            <p>Quit date: ${formatDate(socialHistory.smoking.quitDate) || "Not specified"}</p>
            <p>Years smoked: ${socialHistory.smoking.yearsSmoked || "Not specified"}</p>
          </div>
        `;
        } else {
          smokingHtml = `
          <div>
            <h3 class="text-lg font-medium mb-2 text-gray-700">Smoking</h3>
            <p>Non-smoker</p>
          </div>
        `;
        }

        // Create HTML for alcohol section
        let alcoholHtml = "";
        if (socialHistory.alcohol.current) {
          alcoholHtml = `
          <div>
            <h3 class="text-lg font-medium mb-2 text-gray-700">Alcohol</h3>
            <p class="font-medium">Current Alcohol Consumption</p>
            <p>Drinks per week: ${socialHistory.alcohol.drinksPerWeek || "Not specified"}</p>
          </div>
        `;
        } else if (socialHistory.alcohol.former) {
          alcoholHtml = `
          <div>
            <h3 class="text-lg font-medium mb-2 text-gray-700">Alcohol</h3>
            <p class="font-medium">Former Alcohol Consumption</p>
            <p>Quit date: ${formatDate(socialHistory.alcohol.quitDate) || "Not specified"}</p>
          </div>
        `;
        } else {
          alcoholHtml = `
          <div>
            <h3 class="text-lg font-medium mb-2 text-gray-700">Alcohol</h3>
            <p>No alcohol consumption</p>
          </div>
        `;
        }

        // Create HTML for exercise section if it exists
        let exerciseHtml = "";
        if (socialHistory.exercise) {
          if (socialHistory.exercise.regular) {
            exerciseHtml = `
            <div>
              <h3 class="text-lg font-medium mb-2 text-gray-700">Exercise</h3>
              <p class="font-medium text-green-600">Regular Exercise</p>
              <p>Type: ${socialHistory.exercise.type || "Not specified"}</p>
              <p>Frequency: ${socialHistory.exercise.frequency || "Not specified"} times per week</p>
            </div>
          `;
          } else {
            exerciseHtml = `
            <div>
              <h3 class="text-lg font-medium mb-2 text-gray-700">Exercise</h3>
              <p>No regular exercise</p>
            </div>
          `;
          }
        }

        // Create HTML for diet section if it exists
        let dietHtml = "";
        if (socialHistory.diet) {
          if (socialHistory.diet.restrictions) {
            dietHtml = `
            <div>
              <h3 class="text-lg font-medium mb-2 text-gray-700">Diet</h3>
              <p class="font-medium">Dietary Restrictions</p>
              <p>Details: ${socialHistory.diet.details || "Not specified"}</p>
            </div>
          `;
          } else {
            dietHtml = `
            <div>
              <h3 class="text-lg font-medium mb-2 text-gray-700">Diet</h3>
              <p>No dietary restrictions</p>
            </div>
          `;
          }
        }

        // Combine and display
        socialHistoryView.innerHTML =
          smokingHtml + alcoholHtml + exerciseHtml + dietHtml;

        // Populate edit form
        editCurrentSmoker.checked = socialHistory.smoking.current;
        editFormerSmoker.checked = socialHistory.smoking.former;
        document.getElementById("edit-packs-per-day").value =
          socialHistory.smoking.packsPerDay || "";
        document.getElementById("edit-years-smoked").value =
          socialHistory.smoking.yearsSmoked || "";
        document.getElementById("edit-quit-date").value =
          socialHistory.smoking.quitDate || "";
        document.getElementById("edit-former-years-smoked").value =
          socialHistory.smoking.yearsSmoked || "";

        editCurrentSmokerDetails.classList.toggle(
          "hidden",
          !socialHistory.smoking.current,
        );
        editFormerSmokerDetails.classList.toggle(
          "hidden",
          !socialHistory.smoking.former,
        );

        editCurrentDrinker.checked = socialHistory.alcohol.current;
        editFormerDrinker.checked = socialHistory.alcohol.former;
        document.getElementById("edit-drinks-per-week").value =
          socialHistory.alcohol.drinksPerWeek || "";
        document.getElementById("edit-alcohol-quit-date").value =
          socialHistory.alcohol.quitDate || "";

        editCurrentDrinkerDetails.classList.toggle(
          "hidden",
          !socialHistory.alcohol.current,
        );
        editFormerDrinkerDetails.classList.toggle(
          "hidden",
          !socialHistory.alcohol.former,
        );
      }

      // Show edit mode for a section
      function showEditMode(section) {
        document.getElementById(`${section}-view`).classList.add("hidden");
        document.getElementById(`${section}-edit`).classList.remove("hidden");
      }

      // Hide edit mode for a section
      function hideEditMode(section) {
        document.getElementById(`${section}-view`).classList.remove("hidden");
        document.getElementById(`${section}-edit`).classList.add("hidden");
      }

      // Save changes for a section
      function saveChanges(section) {
        if (section === "personal-info") {
          patientData.personalInfo = {
            firstName: document.getElementById("edit-firstName").value,
            lastName: document.getElementById("edit-lastName").value,
            dateOfBirth: document.getElementById("edit-dateOfBirth").value,
            email: document.getElementById("edit-email").value,
            phone: document.getElementById("edit-phone").value,
            address: document.getElementById("edit-address").value,
            city: document.getElementById("edit-city").value,
            state: document.getElementById("edit-state").value,
            zipCode: document.getElementById("edit-zipCode").value,
          };
        } else if (section === "social-history") {
          patientData.socialHistory = {
            smoking: {
              current: document.getElementById("edit-current-smoker").checked,
              former: document.getElementById("edit-former-smoker").checked,
              packsPerDay: document.getElementById("edit-packs-per-day").value,
              yearsSmoked: document.getElementById("edit-current-smoker")
                .checked
                ? document.getElementById("edit-years-smoked").value
                : document.getElementById("edit-former-years-smoked").value,
              quitDate: document.getElementById("edit-quit-date").value,
            },
            alcohol: {
              current: document.getElementById("edit-current-drinker").checked,
              former: document.getElementById("edit-former-drinker").checked,
              drinksPerWeek: document.getElementById("edit-drinks-per-week")
                .value,
              quitDate: document.getElementById("edit-alcohol-quit-date").value,
            },
          };
        }
        // Medical history is saved directly when adding/removing records
      }

      // Vaccine modal functions
      function openVaccineModal() {
        vaccineModal.classList.remove("hidden");
        document.getElementById("vaccine-type").value = "";
        document.getElementById("vaccine-date").value = "";
        document.getElementById("vaccine-notes").value = "";
      }

      function closeVaccineModalFn() {
        vaccineModal.classList.add("hidden");
      }

      function addVaccineRecord() {
        const type = document.getElementById("vaccine-type").value;
        const date = document.getElementById("vaccine-date").value;
        const notes = document.getElementById("vaccine-notes").value;

        if (!type || !date) {
          alert("Please select a vaccine type and date");
          return;
        }

        const id = Date.now().toString();
        patientData.medicalHistory.vaccines.push({ id, type, date, notes });
        displayMedicalHistory();
        closeVaccineModalFn();
      }

      // Condition modal functions
      function openConditionModal() {
        conditionModal.classList.remove("hidden");
        document.getElementById("condition-type").value = "";
        document.getElementById("diagnosis-date").value = "";
        document.getElementById("treatment").value = "";
        document.getElementById("condition-notes").value = "";
      }

      function closeConditionModalFn() {
        conditionModal.classList.add("hidden");
      }

      function addConditionRecord() {
        const condition = document.getElementById("condition-type").value;
        const diagnosisDate = document.getElementById("diagnosis-date").value;
        const treatment = document.getElementById("treatment").value;
        const notes = document.getElementById("condition-notes").value;

        if (!condition || !diagnosisDate) {
          alert("Please select a condition and diagnosis date");
          return;
        }

        const id = Date.now().toString();
        patientData.medicalHistory.medicalConditions.push({
          id,
          condition,
          diagnosisDate,
          treatment,
          notes,
        });
        displayMedicalHistory();
        closeConditionModalFn();
      }

      // Helper function to format dates
      function formatDate(dateString) {
        if (!dateString) return "";
        const date = new Date(dateString);
        return date.toLocaleDateString("en-US", {
          year: "numeric",
          month: "long",
          day: "numeric",
        });
      }

      // Initialize the app
      document.addEventListener("DOMContentLoaded", () => {
        init();

        // Add clear data button functionality
        const clearDataBtn = document.getElementById("clear-data-btn");
        clearDataBtn.addEventListener("click", () => {
          localStorage.removeItem("medicalFormData");
          patientData = null;
          noDataMessage.classList.remove("hidden");
          patientDataContainer.classList.add("hidden");
          loadDataBtn.textContent = "Load Sample Data";
        });

        // Auto-load data from localStorage if available
        const savedData = localStorage.getItem("medicalFormData");
        if (savedData) {
          patientData = JSON.parse(savedData);
          displayPatientData();
          loadDataBtn.textContent = "Refresh Data";
        }
      });
    </script>
  </body>
</html>
