// create a new form element
const form = document.createElement('form');
form.setAttribute('method', 'POST');
form.setAttribute('action', '/articles');
form.setAttribute('id', 'newarticle');

// Create a new input element for the CSRF token
const csrfInput = document.createElement('input');
csrfInput.type = 'hidden';
csrfInput.name = '_token';
csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
form.appendChild(csrfInput);

// Create a new input element for the article name
const nameInput = document.createElement('input');
nameInput.type = 'text';
nameInput.name = 'name';
nameInput.id = 'name';
nameInput.placeholder = 'article name';
form.appendChild(nameInput);

// Create a new input element for the article price
const priceInput = document.createElement('input');
priceInput.type = 'number';
priceInput.name = 'price';
priceInput.id = 'price';
priceInput.placeholder = 'article price';
form.appendChild(priceInput);

// Create a new input element for the article description
const descriptionInput = document.createElement('textarea');
descriptionInput.name = 'description';
descriptionInput.id = 'description';
descriptionInput.placeholder = 'article description';
form.appendChild(descriptionInput);

// Create a new submit button
const submitButton = document.createElement('button');
submitButton.type = 'submit';
submitButton.textContent = 'create article';
form.appendChild(submitButton);

// Add the form element to the body of the HTML document
var body = document.getElementsByTagName('body')[0];
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
    document.getElementById('newarticle').submit();
});
