const patientInput = document.getElementById('patient_name');
const resultsBox = document.getElementById('patientResults');
const patientIdInput = document.getElementById('patient_id');

patientInput.addEventListener('keyup', function () {
    const query = this.value.trim();

    // console.log(query);

    if (query.length < 2) {
        resultsBox.innerHTML = '';
        resultsBox.style.display = 'none';
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/Doc_House/controller/Admin/PatientSearch.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            resultsBox.innerHTML = xhr.responseText;
            resultsBox.style.display = 'block';
        }
    };

    xhr.send('query=' + encodeURIComponent(query));
});

resultsBox.addEventListener('click', function (e) {
    if (e.target.classList.contains('patient-item')) {
        patientInput.value = e.target.textContent;
        patientIdInput.value = e.target.dataset.pid; 
        resultsBox.style.display = 'none';
        resultsBox.innerHTML = '';
    }
});

// hide when clicking outside
document.addEventListener('click', function (e) {
    if (!e.target.closest('.field')) {
        resultsBox.style.display = 'none';
    }
});

