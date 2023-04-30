'use strict';

// Menüstruktur
var menu = [
    {
        name: "Home",
        link: '/menu'
    },
    {
        name: "Kategorien",
        link: '/kategorien'
    },
    {
        name: "Verkaufen",
        link: '/verkaufen'
    },
    {
        name: "Unternehmen",
        subMenu: [
            {
                name: "Philosophie",
                link: '/philosophie'
            },
            {
                name: "Karrier",
                link: '/career'
            }
        ]
    }
];

// create navigation menu in HTML
var nav = document.createElement('nav');
var ul = document.createElement('ul');
var body = document.getElementsByTagName('body')[0];
ul.id = 'navbar';

for (let i = 0; i < menu.length; i++) {
    let li = document.createElement('li');
    let a = document.createElement('a');
    a.textContent = menu[i].name;
    li.appendChild(a);

    if (menu[i].subMenu) {
        let sub_ul = document.createElement('ul');
        for (let j = 0; j < menu[i].subMenu.length; j++) {
            let sub_li = document.createElement('li');
            let sub_a = document.createElement('a');
            sub_a.href = menu[i].subMenu[j].link;
            sub_a.textContent = menu[i].subMenu[j].name;
            sub_li.appendChild(sub_a);
            sub_ul.appendChild(sub_li);
        }
        li.appendChild(sub_ul);
    }
    else {
        a.href = menu[i].link;
    }
    ul.appendChild(li);
}

nav.appendChild(ul);
body.appendChild(nav);


