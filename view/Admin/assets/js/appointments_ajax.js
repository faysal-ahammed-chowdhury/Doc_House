const doctorSelect  = document.getElementById('doc_name');
const sessionSelect = document.getElementById('doc_total_time');
const slotSelect    = document.getElementById('doc_available_slot');

/* ============================
   Doctor → Session
============================ */
doctorSelect.addEventListener('change', function () {
    const uid = this.value;

    sessionSelect.innerHTML = '<option value="">Loading sessions...</option>';
    slotSelect.innerHTML = '<option value="">Select Your Slot</option>';

    if (!uid) {
        sessionSelect.innerHTML = '<option value="">Select Available Session</option>';
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/Doc_House/controller/Admin/SessionController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            sessionSelect.innerHTML = xhr.responseText;
        } else {
            sessionSelect.innerHTML = '<option value="">Failed to load sessions</option>';
        }
    };

    xhr.send('uid=' + encodeURIComponent(uid));
});

/* ============================
   Session → Slot
============================ */
sessionSelect.addEventListener('change', function () {
    const sessionId = this.value;

    slotSelect.innerHTML = '<option value="">Loading slots...</option>';

    if (!sessionId) {
        slotSelect.innerHTML = '<option value="">Select Your Slot</option>';
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/Doc_House/controller/Admin/SlotController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            slotSelect.innerHTML = xhr.responseText;
        } else {
            slotSelect.innerHTML = '<option value="">Failed to load slots</option>';
        }
    };

    xhr.send('session_id=' + encodeURIComponent(sessionId));
});
