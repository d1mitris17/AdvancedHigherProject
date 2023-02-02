const doctor = document.getElementById('doctor')
const start_time = document.getElementById('start_time')
const end_time = document.getElementById('end_time')
const date = document.getElementById('date')
const patient_id = document.getElementById('patient_id')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

const invalid_chars = []

form.addEventListener('submit', (e) =>{
    let messages = []
    if (doctor.value == '' || doctor.value ==null) {
        messages.push('Doctor is required')
    }

    if (start_time.value == '' || start_time.value ==null) {
        messages.push('Start time is required')
    }

    if (end_time.value == '' || end_time.value ==null) {
        messages.push('End time is required')
    }else if (end_time.value < start_time.value) {
        messages.push("Appointment can't end before it starts")
    }

    if (date.value == '' || date.value ==null) {
        messages.push('Date is required')
    }

    if (patient_id.value == '' || patient_id.value ==null) {
        messages.push('You must choose a patient')
    }



    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join('\n ')
    } 


})