
// Handle klik tanggal
document.querySelectorAll('.date-card').forEach(function (card) {
    card.addEventListener('click', function () {
        document.querySelectorAll('.date-card').forEach(function (c) {
            c.classList.remove('date-active');
        });
        this.classList.add('date-active');
    });
});

// Handle klik waktu
document.querySelectorAll('.time-slot').forEach(function (slot) {
    // Skip kalau disabled
    if (slot.classList.contains('disabled')) return;

    slot.addEventListener('click', function () {
        document.querySelectorAll('.time-slot').forEach(function (s) {
            s.classList.remove('time-selected');
        });
        this.classList.add('time-selected');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".btn-option, .btn-selected");

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {
            buttons.forEach(b => {
                b.classList.remove("btn-selected");
                b.classList.add("btn-option");
            });
            this.classList.remove("btn-option");
            this.classList.add("btn-selected");
        });
    });
});

// Fungsi untuk menutup reminder
function closeReminder() {
    document.getElementById('reminder').style.display = 'none';
    localStorage.setItem('reminderClosed', 'true');
}

window.onload = function () {
    if (localStorage.getItem('reminderClosed') === 'true') {
        document.getElementById('reminder').style.display = 'none';
    }
};
