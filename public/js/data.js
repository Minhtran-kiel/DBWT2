'use strict';

var data = {
    'produkte': [
        { name: 'Ritterburg', preis: 59.99, kategorie: 1, anzahl: 3 },
        { name: 'Gartenschlau 10m', preis: 6.50, kategorie: 2, anzahl: 5 },
        { name: 'Robomaster' ,preis: 199.99, kategorie: 1, anzahl: 2 },
        { name: 'Pool 250x400', preis: 250, kategorie: 2, anzahl: 8 },
        { name: 'Rasenmähroboter', preis: 380.95, kategorie: 2, anzahl: 4 },
        { name: 'Prinzessinnenschloss', preis: 59.99, kategorie: 1, anzahl: 5 }
    ],
    'kategorien': [
        { id: 1, name: 'Spielzeug' },
        { id: 2, name: 'Garten' }
    ]
};

let produkte_array = data.produkte;
let kategorie_array = data.kategorien;

/**
 *gets the name of product having the highest preis
 * @param {object} data - input object  
 * @returns {string} The name of product having highest preis
 */
function getMaxPreis(data){
    let max = 0;
    let name;
    for(let key in produkte_array){
        if(max < produkte_array[key].preis){
            max = produkte_array[key].preis;
            name = produkte_array[key].name;
        }
    }
    return name;
}

/**
 * gets the object having minimum preis
 * @param {object} data- input object
 * @returns {object} The object having minimum preis
 */
function getMinPreisProdukt(data){
    let min = 200;
    let object;
    for(let key in produkte_array){
        if(produkte_array[key].preis < min){
            min = produkte_array[key].preis;
            object = produkte_array[key];
        }
    }
    return object;
}

/**
 * calculates the sum of all product
 * @param {object} data - input object
 * @returns {number} The sum of all products
 */
function getPreisSum(data){
    let sum = 0;
    for(let key in produkte_array){
        sum += produkte_array[key].preis;
    }
    return sum;
}

/**
 * calculates the total preis of all product
 * @param {object} data - input object
 * @returns {number} The total preis of all product
 */
function getGesamtWert(data){
    let total_preis = 0;
    for(let key in produkte_array){
        total_preis += produkte_array[key].preis * produkte_array[key].anzahl;
    }
    return total_preis;
}

/**
 * get number of all products in given category
 * @param {object} data - input object 
 * @param {string} kategorie - the category of products needed to count 
 * @returns {number} - Number of all products in given category
 */
function getAnzahlProdukteOfKategorie(data, kategorie){
    let total_number = 0;
    let id;

    for(let key in kategorie_array){
        if (kategorie_array[key].name == kategorie){
            id = kategorie_array[key].id;
        }
    }

    for(let key in produkte_array){
        if(produkte_array[key].kategorie == id){
            total_number += 1;
        }
    }

    return total_number;
}
//test
console.log('Max price: ' + getMaxPreis(data));
console.log('Min Price Product: ' + getMinPreisProdukt(data));
console.log('Price Sum: ' + getPreisSum(data));
console.log('GesamtWert: '+ getGesamtWert(data));
console.log('Anzahl Product of Kategorie: '+ getAnzahlProdukteOfKategorie(data,'Spielzeug'));