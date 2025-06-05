document.addEventListener("DOMContentLoaded", () => {
  const editBtn = document.querySelector(".edit-profile-btn");
  const modal = document.getElementById("edit-modal");
  const cancelBtn = modal.querySelector(".cancel-btn");
  const form = document.getElementById("edit-form");

  const searchInput = document.getElementById("searchInput");
  const searchBtn = document.getElementById("searchBtn");
  const studentProfile = document.getElementById("studentProfile");

  // EDIT MODAL LOGIC
  editBtn.addEventListener("click", () => {
    modal.classList.remove("hidden");

    document.getElementById("edit-name").value = document.getElementById("student-name").textContent;
    document.getElementById("edit-email").value = document.getElementById("student-email").textContent;
    document.getElementById("edit-student-course").value = document.getElementById("student-course").textContent;
    document.getElementById("edit-student-id").value = document.getElementById("student-id").textContent;
    document.getElementById("edit-student-gender").value = document.getElementById("student-gender").textContent;
    document.getElementById("edit-student-birthdate").value = document.getElementById("student-birthdate").textContent;
    document.getElementById("edit-student-phone").value = document.getElementById("student-phone").textContent;
    document.getElementById("edit-student-address").value = document.getElementById("student-address").textContent;
    document.getElementById("edit-student-bp").value = document.getElementById("student-bp").textContent;
    document.getElementById("edit-student-weight").value = document.getElementById("student-weight").textContent;
    document.getElementById("edit-student-temp").value = document.getElementById("student-temp").textContent;
  });

  cancelBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
  });

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    document.getElementById("student-name").textContent = document.getElementById("edit-name").value;
    document.getElementById("student-email").textContent = document.getElementById("edit-email").value;
    document.getElementById("student-course").textContent = document.getElementById("edit-student-course").value;
    document.getElementById("student-id").textContent = document.getElementById("edit-student-id").value;
    document.getElementById("student-gender").textContent = document.getElementById("edit-student-gender").value;
    document.getElementById("student-birthdate").textContent = document.getElementById("edit-student-birthdate").value;
    document.getElementById("student-phone").textContent = document.getElementById("edit-student-phone").value;
    document.getElementById("student-address").textContent = document.getElementById("edit-student-address").value;
    document.getElementById("student-bp").textContent = document.getElementById("edit-student-bp").value;
    document.getElementById("student-weight").textContent = document.getElementById("edit-student-weight").value;
    document.getElementById("student-temp").textContent = document.getElementById("edit-student-temp").value;

    modal.classList.add("hidden");
  });

// SEARCH LOGIC
searchBtn.addEventListener("click", () => {
  const id = searchInput.value.trim();
  if (id === "") {
    alert("Please enter a student ID number.");
    return;
  }

  fetch("search_profile.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "id_number=" + encodeURIComponent(id)
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        updateProfileDisplay(data.profile);

        // ✅ THIS LINE IS MISSING
        loadComplaints(id);  // ← Call this to show the complaints
      } else {
        alert(data.error || "Profile not found.");
      }
    })
    .catch((err) => {
      console.error("Error searching:", err);
      alert("An error occurred.");
    });
});

  // FUNCTION TO UPDATE PROFILE DISPLAY
  function updateProfileDisplay(profile) {
    document.getElementById("student-name").textContent = profile.name || "N/A";
    document.getElementById("student-email").textContent = profile.email || "N/A";
    document.getElementById("student-course").textContent = `${profile.course || ""} - ${profile.year || ""}`;
    document.getElementById("student-id").textContent = profile.id_number || "N/A";
    document.getElementById("student-gender").textContent = profile.gender || "N/A";
    document.getElementById("student-birthdate").textContent = profile.birthdate || "N/A";
    document.getElementById("student-phone").textContent = profile.phone || "N/A";
    document.getElementById("student-address").textContent = profile.address || "N/A";
    document.getElementById("student-bp").textContent = profile.blood_pressure || "N/A";
    document.getElementById("student-weight").textContent = profile.weight || "N/A";
    document.getElementById("student-temp").textContent = profile.temperature || "N/A";

    studentProfile.classList.remove("hidden");
  }
});
