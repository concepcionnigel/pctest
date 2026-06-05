import './style.css';

async function login() {
    console.log('Login clicked');

    try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email: 'test@gmail.com',
                password: 'password'
            })
        });

        const data = await response.json();

        console.log(data);

        if (response.ok) {

            localStorage.setItem(
                'user',
                JSON.stringify(data.user)
            );

            alert('Login Successful');

            window.location.href = '/dashboard.html';

        } else {
            alert(data.message || 'Login Failed');
        }

    } catch (error) {
        console.error(error);
        alert('Server Error');
    }
}

window.login = login;