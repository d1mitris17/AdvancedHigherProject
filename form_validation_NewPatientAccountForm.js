const fname = document.getElementById('name')
const surname = document.getElementById('surname')
const email = document.getElementById('email')
const dob = document.getElementById('dob')
const password = document.getElementById('password')
const sex = document.getElementById('sex')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

const invalid_chars = []

form.addEventListener('submit', (e) =>{
    let messages = []
    if (fname.value == '' || fname.value ==null) {
        messages.push('Name is required')
    }

    if (surname.value == '' || surname.value ==null) {
        messages.push('Surname time is required')
    }

    if (email.value == '' || email.value ==null) {
        messages.push('Email is required')
    }

    if (dob.value == '' || dob.value ==null) {
        messages.push('Date of Birth is required')
    }

    if (password.value == '' || patient_id.value ==null) {
        messages.push('Password is required')
    }

    if (sex.value == '' || sex.value ==null) {
        messages.push('Sex is required')
    }

    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    } 


})