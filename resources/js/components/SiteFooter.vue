<template>
    <footer class="site-footer"></footer>
    <p>&copy; 2023 My Website. All rights reserved.
        <a href="#" @click.prevent="$emit('showImpressum')">Impressum</a>
    </p>
</template>

<script>
    export default {
        name: 'SiteFooter'
    }
</script>