<template>
    <main class="site-body"></main>
    <search-article/>
</template>

<script>
import SearchArticle from './SearchArticle.vue';
export default {
        name: 'SiteBody',
        components : {
            SearchArticle,
        }
    }
</script>