const fname = document.getElementById('Fname')
const surname = document.getElementById('Surname')
const username = document.getElementById('Username')
const password = document.getElementById('Pword')
const dob = document.getElementById('DateOfBirth')
const sex = document.getElementById('Sex')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

const invalid_chars = []

form.addEventListener('submit', (e) =>{
    let messages = []
    if (fname.value == '' || fname.value == null) {
        messages.push('Name is required')
    }

    if (surname.value == '' || surname.value == null) {
        messages.push('Surname is required')
    }

    if (username.value == '' || username.value == null) {
        messages.push('Username is required')
    }

    if (password.value == '' || password.value == null) {
        messages.push('Password is required')
    }

    if (dob.value == '' || dob.value == null) {
        messages.push('Date of Birth is required')
    }
    
    if (sex.value == '' || sex.value == null) {
        messages.push('Sex is required')
    }

    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    } 
})