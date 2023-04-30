// Check if the user has already accepted cookies
const cookieAccepted = getCookie('cookieAccepted');

console.log(document.cookie);

if(!cookieAccepted){
    // Show the cookie message
    const message = 'This website uses cookies. Do you accept?';
    if(confirm(message)) {
        // Set the "cookieAccepted" cookie to "true" for 1 minute
        setCookie('cookieAccepted', 'true', 2);
    }
}

// function to get the value of a cookie
function getCookie(name){
    const value = `;${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if(parts.length === 2){
        return parts.pop().split(';').shift;
    }
}

//function to set the value of a cookie
function setCookie(name, value, minutes){
    const date = new Date();
    date.setTime(date.getTime() + (minutes * 60 * 1000));
    const expires = `expires=${date.toUTCString()}`;
    document.cookie = `${name}=${value}; ${expires}; path=/cookiecheck`;
}