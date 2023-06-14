<template>
    <div>
        <site-header/>

        <div class="site-body">
            <site-body v-if="!showImpressum"/>
            <impressum v-else />
        </div>
        
        <site-footer @showImpressum="showImpressum = !showImpressum"/>
    </div>
</template>

<script>
import SiteHeader from './SiteHeader.vue';
import SiteBody from './SiteBody.vue';
import SiteFooter from './SiteFooter.vue';
import Impressum from './Impressum.vue';


export default{
    name: 'App',
    components: {
        SiteHeader,
        SiteBody,
        SiteFooter,
        Impressum,
    },
    data(){
        return {
            showImpressum: false
        };
    },
};
</script>