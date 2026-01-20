document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("createSessionForm");
  var startTime = document.getElementById("startTime");
  var endTime = document.getElementById("endTime");
  var dateInput = form.querySelector("input[name='date']");
  var duration = document.querySelector("select[name='duration']");

  if (endTime) {
    endTime.disabled = true;
  }

  if (dateInput) {
    dateInput.addEventListener("change", function () {
      var inputDate = this.value;
      if (inputDate) {
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, "0");
        var day = String(now.getDate()).padStart(2, "0");
        var todayStr = year + "-" + month + "-" + day;

        if (inputDate < todayStr) {
          alert("You cannot time travel in the past.");
          this.value = "";
        }
      }
    });
  }

  if (startTime && endTime) {
    startTime.addEventListener("change", function () {
      var startValue = this.value;

      if (startValue) {
        endTime.disabled = false;
        endTime.min = startValue;
        if (endTime.value && endTime.value <= startValue) {
          alert("End time cannot be earlier than start time.");
          endTime.value = "";
        }
      } else {
        endTime.disabled = true;
        endTime.value = "";
      }
    });

    endTime.addEventListener("change", function () {
      var startValue = startTime.value;
      var endValue = this.value;

      if (startValue && endValue <= startValue) {
        alert("End Time must be after Start Time.");
        this.value = "";
      }
    });
  }

  if (form) {
    form.addEventListener("submit", function (e) {
      var dateVal = dateInput.value;
      var start = startTime.value;
      var end = endTime.value;
      var slotDuration = parseInt(duration.value);

      if (dateVal && start && end && slotDuration) {
        var selectedDateTime = new Date(dateVal + "T" + start);
        var now = new Date();

        if (selectedDateTime < now) {
          alert("You cannot schedule a time that has already passed.");
          e.preventDefault();
          return;
        }

        var startMinutes = parseInt(start.split(":")[0]) * 60 + parseInt(start.split(":")[1]);
        var endMinutes = parseInt(end.split(":")[0]) * 60 + parseInt(end.split(":")[1]);
        var totalSessionMinutes = endMinutes - startMinutes;

        if (totalSessionMinutes <= 0) {
          alert("End Time must be greater than Start Time.");
          e.preventDefault();
          return;
        }
      }

      e.preventDefault();
      var formData = new FormData(form);
      var xhr = new XMLHttpRequest();

      xhr.open("POST", "", true);
      xhr.responseType = "document";

      xhr.onload = function () {
        if (this.status === 200) {
          var newList = this.response.getElementById("session-lists");
          if (newList) {
            document.getElementById("session-lists").innerHTML =
              newList.innerHTML;

            form.reset();
            if (endTime) {
              endTime.disabled = true;
            }
          }
        } else {
          alert("Error adding session.");
        }
      };
      xhr.send(formData);
    });
  }
});
