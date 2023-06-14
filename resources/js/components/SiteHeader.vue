<template>
    <header class="site-header"></header>
    <h1>Abalo</h1>
</template>

<script>
import Menu from './Menu.js';

export default {
    name: 'SiteHeader',
    components: {
        Menu
    },
    mounted(){
        const menu = new Menu();
        menu.createMenu();
        menu.makeMenuDyn();
    }
}
</script>