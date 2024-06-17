const ctxFrequency = document.getElementById('drowsinessFrequencyChart').getContext('2d');
const configFrequency = {
    type: 'line',
    data: [],
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

let drowsinessFrequencyChart = new Chart(ctxFrequency, configFrequency);

// function choose time
let chooseTime = document.querySelectorAll('.choose-time');
chooseTime.forEach((item) => {
    item.addEventListener('click', (e) => {
        document.getElementById('action').style.left = e.target.offsetLeft + 'px';
        let position = e.currentTarget.getAttribute('get_time');

        document.querySelectorAll('.choose-time-to-filter').forEach((item) => {
            item.classList.remove('active');
        });
        document.querySelectorAll('.choose-time-to-filter')[position].classList.add('active');

    });
});

// function change time

// button previous time
let previousDate = document.querySelector('.previous-date');
previousDate.addEventListener('click', (e) => {
    if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 1) {
        const currentDate = new Date(document.querySelector('.choose-time-to-filter.active').textContent);
        currentDate.setDate(currentDate.getDate() - 1);
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0');
        const day = String(currentDate.getDate()).padStart(2, '0');
        const formattedDateDisplay = `${year}/${month}/${day}`;
        document.querySelector('.choose-time-to-filter.active').textContent = formattedDateDisplay;

        let formattedDateStartDate = `00:00:00 ${day}/${month}/${year}`;
        let formattedDateEndDate = `23:59:59 ${day}/${month}/${year}`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);

    } else if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 2) {
        // get date and format date in week
        const str = document.querySelector('.choose-time-to-filter.active').getAttribute('start_date');
            const [time, date] = str.split(" ");
            // Extract the year, month and day from the date string
            const [day, month, year] = date.split("/");
            const formattedDate = `${year}/${month}/${day}`;
            // Concatenate the time and date strings
            const dateTimeString = `${time} ${formattedDate}`;
            // Create a new date object using the formatted date string
            const currentDateStart = new Date(dateTimeString);
            currentDateStart.setDate(currentDateStart.getDate() - 7);

        // get date and format date in week
        const str2 = document.querySelector('.choose-time-to-filter.active').getAttribute('end_date');
            const [time2, date2] = str2.split(" ");
            // Extract the year, month and day from the date string
            const [day2, month2, year2] = date2.split("/");
            const formattedDate2 = `${year2}/${month2}/${day2}`;
            // Concatenate the time and date strings
            const dateTimeString2 = `${time2} ${formattedDate2}`;
            // Create a new date object using the formatted date string
            const currentDateEnd = new Date(dateTimeString2);
            currentDateEnd.setDate(currentDateEnd.getDate() - 7);

        let formattedDateStartDate = `00:00:00 ${currentDateStart.toLocaleDateString()}`;
        let formattedDateEndDate = `23:59:59 ${currentDateEnd.toLocaleDateString() }`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);


        document.querySelector('.choose-time-to-filter.active').textContent = "From " + convertTimeFormatYMD(currentDateStart.toLocaleDateString()) + " to " + convertTimeFormatYMD(currentDateEnd.toLocaleDateString());

    } else if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 3) {
        // get date and format date in week
        const str = document.querySelector('.choose-time-to-filter.active').getAttribute('start_date');
            const [time, date] = str.split(" ");
            // Extract the year, month and day from the date string
            const [day, month, year] = date.split("/");
            const formattedDate = `${year}/${month}/${day}`;
            // Concatenate the time and date strings
            const dateTimeString = `${time} ${formattedDate}`;
            // Create a new date object using the formatted date string
            const currentDateStart = new Date(dateTimeString);
            currentDateStart.setMonth(currentDateStart.getMonth() - 1);

        // get date and format date in week
        const str2 = document.querySelector('.choose-time-to-filter.active').getAttribute('end_date');
            const [time2, date2] = str2.split(" ");
            console.log(currentDateStart.toLocaleDateString());

            const dateStr = currentDateStart.toLocaleDateString(); // replace with your date string
            const parts = dateStr.split('/');
            const year3 = parts[2];
            const month3 = parts[1]; // months are zero-indexed in JavaScript
            const lastDate = new Date(year3, month3, 0);
            const lastDateOfMonth = lastDate.getDate();
            console.log(lastDate);

            const formattedDate2 = `${lastDateOfMonth}/${month3}/${year3}`;

        let formattedDateStartDate = `00:00:00 ${currentDateStart.toLocaleDateString()}`;
        let formattedDateEndDate = `23:59:59 ${formattedDate2}`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);


        document.querySelector('.choose-time-to-filter.active').textContent =  "Month: "+ month3 + " - From " + convertTimeFormatYMD(currentDateStart.toLocaleDateString()) + " to " + formattedDate2;
    } else if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 4) {
        // get date and format date in week
        const str = document.querySelector('.choose-time-to-filter.active').getAttribute('start_date');
            const [time, date] = str.split(" ");
            // Extract the year, month and day from the date string
            const [day, month, year] = date.split("/");
            const formattedDate = `${year}/${month}/${day}`;
            // Concatenate the time and date strings
            const dateTimeString = `${time} ${formattedDate}`;
            // Create a new date object using the formatted date string
            const currentDateStart = new Date(dateTimeString);
            currentDateStart.setYear(currentDateStart.getFullYear() - 1);

        // get date and format date in week
        const str2 = document.querySelector('.choose-time-to-filter.active').getAttribute('end_date');
            const [time2, date2] = str2.split(" ");

            // Extract the year, month and day from the date string
            const [day2, month2, year2] = date2.split("/");
            const formattedDate2 = `${year2}/${month2}/${day2}`;
            // Concatenate the time and date strings
            const dateTimeString2 = `${time2} ${formattedDate2}`;
            // Create a new date object using the formatted date string
            const currentDateEnd = new Date(dateTimeString2);
            currentDateEnd.setYear(currentDateEnd.getFullYear() - 1);



        let formattedDateStartDate = `00:00:00 ${currentDateStart.toLocaleDateString()}`;
        let formattedDateEndDate = `23:59:59 ${currentDateEnd.toLocaleDateString()}`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);


        document.querySelector('.choose-time-to-filter.active').textContent =  "Year: "+ currentDateEnd.toLocaleDateString().split("/")[2] + " - From " + convertTimeFormatYMD(currentDateStart.toLocaleDateString()) + " to " + convertTimeFormatYMD(currentDateEnd.toLocaleDateString());
    }
});

