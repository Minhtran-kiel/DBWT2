<template>
    <div>
        <label for="search">Search Articles</label>
        <input type="text" id="search" v-model="searchTerm" @input="fetchArticles" @keyup="isSearching = true">
        <table v-if="articles.length > 0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Creator</th>
                    <th>Created Date</th>
                    <th>Image</th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody>
                <tr v-for="article in articles" :key="article.id">
                    <td>{{ article.ab_name }}</td>
                    <td>{{ article.ab_price }}</td>
                    <td>{{ article.ab_description }}</td>
                    <td>{{ article.ab_creator_id }}</td>
                    <td>{{ article.ab_createdate }}</td>
                    <td>
                        <img :src="getImageUrl(article.id)" width="120" height="85" alt="Article Image">
                    </td>
                    <td>
                        <angebot-button :articleId="article.id"/>
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else>No article found</p>
        <!-- Pagination -->
        <div class="pagination">
            <button :disabled="currentPage === 1" @click="gotoPage(currentPage - 1)">Previous</button>
            <span>Page {{ currentPage }} of {{ totalPages }}</span>
            <button :disabled="currentPage === totalPages" @click="gotoPage(currentPage + 1)">Next</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import AngebotButton from './AngebotButton.vue';

export default {
    data() {
        return {
            searchTerm: '',
            articles: [],
            currentPage: 1,
            totalPages: 0,
            isSearching: false,
        };
    },
    components: {
        AngebotButton,
    },

    methods: {
        fetchArticles() {
            if (this.isSearching) {
                this.currentPage = 1;
            };

            if (this.searchTerm.length === 0) {
                this.fetchAllArticles();
            }
            else if (this.searchTerm.length >= 3) {
                axios.get('api/articles', {
                    params: {
                        search: this.searchTerm,
                        page: this.currentPage,
                    },
                })
                    .then(response => {
                        this.articles = response.data.articles;
                        this.totalPages = response.data.totalPages;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                this.articles = [];
            }
            this.isSearching = false;
        },

        fetchAllArticles() {
            axios
                .get('/api/articles', {
                    params: {
                        page: this.currentPage,
                    },
                })
                .then(response => {
                    this.articles = response.data.articles;
                    this.totalPages = response.data.totalPages;
                })
                .catch(error => {
                    console.error(error);
                });
        },


        getImageUrl(articleId) {
            if (!articleId) {
                return null;
            }

            const imgUrlJpg = `articelimages/${articleId}.jpg`;
            const imgUrlPng = `articelimages/${articleId}.png`;

            try {
                if (this.isImageUrl(imgUrlJpg)) {
                    return imgUrlJpg;
                }

                else if (this.isImageUrl(imgUrlPng)) {
                    return imgUrlPng;
                }

                return null;
            } catch (error) {
                console.error(error);
                return null;
            }
        },

        async isImageUrl(url) {
            try {
                const response = await axios.head(url);
                return response.status === 200;
            } catch (error) {
                if (axios.isCancel(error)) {
                    return false;
                } else if (axios.isAxiosError(error)) {
                    return false;
                } else {
                    console.error(error);
                    throw error;
                }
            }
        },

        gotoPage(page) {
            if (this.isSearching) {
                this.currentPage = 1;
            } else {
                this.currentPage = page;
            }
            this.fetchArticles();
        }
    },
    mounted() {
        this.fetchAllArticles();
    },

}
</script>