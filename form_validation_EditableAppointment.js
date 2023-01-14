const AppDate = document.getElementById('AppDate')
const StartTime = document.getElementById('StartTime')
const EndTime = document.getElementById('EndTime')
const form = document.getElementById('update-form')
const errorElement = document.getElementById('error')

const invalid_chars = []

form.addEventListener('submit', (e) =>{
    let messages = []
    if (AppDate.value == '' || AppDate.value ==null) {
        messages.push('AppDate is required')
    }

    if (StartTime.value == '' || StartTime.value ==null) {
        messages.push('Start time is required')
    }

    if (EndTime.value == '' || EndTime.value ==null) {
        messages.push('End time is required')
    }

    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    } 


})