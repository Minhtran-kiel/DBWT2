'use strict';

// turn menu into object
class Menu {
    constructor(){
        this.menuArray = [
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

        this.ul = document.createElement('ul');
    }

    // turn create navigation menu in HTML into method
    createMenu(){
        let nav = document.createElement('nav');
        let body = document.getElementsByTagName('body')[0];
        this.ul.id = 'navbar';

        
        for (let i = 0; i < this.menuArray.length; i++) {
            let li = document.createElement('li');
            let a = document.createElement('a');
            a.textContent = this.menuArray[i].name;
            li.appendChild(a);
        
            if (this.menuArray[i].subMenu) {
                let sub_ul = document.createElement('ul');
                sub_ul.classList.add('submenu');
                for (let j = 0; j < this.menuArray[i].subMenu.length; j++) {
                    let sub_li = document.createElement('li');
                    let sub_a = document.createElement('a');
                    sub_a.href = this.menuArray[i].subMenu[j].link;
                    sub_a.textContent = this.menuArray[i].subMenu[j].name;
                    sub_li.appendChild(sub_a);
                    sub_ul.appendChild(sub_li);
                }
                li.appendChild(sub_ul);
            }
            else {
                a.href = this.menuArray[i].link;
            }
            this.ul.appendChild(li);
        }
        nav.appendChild(this.ul);
        body.appendChild(nav);   
    }

    // make the menu dynamic so submenu is not visible until clicking
    makeMenuDyn(){
        let menuItems = this.ul.querySelectorAll('li');
        
        menuItems.forEach(item => {
            let submenu = item.querySelector('.submenu');

            // add event listener if submenu exists
            if(submenu){
                item.addEventListener('click', () =>{
                   submenu.style.display = submenu.style.display === 'none'? 'block': 'none';
                });
            }
        });
        
    }
}

var menu = new Menu();
menu.createMenu();
menu.makeMenuDyn();

     

