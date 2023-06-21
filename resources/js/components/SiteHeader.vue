<template>
    <header class="site-header"></header>
    <h1>Abalo</h1>
    <sold/>
</template>

<script>
import Wartung from './Wartung.vue';
import Sold from './Sold.vue';
import Angebot from './Angebot.vue';

export default {
    name: 'SiteHeader',
    components: {
        //Wartung,
        //Angebot,
        Sold,
    },
}
</script>