// button next time
let nextDate = document.querySelector('.next-date');
nextDate.addEventListener('click', (e) => {
    if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 1) {

        const currentDate = new Date(document.querySelector('.choose-time-to-filter.active').textContent);
        currentDate.setDate(currentDate.getDate() + 1);
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0');
        const day = String(currentDate.getDate()).padStart(2, '0');
        const formattedDateDisplay = `${year}/${month}/${day}`;
        document.querySelector('.choose-time-to-filter.active').textContent = formattedDateDisplay;

        let formattedDateStartDate = `00:00:00 ${day}/${month}/${year}`;
        let formattedDateEndDate = `23:59:59 ${day}/${month}/${year}`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);

    } else if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 2) {
        // get date and format date in week
        const str = document.querySelector('.choose-time-to-filter.active').getAttribute('start_date');
            const [time, date] = str.split(" ");
            // Extract the year, month and day from the date string
            const [day, month, year] = date.split("/");
            const formattedDate = `${year}/${month}/${day}`;
            // Concatenate the time and date strings
            const dateTimeString = `${time} ${formattedDate}`;
            // Create a new date object using the formatted date string
            const currentDateStart = new Date(dateTimeString);
            currentDateStart.setDate(currentDateStart.getDate() + 7);

        // get date and format date in week
        const str2 = document.querySelector('.choose-time-to-filter.active').getAttribute('end_date');
            const [time2, date2] = str2.split(" ");
            // Extract the year, month and day from the date string
            const [day2, month2, year2] = date2.split("/");
            const formattedDate2 = `${year2}/${month2}/${day2}`;
            // Concatenate the time and date strings
            const dateTimeString2 = `${time2} ${formattedDate2}`;
            // Create a new date object using the formatted date string
            const currentDateEnd = new Date(dateTimeString2);
            currentDateEnd.setDate(currentDateEnd.getDate() + 7);

        let formattedDateStartDate = `00:00:00 ${currentDateStart.toLocaleDateString()}`;
        let formattedDateEndDate = `23:59:59 ${currentDateEnd.toLocaleDateString() }`;

        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);

        document.querySelector('.choose-time-to-filter.active').textContent = "From " + convertTimeFormatYMD(currentDateStart.toLocaleDateString()) + " to " + convertTimeFormatYMD(currentDateEnd.toLocaleDateString());
    } else if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 3) {
        // get date and format date in week
        const str = document.querySelector('.choose-time-to-filter.active').getAttribute('start_date');
            const [time, date] = str.split(" ");
            // Extract the year, month and day from the date string
            const [day, month, year] = date.split("/");
            const formattedDate = `${year}/${month}/${day}`;
            // Concatenate the time and date strings
            const dateTimeString = `${time} ${formattedDate}`;
            // Create a new date object using the formatted date string
            const currentDateStart = new Date(dateTimeString);
            currentDateStart.setMonth(currentDateStart.getMonth() + 1);

        // get date and format date in week
        const str2 = document.querySelector('.choose-time-to-filter.active').getAttribute('end_date');
            const [time2, date2] = str2.split(" ");
            console.log(currentDateStart.toLocaleDateString());

            const dateStr = currentDateStart.toLocaleDateString(); // replace with your date string
            const parts = dateStr.split('/');
            const year3 = parts[2];
            const month3 = parts[1]; // months are zero-indexed in JavaScript
            const lastDate = new Date(year3, month3, 0);
            const lastDateOfMonth = lastDate.getDate();
            console.log(lastDate);

            const formattedDate2 = `${lastDateOfMonth}/${month3}/${year3}`;
            console.log(formattedDate2);
        let formattedDateStartDate = `00:00:00 ${currentDateStart.toLocaleDateString()}`;
        let formattedDateEndDate = `23:59:59 ${formattedDate2}`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);


        document.querySelector('.choose-time-to-filter.active').textContent = "Month: "+ month3 + " - From " + convertTimeFormatYMD(currentDateStart.toLocaleDateString()) + " to " + formattedDate2;
    } else if(document.querySelector('.choose-time-to-filter.active').getAttribute('get_time') == 4) {
        // get date and format date in week
        const str = document.querySelector('.choose-time-to-filter.active').getAttribute('start_date');
            const [time, date] = str.split(" ");
            // Extract the year, month and day from the date string
            const [day, month, year] = date.split("/");
            const formattedDate = `${year}/${month}/${day}`;
            // Concatenate the time and date strings
            const dateTimeString = `${time} ${formattedDate}`;
            // Create a new date object using the formatted date string
            const currentDateStart = new Date(dateTimeString);
            currentDateStart.setYear(currentDateStart.getFullYear() + 1);

        // get date and format date in week
        const str2 = document.querySelector('.choose-time-to-filter.active').getAttribute('end_date');
            const [time2, date2] = str2.split(" ");

            // Extract the year, month and day from the date string
            const [day2, month2, year2] = date2.split("/");
            const formattedDate2 = `${year2}/${month2}/${day2}`;
            // Concatenate the time and date strings
            const dateTimeString2 = `${time2} ${formattedDate2}`;
            // Create a new date object using the formatted date string
            const currentDateEnd = new Date(dateTimeString2);
            currentDateEnd.setYear(currentDateEnd.getFullYear() + 1);



        let formattedDateStartDate = `00:00:00 ${currentDateStart.toLocaleDateString()}`;
        let formattedDateEndDate = `23:59:59 ${currentDateEnd.toLocaleDateString()}`;
        document.querySelector('.choose-time-to-filter.active').setAttribute('start_date', formattedDateStartDate);
        document.querySelector('.choose-time-to-filter.active').setAttribute('end_date', formattedDateEndDate);


        document.querySelector('.choose-time-to-filter.active').textContent =  "Year: "+ currentDateEnd.toLocaleDateString().split("/")[2] + " - From " + convertTimeFormatYMD(currentDateStart.toLocaleDateString()) + " to " + convertTimeFormatYMD(currentDateEnd.toLocaleDateString());
    }
});

