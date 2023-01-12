const username = document.getElementById('username')
const password = document.getElementById('password')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

const invalid_chars = []

form.addEventListener('submit', (e) =>{
    let messages = []
    if (username.value == '' || username.value ==null) {
        messages.push('Username is required')
    }

    if (password.value == '' || password.value ==null) {
        messages.push('Password is required')
    }

    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    } 
})