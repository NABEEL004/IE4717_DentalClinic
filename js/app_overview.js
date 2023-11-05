window.onload = function () {
    var today = new Date();
    
    // Set the time zone to Singapore Time
    var singaporeTimezone = 'Asia/Singapore';
    var singaporeDate = new Date(today.toLocaleString('en-US', { timeZone: singaporeTimezone }));
    
    // Format today's date as "YYYY-MM-DD"
    var formattedDate = singaporeDate.toISOString().split('T')[0];

    // Set the minimum date for the date input to tomorrow
    document.getElementById("date").min = formattedDate;


    // maintain the selected date and info on appointments-overview.php
    if(app_date)
    {
        var app_table = document.querySelector('table');   
        const xhr = new XMLHttpRequest();

        const fetchUrl = `get_app.php?date=${app_date}`;
  
        // Set up the request
        xhr.open('GET', fetchUrl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              const data = JSON.parse(xhr.responseText);
    
              // Clear the existing table rows
              while (app_table.rows.length > 1) {
                app_table.deleteRow(1);
              }
    
              // Populate the table with the retrieved appointment data
            //   console.log(data.appointments);
              data.appointments.forEach((appointment) => {
                const row = app_table.insertRow(-1);
                const timeCell = row.insertCell(0);
                const nameCell = row.insertCell(1);
                const contactCell = row.insertCell(2);
                const emailCell = row.insertCell(3);
                const viewButtonCell = row.insertCell(4);
    
                timeCell.textContent = time_display(appointment.app_time);
                nameCell.textContent = appointment.patient_name;
                contactCell.textContent = appointment.phone_number;
                emailCell.textContent = appointment.email;
                viewButtonCell.innerHTML = `<a href="appointment-details.php?patient_email=${appointment.email}"><button>View</button></a>`;
              });
              if(app_table.rows.length==1)
              {
                  document.getElementById("no_app").innerHTML = "<i>No appointments on "+app_date+'</i>'; 
              }

            }
          };

          xhr.send();

    }


    var dateInput = document.getElementById('date');
    dateInput.addEventListener('change',add_record);

    function add_record()
    {
        const d = document.getElementById('date');
        const app_table = document.querySelector('table');   
        const selectedDate = d.value;
        document.getElementById("no_app").innerHTML = ""; 

        if(selectedDate)
        {
            // Use AJAX
            const xhr = new XMLHttpRequest();

            const fetchUrl = `get_app.php?date=${selectedDate}`;
      
            // Set up the request
            xhr.open('GET', fetchUrl, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                  const data = JSON.parse(xhr.responseText);
        
                  // Clear the existing table rows
                  while (app_table.rows.length > 1) {
                    app_table.deleteRow(1);
                  }
        
                  // Populate the table with the retrieved appointment data
                  console.log(data.appointments);
                  data.appointments.forEach((appointment) => {
                    const row = app_table.insertRow(-1);
                    const timeCell = row.insertCell(0);
                    const nameCell = row.insertCell(1);
                    const contactCell = row.insertCell(2);
                    const emailCell = row.insertCell(3);
                    const viewButtonCell = row.insertCell(4);
        
                    timeCell.textContent = time_display(appointment.app_time);
                    nameCell.textContent = appointment.patient_name;
                    contactCell.textContent = appointment.phone_number;
                    emailCell.textContent = appointment.email;
                    viewButtonCell.innerHTML = `<a href="appointment-details.php?patient_email=${appointment.email}"><button>View</button></a>`;
                  });
                  if(app_table.rows.length==1)
                  {
                      document.getElementById("no_app").innerHTML = "<i>No appointments on "+selectedDate+'</i>'; 
                  }

                }
              };

              xhr.send();

        
      
      
        }
    }

    function convertTimeFormat(timeString,offset_min) {
        const [hours, minutes, seconds] = timeString.trim().split(':');
        const time = new Date();
        time.setHours(parseInt(hours, 10), parseInt(minutes, 10), parseInt(seconds, 10));

        time.setMinutes(time.getMinutes()+offset_min);
        
        const period = time.getHours() >= 12 ? 'pm' : 'am';

        // Convert hours to 12-hour format
        const formattedHours = time.getHours() % 12 || 12; // Handle midnight (0) as 12

        // Create the formatted string
        const formattedTime = `${formattedHours}:${(time.getMinutes() < 10 ? '0' : '') + time.getMinutes()} ${period}`;

        return formattedTime;
    }

    function time_display(raw_time)
    {
        return convertTimeFormat(raw_time,0)+'-'+convertTimeFormat(raw_time,45);
    }
    


}
