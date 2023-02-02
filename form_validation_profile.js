const fname = document.getElementById('Fname')
const surname = document.getElementById('Surname')
const username = document.getElementById('Username')
const dob = document.getElementById('DateOfBirth')
const sex = document.getElementById('Sex')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) =>{

    const fnameVal = fname.value.trim()
    const surnameval = surname.value.trim()
    const usernameval = username.value.trim()
    const dobval = dob.value.trim()
    const sexval = sex.value.trim()


    let messages = []
    if (fnameVal === '' || fnameVal == null) {
        messages.push('Name is required')
    } 

    if (surnameval === '' || surnameval == null) {
        messages.push('Surname is required')
    }

    if (usernameval === '' || usernameval == null) {
        messages.push('Username is required')
    }

    if (dobval === '' || dobval == null) {
        messages.push('Date of Birth is required')
    }
    
    if (sexval === '' || sexval == null) {
        messages.push('Sex is required')
    }

    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    } 
})