// convert time in string
function convertTimeFormatYMD(date) {
    const [day, month, year] = date.split("/");
    const formattedDate = `${year}/${month}/${day}`;
    return formattedDate;
}





document.addEventListener('click',(event)=>{
    var section_result_search = document.querySelector('.section-ipt-search')

    if(!section_result_search.contains(event.target))
    {
        const list_result_search = document.querySelector('.dropdown-result-search');
        list_result_search.style.display = "none";

    }
})


window.addEventListener('load',(event)=>{

    loadEventClickItem_DropdownSearchDashboard();
    loadEventIptSearch();
    loadEventBtnSubmitDashboard();
})

function loadEventClickItem_DropdownSearchDashboard()
{
    const list_result_search = document.querySelectorAll('.dropdown-result-search .item-result-search');
    list_result_search.forEach(
        item=>{
            item.addEventListener('click',()=>{
                const label = item.querySelector('.label-item-search').textContent.trim();
                const value = item.querySelector('.value-item-search').textContent.trim();
                const ipt_search_dashboard = document.querySelector('#ipt-search-dashboard');
                ipt_search_dashboard.value =  `${value}` ;
                if(item.getAttribute('data-type')=='vehicle')
                {
                    ipt_search_dashboard.setAttribute('vehicle-id',item.getAttribute('data-id'))
                    ipt_search_dashboard.setAttribute('company-id',-1)

                }
                else if(item.getAttribute('data-type')=='company')
                {
                    ipt_search_dashboard.setAttribute('company-id',item.getAttribute('data-id'))
                    ipt_search_dashboard.setAttribute('vehicle-id',-1)

                }
            })

        }
    )
}

