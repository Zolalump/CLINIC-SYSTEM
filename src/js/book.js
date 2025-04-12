document.addEventListener("DOMContentLoaded", function () {
    fetch("/bookings.php") 
        .then(response => response.json())
        .then(data => {
            const bookingContainer = document.getElementById("booking-list");
            bookingContainer.innerHTML = ""; // Clear placeholder

            if (data.success && data.bookings.length > 0) {
                data.bookings.forEach(booking => {
                    const bookingElement = document.createElement("div");
                    bookingElement.className = "p-3 border-b border-gray-300 bg-white rounded-lg mb-2 shadow-sm flex justify-between items-center";

                    bookingElement.innerHTML = `
                        <div>
                            <p><strong>Facility:</strong> ${booking.facility}</p>
                            <p><strong>Date:</strong> ${booking.date}</p>
                            <p><strong>Time:</strong> ${booking.time_slot}</p>
                            <p><strong>Purpose:</strong> ${booking.purpose}</p>
                            <p><strong>Attendees:</strong> ${booking.attendees}</p>
                        </div>
                        <button class="cancel-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 transition" data-id="${booking.id}">
                            Cancel
                        </button>
                    `;

                    bookingContainer.appendChild(bookingElement);
                });

                // Add event listeners to all cancel buttons
                document.querySelectorAll(".cancel-btn").forEach(button => {
                    button.addEventListener("click", function () {
                        const bookingId = this.getAttribute("data-id");
                        cancelBooking(bookingId);
                    });
                });
            } else {
                bookingContainer.innerHTML = "<p>No active reservations.</p>";
            }
        })
        .catch(error => {
            console.error("Error loading bookings:", error);
            document.getElementById("booking-list").innerHTML = "<p>Failed to load bookings.</p>";
        });
});

// Function to cancel a booking
function cancelBooking(bookingId) {
    if (!confirm("Are you sure you want to cancel this reservation?")) return;

    fetch("/cancel_booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: bookingId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Reservation canceled successfully!");
            location.reload(); // Refresh to update the list
        } else {
            alert("Failed to cancel the reservation.");
        }
    })
    .catch(error => {
        console.error("Error canceling booking:", error);
        alert("Error processing your request.");
    });
}
