<template>
    <div>
        <form method="post" action="api/articles" id="new-article" @submit.prevent="addArticle">
            <label for="name">Article Name: </label>
            <input type="text" name="name" id="name" placeholder="Enter the article name"><br>

            <label for="price">Article Price:</label>
            <input type="number" name="price" id="price" placeholder="enter the article price"><br>

            <label for="description">Enter the article description</label>
            <textarea name="description" id="description" placeholder="article description"></textarea><br>

            <button type="submit">create article</button><br>
        </form>
        <div v-if="showSuccessMessage">
            Article successfully added!
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
            showSuccessMessage: false
        };
    },
    methods: {
        addArticle(){
            // Retrieve form data
            const formData = new FormData(document.getElementById('new-article'));

            // Convert form data to JSON
            const jsonData = {};
            for (const [key, value] of formData.entries()){
                jsonData[key] = value;
            }

            // Send a POST request to the API
            axios.post('api/articles', jsonData)
                .then(response => {
                    console.log(response.data);
                    this.showSuccessMessage = true;
                })
                .catch(error => {
                    console.error(error);
                })

        }
    }
}

</script>