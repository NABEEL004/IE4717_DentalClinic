window.onload = function () {
    var today = new Date();
    
    // Set the time zone to Singapore Time
    var singaporeTimezone = 'Asia/Singapore';
    var singaporeDate = new Date(today.toLocaleString('en-US', { timeZone: singaporeTimezone }));
    
    // Format today's date as "YYYY-MM-DD"
    var formattedDate = singaporeDate.toISOString().split('T')[0];

    // Set the minimum date for the date input to tomorrow
    document.getElementById("date").min = formattedDate;
}
