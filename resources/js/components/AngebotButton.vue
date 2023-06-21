<template>
    <button v-if="isOfUser" @click="onClick">Artikel jetzt als Angebot anbieten</button>
</template>
<script>
import axios from 'axios';

export default {
    props: ['articleId'],
    data() {
        return {
            userId: '',
            isOfUser: false,
        }
    },
    methods: {
        onClick() {
            axios.get('api/sendNotification', {
                params: {
                    articleId: this.articleId,
                }
            }).then((response) => {
                    this.isOfUser = response.data.message;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        checkArticleOwnership() {
            axios.get('/api/checkArticleOwnership', {
                params: {
                    articleId: this.articleId,
                    userId: this.getUserId(),
                }
            })
                .then((response) => {
                    this.isOfUser = response.data.message;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        getUserId() {
            //retrieve the user Id from the session (using cookies)
            return document.cookie
                .split('; ')
                .find(row => row.startsWith('userId='))
                .split('=')[1];
        }
    },
    mounted(){
        this.getUserId();
        this.checkArticleOwnership();
    }

}
</script>