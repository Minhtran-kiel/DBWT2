<template>
    <main class="site-body"></main>
    <search-article/>
    <new-article/>
</template>

<script>
import SearchArticle from './SearchArticle.vue';
import NewArticle from './NewArticle.vue';

export default {
        name: 'SiteBody',
        components : {
            SearchArticle,
            NewArticle,
        }
    }
</script>