function loadEventBtnSubmitDashboard()
{
    var btn_submit_search_dashboard = document.querySelector('#btn-submit-search-dashboard');
    var ipt_search_dashboard = document.querySelector('#ipt-search-dashboard');

    btn_submit_search_dashboard.addEventListener('click',(event)=>{
        let itemDate = document.querySelector('.choose-time-to-filter.active');
        let start_date = itemDate.getAttribute('start_date');
        let end_date = itemDate.getAttribute('end_date');
        event.preventDefault()
        requestDataStatistics(
            {
                text_search: ipt_search_dashboard.value,
                start_time: start_date,
                end_time: end_date,
            }
        )
        // location.href = `/dashboard/?taxi-id=${ipt_search_dashboard.getAttribute('taxi-id')}&company-id=${ipt_search_dashboard.getAttribute('company-id')}`.trim()
    })
}

function loadEventIptSearch() {
    var ipt_search_dashboard = document.querySelector('#ipt-search-dashboard');
    ipt_search_dashboard.addEventListener('keyup',(event)=>{
        var list_result_search = document.querySelectorAll('.dropdown-result-search .item-result-search');
    list_result_search.forEach(

        item=>{
            var value_item = item.querySelector('.value-item-search').textContent.trim();
            var value_search = event.currentTarget.value.trim()
            if(value_search.length>0)
            {
                // console.log(value_item,value_search,value_item.indexOf(value_search));
                if(value_item.toLowerCase().indexOf(value_search.toLowerCase())>=0)
                    {
                        item.style.display = "block"
                    }
                    else
                    {
                        item.style.display = "none"
                    }
            }
            else
            {
                item.style.display = "block"
            }
        }
    )
    })
    ipt_search_dashboard.addEventListener('focus',(event)=>{
        document.querySelector('.dropdown-result-search').style.display = 'block'
    })
}

function requestDataStatistics(
    {
        text_search,
        start_time,
        end_time,
    }={}
) {
    const form = new FormData();
    form.append('text-search',text_search)
    form.append('start-time',start_time)
    form.append('end-time',end_time)
    fetch("/dashboard/get-data-statistics",{
        method: 'POST',
        mode: 'cors',
        body:form
    }).then(res=>res.json()).then(result=>{
        let resultTime = document.querySelectorAll('.result-time');
        resultTime[0].textContent = result.total_drowsiness_detections;
        resultTime[1].textContent = result.total_vehicle_drowsiness_detections;

        updateCharts(result)
    })
}

function updateCharts(newData) {
    if (newData.total_drowsiness_detections > 0) {

        const frequencyLabels = Object.keys(newData.drowsiness_frequency);
        const frequencyData = Object.values(newData.drowsiness_frequency);

        document.querySelector('.container-chart').style.display = 'block'

        drowsinessFrequencyChart.data.labels = frequencyLabels;
        drowsinessFrequencyChart.data.datasets = [{
            label: 'Frequency of Drowsiness Events',
            data: frequencyData,
            backgroundColor: 'rgb(124, 212, 140)',
            borderColor: 'rgb(14, 89, 4)',
            borderWidth: 1
        }];
        drowsinessFrequencyChart.update();
    } else {
        document.querySelector('.container-chart').style.display = 'none'
    }
}

//
function convertTime_to_Text(obj_time)
{
    if(obj_time.hours==0 && obj_time.minutes == 0)
    {
        return `${obj_time.seconds}s`
    }
    else if(obj_time.hours==0 &&  obj_time.minutes > 0) {

        return `${(obj_time.minutes + obj_time.seconds/60).toFixed(2)}'`
    }
    else if(obj_time.hours>0 )
    {
        return `${(obj_time.hours + obj_time.minutes/60).toFixed(2)}h`
    }
}



