// create a new form element
const form = document.createElement('form');
form.setAttribute('method', 'POST');
form.setAttribute('action', '/articles');
form.setAttribute('id', 'new-article');

// Create a new input element for the CSRF token
/** 
const csrfInput = document.createElement('input');
csrfInput.type = 'hidden';
csrfInput.name = '_token';
csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
form.appendChild(csrfInput);
*/

// Create a new input element for the article name
const nameLabel = document.createElement('label');
nameLabel.for = "name";
nameLabel.textContent = "Article Name: "

const nameInput = document.createElement('input');
nameInput.type = 'text';
nameInput.name = 'name';
nameInput.id = 'name';
nameInput.placeholder = 'Enter the article name';

form.appendChild(nameLabel);
form.appendChild(nameInput);

// Create a new input element for the article price
const priceLable = document.createElement('label');
priceLable.for = "price";
priceLable.textContent = "Article Price: "

const priceInput = document.createElement('input');
priceInput.type = 'number';
priceInput.name = 'price';
priceInput.id = 'price';
priceInput.placeholder = 'enter the article price';

form.append(priceLable);
form.appendChild(priceInput);

// Create a new input element for the article description
const descriptionLable = document.createElement('label');
descriptionLable.for="description";
descriptionLable.textContent="Enter the article description";

const descriptionInput = document.createElement('textarea');
descriptionInput.name = 'description';
descriptionInput.id = 'description';
descriptionInput.placeholder = 'article description';

form.append(descriptionLable);
form.appendChild(descriptionInput);

// Create a new submit button
const submitButton = document.createElement('button');
submitButton.type = 'submit';
submitButton.textContent = 'create article';
form.appendChild(submitButton);

// Add the form element to the div container of the HTML document
var body = document.getElementsByClassName("container")[0];
body.appendChild(form);

// add an event listener to the form to listen for submission
submitButton.addEventListener('click', (event) => {
    event.preventDefault();

    // check if the name, price and description fields are not empty
    const name = document.getElementById('name').value;
    const price = parseFloat(document.getElementById('price').value);
    const description = document.getElementById('description').value;

    if(!name){
        alert('Please enter a valid name');
        return;
    }

    if(isNaN(price)|| price <= 0){
        alert('Please enter a valid price');
        return;
    }
    
    if (!description){
        alert('Please enter a valid description');
        return;
    }

    //submit the form using the submit() method
    //document.getElementById('newarticle').submit();

    //submit the form using AJAX
    const message = document.getElementsByClassName("message")[0];

    const formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', description);

    const request = new XMLHttpRequest();
    request.open('POST','/articles');
    request.setRequestHeader("X-CSRF-TOKEN", document.getElementById("csrf-token").getAttribute('content'));
    request.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                message.textContent = "Erfolgreich!";
            }
            // if the requested resource is temporarily located at a different URL
            else if (this.status == 302) {
                var redirectUrl = this.getAllResponseHeaders("Location");
                request.open('GET', redirectUrl);
                request.responseType = "html";
                request.setRequestHeader("Accept", "application/html");
                request.send();
            } else {
                console.error("Error:", this.status);
                message.textContent = "Fehler: " + JSON.parse(this.responseText).message; 
            }
        }
    };
    request.send(formData);
});

