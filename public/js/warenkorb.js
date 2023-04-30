'use strict';

var bag = [];
var addButtons = document.querySelectorAll(".add-to-bag");
var table = document.getElementById('bag-items');

function addToBag(article) {
    let tr = document.createElement('tr');
    tr.setAttribute('id', article.id);

    let td_name = document.createElement('td');
    td_name.textContent = article.name;

    let td_button = document.createElement('td');
    let minusButton = document.createElement('button');

    minusButton.textContent = '-';
    minusButton.setAttribute('class', 'minus-from-bag');
    minusButton.setAttribute('minus_button_id', article.id);

    td_button.appendChild(minusButton);

    tr.appendChild(td_button);
    tr.appendChild(td_name);
    table.appendChild(tr);

    bag.push(article);
}

function removeFromBag(article) {
    let tr = document.querySelector('tr[id="' + article.id + '"]');

    // remove the article from table
    table.removeChild(tr);

    //remove the article from bag
    const index = bag.findIndex(obj => obj.id === article.id);
    if(index !== -1){
        bag.splice(index,1);
    }

}

addButtons.forEach(button => {
    button.addEventListener('click', event => {
        // prevent Default prevents page to reload after each click
        event.preventDefault();

        let id = button.getAttribute('article_id')
        let name = button.getAttribute('article_name');
        let preis = button.getAttribute('article_preis');

        let article = {
            'id': id,
            'name': name,
            'preis': preis
        }
        // check if article already exists in bag
        let exists = bag.some(obj => obj.id === id);

        // if not, add article to bag
        if (!exists) {
            addToBag(article);
            button.disabled = true;
            console.log(bag);
        }
    });
});



table.addEventListener('click', event => {
    event.preventDefault();
    if (event.target.classList.contains('minus-from-bag')) {

        let id = event.target.getAttribute('minus_button_id');
        console.log(id);

        // find article having this id in bag
        let article = bag.find(obj => obj.id === id);
        console.log(article);

        // remove article from bag
        removeFromBag(article);
        console.log(bag);

        //update gui
        let addButton = document.querySelector('[article_id="'+id+'"]');
        addButton.disabled = false;
    }
});





